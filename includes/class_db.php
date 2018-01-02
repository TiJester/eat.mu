<?php

/*
 * TiJester
 * UA Odessa  * 
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
    private $user = "root";
    private $pass = "";
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
        parent::__construct($this->dbHost, $this->dbName, $this->user, $this->pass);
        if (mysqli_connect_error())
        {
            exit('Ошибка соединения ('.mysqli_connect_errno().')'.mysqli_connect_error());
        }
        parent::set_charset('utf-8');
    }
}
