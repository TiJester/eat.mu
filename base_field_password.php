<?php

/*
 * TiJester
 * UA Odessa  * 
 */

/**
 * 2018(С) Шевченко Г.Ю.
 * Описание класа base_field_password
 * Текстовое поле password
 * V 0.1
 */
//  Выставляем уровень обработки ошибок
    error_reporting(E_ALL & ~E_NOTICE);
    
class base_field_password extends base_field_text{
    //  Конструктор класса
    function __construct(
            $name,
            $caption,
            $is_required = FALSE,
            $value ="",
            $maxlength = 255,
            $size = 41,
            $parameters = "",
            $help = "",
            $help_url = "")
    {
        //  Вызываем клнстуктор базового класса base_field_text для инициализаци его данных
        parent::__construct(
                $name, 
                $caption,
                $is_required,
                $value,
                $maxlength,
                $size,
                $parameters,
                $help,
                $help_url);
        //  Класс base_field_text присваевает члену type значение text, для пароля присваеваем password
        $this->type = "password";
    }
}
