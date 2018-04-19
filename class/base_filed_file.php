<?php

/*
 * TiJester
 * UA Odessa  * 
 */

/**
 * 2018(С) Шевченко Г.Ю.
 * Описание класа base_filed_file
 * Загрузка файла
 * V 0.1
 */

//  Выставляем уровень обработки ошибок
error_reporting(E_ALL & ~E_NOTICE);

class base_filed_file {
    //  Дириктория назначения
    protected $dir;
    //  Префикс
    protected $prefix;
    //  Констуктор класса
    function __construct(
            $name,
            $caption,
            $is_required = FALSE,
            $value, // $_FILES
            $dir,
            $prefix ="",
            $help = "",
            $help_url = "") {
        //  Вызываем класс базового класса
        parent::__construct(
                $name,
                "file",
                $caption,
                $is_required,
                $value,
                "",
                $help,
                $help_url);
        $this->dir = $dir;
        $this->prefix = $prefix;
        
        
        
    }
}
