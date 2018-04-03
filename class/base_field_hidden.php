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
    
    //  Метод для возврата имени названия поля и самого тега элемента управления
    function get_html() {
        $tag ="<input type=\"".$this->type."\" name=\"".$this->name."\" value=\"".  htmlspecialchars($this->value, ENT_QUOTES)."\">\n";
        return array("", $tag);
    }
    
    //  Метод для проверки корректности переданных данных
    function check() {
        if(!get_magic_quotes_grp()){
            $this->value =  mysqli_escape_string($link, $query);
        }
        if($this->is_required){
            if(empty($this->value)){
                return "Скрытое поле не заполнено";
            }
        }
        return "";
    }
}
