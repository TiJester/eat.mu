<?php

/*
 * TiJester
 * UA Odessa  * 
 */

/**
 * 2018(С) Шевченко Г.Ю.
 * Описание класа parger_abstract
 * Абстрактный класс постраничной навигации __toString()
 * V 0.1.0
 */

//  Выставляем уровень обработки ошибок
 error_reporting(E_ALL & ~E_NOTICE);

abstract class parger_abstract extends parger{
    //  Имя директории
    protected $dirname;
    //  Колличество позиций на странице
    protected $pnumber;
    //   Колличество ссылок слева и справа от текйщей страницы
    protected $page_link;
    //  Параметры
    protected $parameters;
    //  Конструктор
    public function __construct(
            $dirname,
            $pnumber = 10,
            $page_link = 3,
            $parameters = "") {
        //  Удаляем последний символ елси он есть
        $this->dirname = trim($dirname,"/");
        $this->pnumber = $pnumber;
        $this->page_link = $page_link;
        $this->parameters = $parameters;
    }
    public function get_pnumber(){
        //  Колличество позиций на странице
        return $this->pnumber;
    }
    public function get_page_link(){
        //  Колличество ссылок слева и справа
        return $this->page_link;
    }
    public function get_parameters(){
        //  Дополнительные параметры которые необходимо передать по ссылке
        return $this->parameters;
    }
}
