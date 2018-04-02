<?php

/*
 * TiJester
 * UA Odessa  * 
 */

/**
 * 2018(С) Шевченко Г.Ю.
 * Описание класа base_field_hidden
 * Скрытое hidden
 * V 0.1
 */

//  Выставляем уровень обработки ошибок
error_reporting(E_ALL & ~E_NOTICE);

class base_field_hidden extends base_field{
    //  Конструктор класса
    function __construct(
            $name, 
            $is_required = FALSE,
            $value ="") {
        //  Вызываем констуктор базового класса
        parent::__construct(
                $name, 
                "hidden", 
                "-", 
                $is_required, 
                $value, 
                $parameters, 
                "", 
                "");
    }
}
