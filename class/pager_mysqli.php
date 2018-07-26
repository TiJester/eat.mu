<?php

/*
 * TiJester
 * UA Odessa  * 
 */

/**
* 2018(С) Шевченко Г.Ю.
* Описание класа pager_mysqli
* Постраничная навигация для базы данных
* V 0.1.2
*/
  // Выставляем уровень обработки ошибок 
  error_reporting(E_ALL & ~E_NOTICE);
  
  //    Подключаем все необходимые классы
  require_once ("pager.php");
  //    Подклчаем конфиг для подключения к БД
  include ("/../config/config.php");
  
  
class pager_mysqli extends pager{
    //  Имя таблицы
    protected $tablename;
    //  WHERE-условие
    protected $where;
    //  Критерии сортировки ORDER
    protected $order;
    //  Колличество позиций на странице
    private $pnumber;
    //  Колличество ссылок слева и справа от текущей страницы
    private $page_link;
    //  Параметры
    private $parameters;
    //  Конструктор
    public function __construct(
            $tablename,
            $where = "",
            $order = "",
            $pnumber = 10,
            $page_link = 3,
            $parameters = "") {
                $this->tablename = $tablename;
                $this->where = $where;
                $this->order = $order;
                $this->pnumber = $pnumber;
                $this->page_link = $page_link;
                $this->parameters = $parameters;
   }
   public function get_total() {
    //  адрес сервера
    $host = '127.0.0.1'; 
    
    //  имя базы данных
    $database = "eat";
    
    //  имя пользователя базы данных
    $user = "root";
    
    //  пароль пользователя к базе данных
    $password = "";
    
    $link = mysqli_connect($host, $user, $password, $database);
    if($link->connect_errno){
        echo "Нет подключения к БД: " . $link->connect_errno. " | " . $link->connect_error;
    }
       
       //   Формируем запрос на получение общего колличества записей в таблице
       $result_count = mysqli_query($link, "SELECT COUNT(*) FROM {$this->tablename} {$this->where} {$this->order}"); 
       if($result_count == 0 ){
            echo "Не работает!";                 }
         $row = mysqli_fetch_array($result_count);   
         $count_res = $row[0];
      // var_dump($count_res);
       return $count_res;
   }
   
   public function get_pnumber() {
       //   Колличество позиций на странице
       return $this->pnumber;
   }
   public function get_page_link() {
       //   Колличество ссылок слева и справа от текущей страницы
       return $this->page_link;
   }
   public function get_parameters() {
       //   Доолнительные параметры которые необходимо передать по ссылке
       return $this->parameters;
   }
   public function get_page(){
       //   Текущая страничка
       $page = intval($_GET['page']);
       if (empty($page)) {
            $page = 1;
        }
        //  Колличество записей в файле
        $total = $this->get_total();
        //  Вычесляем число страниц в системе
        //var_dump($number);
        $number = (int)($total/$this->get_pnumber());
        if ((float) ($total / $this->get_pnumber()) - $number != 0) {
            $number++;
        }
        var_dump($number);      
        //  Проверяем опадает ли запрашиваемый номер страницы в интервал от 1 до get_total()
        if ($page <= 0 || $page > $number) {
            return 0;
        }
        //  Извлекаем позиции текущей страницы
        $arr = array();
        //  Номер, начиная с которого следует выбрать строки файла
        $first = ($page - 1)*$this->get_pnumber();
        //  Извлекаем позиции для текущей страницы
        $result = mysqli_query($link, "SELECT * FROM ($this->tablename) ($this->where) ($this->order) LIMIT $first, ($this->get_pnumber())");

        //  Если имееться хотя бы один элемент заполняем массив $arr
        if(mysqli_num_rows($result)){
            while ($arr[] = mysqli_fetch_array($result));
        }
        //  Удаляем последний нулевой элемент масивва $arr
        unset($arr[count($arr) - 1]);
        return $arr;
    }
}
