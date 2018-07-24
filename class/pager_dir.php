<?php

/*
 * TiJester
 * UA Odessa  * 
 */

/**
 * 2018(С) Шевченко Г.Ю.
 * Описание класа pager_dir
 * Постаничная навигация для директории
 * V 0.1.2
 */

//  Выставляем уровень обработки ошибок  
error_reporting(E_ALL & ~E_NOTICE);

//  Подключаем базовый класс
require_once ("pager_abstract.php");

class pager_dir extends pager_abstract{
    //  Конструктор
    public function __constuct(
            $dirname,
            $pnumber = 10,
            $page_link = 3,
            $parameters = "")
    {
        //  Удаляем последний символ /, если он имееться
        $this->dirname = trim($dirname, "/");
        $this->pnumber = $pnumber;
        $this->page_link = $page_link;
        $this->parameters = $parameters;
    }
    public function get_total() {
        $countline= 0;
        //  Открываем директорию
        if(($dir = opendir($this->dirname)) !== FALSE)
        {
            while(($file = readdir($dir)) !== FALSE){
                //  Если текущая позиция являеться файлом учитываем ее
                if(is_file($this->dirname."/".$file)) $countline++;
            }
            //  Закрываем директорию
            closedir($dir);
        }
        return $countline;   
    }
    
    //  Возвращает массив строк файла по номмеру страницы $index
    public function get_page(){
        //  Текущая страница
        $page = $_GET['page'];
        if(empty($page)) {
            $page = 1;
        }
        //  Количество записей в файле 
        $total = $this->get_total();
        //  Вычисляем количество страниц в системе
        $number = (int)($total/$this->get_pnumber());
        if ((float)($total/$this->get_pnumber()) - $number != 0) {
            $number++;
        }
        //  Проверяем, попадает ли запрашиваемый номер страницы в интервал от 1 до get_total()
        if ($page <= 0 || $page > $number) {
            return 0;
        }
        //  Извлекаем позиции текущей страницы
        $arr = array();
        //  Номер,начиная с которого следует выбирать стоки файла
        $first = ($page - 1)*$this->get_pnumber();
        //  Открываем директорию
        if (($dir = opendir($this->dirname)) === FALSE) {
            return 0;
        }
        $i = -1;
        while(($file = readdir($dir)) !== FALSE){
            //  Если текущая страница являеться файлом
            if(is_file($this->dirname."/".$file)){
                //  Увеличиваем счетчик
                $i++;
                //  Пока не достигнут номер $first досрочно заканчиваем итерецию
                if ($i < $first)continue;
                //  Если достигнут конец выборки досрочно покидаем цикл
                if ($i > $first + $this->get_pnumber() - 1)break;
                //  Помещаем пути файлам в массив который будет возвращен методом
                $arr[] = $this->dirname."/".$file;
            }
        }
        //  Закрываем директорию
        closedir($dir);
        return $arr;
    }
}