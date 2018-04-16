<?php

/*
 * TiJester
 * UA Odessa  * 
 */

/**
 * 2018(С) Шевченко Г.Ю.
 * Описание класа base_field_radio
 * Радио конопка
 * V 0.1
 */

//  Выставляем уровень обработки ошибок
error_reporting(E_ALL & ~E_NOTICE);

class base_field_radio extends base_field{
    //  Варианты ответов
    protected $radio;
    //  Констуктор класса
    function __construct(
            $name, 
            $caption, 
            $radio = array(),
            $value = "", 
            $parameters = "", //    horizontal
            $help = "", 
            $help_url = "") {
        //  Вызываем констуктор базового класса
        parent::__construct(
                $name, 
                "radio", 
                $caption, 
                FALSE, 
                $value, 
                $parameters, 
                $help,
                $help_url);
        //  Инициализируем члены класса
        if($this->radio != "radio_rate"){
            $this->radio = $radio;
        }
    }
    
    //  Метод возврата имени названия поля
    function get_html() {
        //  Если элементы оформление не пусты - учитываем их
        
    }
}
