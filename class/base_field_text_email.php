<?php

/*
 * TiJester
 * UA Odessa  * 
 */

/**
 * 2018(С) Шевченко Г.Ю.
 * Описание класа base_field_text_email
 * Текстовое поле email
 * V 0.1
 */

//  Выставляем уровень обработки ошибок
error_reporting(E_ALL & ~E_NOTICE);

class base_field_text_email extends base_field_text{
    //  Метод, проверяющий корректность переданных данных
    function check() {
        if($this->is_required || !empty($this->value))
        {
            $pattern = "#^[-0-9a-z_\.]+@[0-9a-z_^\.]+\.[a-z]{2,6}$#i";
            if(!preg_match($pattern, $this->value))
            {
                return "Введите e-mail в виде <i><b>email@mymail.com</b></i>";
            }
        }
        return "";
    }
}
