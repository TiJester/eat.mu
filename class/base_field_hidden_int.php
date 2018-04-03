<?php

/*
 * TiJester
 * UA Odessa  * 
 */

/**
 * 2018(С) Шевченко Г.Ю.
 * Описание класа base_field_hidden_int
 * Скрытое hidden с целочисленным значением
 * V 0.1
 */

//  Выставляем уровень обработки ошибок
error_reporting(E_ALL & ~E_NOTICE);

class base_field_hidden_int extends base_field_hidden {
    //  Метод проверяющий корректность переданных данных
    function check() {
        if($this->is_required){
            //  Поле обязательно к заполнению
            $pattern = "|^[\d]+$|";
            if(!preg_match($pattern, $this->value)){
                return "Скрытое поле должно быть целым числом";
            }
        }
        //  Поле не обязательно к заполнению
        $pattern = "|^[\d]*$|";
        if(!preg_match($pattern, $this->value)){
            return "Скрытое поле должно быть целым числом";
        }
        return "";
    }
}
