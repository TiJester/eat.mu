<?php

/*
 * TiJester
 * UA Odessa
 */

/**
 * Description of class_db
 *
 * @author Grib
 */

//Расширяем класс MySQLi
class class_db extends mysqli{
    // единый экземпляр self, общий для всех экземпляров
    private static $instance = null;
    
    //конфигурация подключения к базе данных
    private $user = "root";//пользователь к базе данных
    private $pass = "";//пароль к базе данных
    private $dbName = "eat_test_01012017";
    private $dbHost = "localhost";
    
    //Этот метод должен быть статическим и должен возвращать экземпляр объекта, если объект еще не существует.
    public static function getInstance()
    {
        if (!self::$instance instanceof self)
        {
            self::$instance = new self;
        }
        return self::$instance;
    }
    
    //Методы клонирования и пробуждения предотвращают внешнюю копию экземпляров класса Singleton, исключая, таким образом, возможность дублирования объектов.
    public function __clone() 
    {
        trigger_error('Clone (Клонирование) не допускаеться', E_USER_ERROR);
    }
    public function __wakeup()
    {
        trigger_error('Дезерелизация не допускаеться', E_USER_ERROR);
    }

    //частный конструктор
    private function __construct() 
    { //соеденение с БД
        parent::__construct($this->dbHost, $this->user, $this->pass, $this->dbName);
        if (mysqli_connect_error())
        {
            exit('Ошибка соединения ('.mysqli_connect_errno().')'.mysqli_connect_error());
        }
        parent::set_charset('utf-8');
    }
    
    //Функция get_user_id_by_name, Функция требует имя пользователя в качестве входного параметра и возвращает идентификатор  id user.
    public function get_user_id_by_name($name) 
    {
    $name = $this->real_escape_string($name);
    $users = $this->query("SELECT id FROM user WHERE name = '" .$name. "'");
    /*SELECT id FROM wishers WHERE name = '*/
    if ($users->num_rows > 0)
        {
        $row = $users->fetch_row();
        return $row[0];
        }
    else {
        return NULL;
        }
    }
    
    // Функция get_user_by_users_id. Функция требует идентификатор. Идентификатор в качестве входного параметра и возвращает адрес, зарегистрированные для пользователя.
    public function get_user_by_users_id($userID)
    {
        return $this->query("SELECT id, address_country, address_city, address_street, address_street_num, address_apartment FROM address WHERE id_user =".$userID);
    }
    
    // Функция create_user. Функция создает новую запись в таблице user. Функция требует имя и пароль нового user (пользователя) в качестве входных параметров и не возвращает никаких данных.
    public function create_user($name, $password)
    {
        $name = $this-> real_escape_string($name);
        $password = $this->real_escape_string($password);
        $this->query("INSERT INTO user (name, password) VALUES ('" . $name . "','". $password . "')");
    }
    
    // Функция verify_user_credentials. Функция требует логин и пароль, возвращая 0 или 1
    public function verify_user_credentials ($name, $password)
    {
    $name = $this->real_escape_string($name);
    $password = $this->real_escape_string($password);
    $result = $this->query("SELECT 1 FROM user WHERE name = '". $name ."' AND password ='". $password . "'");
    return $result->data_seek(0);     
    }

}
