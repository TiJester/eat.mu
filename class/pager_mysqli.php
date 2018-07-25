<?php

/*
 * TiJester
 * UA Odessa  * 
 */

/**
* 2018(С) Шевченко Г.Ю.
* Описание класа pager_mysqli
* Постраничная навигация для базы данных
* V 0.1.1
*/
  // Выставляем уровень обработки ошибок 
  error_reporting(E_ALL & ~E_NOTICE);
  
  //    Подключаем все необходимые классы
  require_once ("config/class_config.php");
  //    Подклчаем конфиг для подключения к БД
  require_once ($_SERVER['DOCUMENT_ROOT']."/config/config.php");
  
  
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
       //   Формируем запрос на получение общего колличества записей в таблице
       $query = "SELECT COUNT(*) FROM {$this->tablename} {$this->where} {$this->order}";
       $result = mysqli_query($link, $query);
       if(!$result){
           throw new ExceptionMySql(mysqli_error($link));
       }
       return mysqli_result($result, 0);
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
        $number = (int)($total/$this->get_pnumber());
        if ((float) ($total / $this->get_pnumber()) - $number != 0) {
            $number++;
        }
        //  Проверяем опадает ли запрашиваемый номер страницы в интервал от 1 до get_total()
        if ($page <= 0 || $page > $number) {
            return 0;
        }
        //  Извлекаем позиции текущей страницы
        $arr = array();
        //  Номер, начиная с которого следует выбрать строки файла
        $first = ($page - 1)*$this->get_pnumber();
        //  Извлекаем позиции для текущей страницы
        $query = "SELECT * FROM ($this->tablename) ($this->where) ($this->order) LIMIT $first, ($this->get_pnumber())";
        $result = mysqli_query($link, $query);
        if(!$result){
            throw new ExceptionMySql(mysqli_error($link), $query, "Ошибка извлечение позиций");
        }
        //  Если имееться хотя бы один элемент заполняем массив $arr
        if(mysqli_num_rows($result)){
            while ($arr[] = mysqli_fetch_array($result));
        }
        //  Удаляем последний нулевой элемент масивва $arr
        unset($arr[count($arr) - 1]);
        return $arr;
    }
}
