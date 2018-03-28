<?php

/*
 * TiJester
 * UA Odessa  * 
 */

/**
 * 2018(С) Шевченко Г.Ю.
 * Описание класа base_field_text_english
 * Текстовое поле для английского текста
 * V 0.1
 */
//  Выставляем уровень обработки ошибок
    error_reporting(E_ALL & ~E_NOTICE);
    
class base_field_text_english extends base_field_text{
    //  Метод проверяющий корректность переданных данных на английском
    function check()
    {
        //  Обезопасить текст перед внесением в базу
        if(!get_magic_quotes_gpc())
        {
            $this->value = mysqli_escape_string($this->value);
        }
        if($this->is_required)
        {
            $pattern = "|^[a-z]+$|i";
        }   
        else{
            $pattern = "|^[a-z]*$|i";
        }
        if(!preg_match($pattern, $this->value))
        {
            return "Поле \"{$this->caption}\" должно содержать только символы латинского алфавита";
        }
        return "";
    }
}
