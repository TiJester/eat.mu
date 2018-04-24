<?php

/*
 * TiJester
 * UA Odessa  * 
 */

/**
 * 2018(С) Шевченко Г.Ю.
 * Описание класа base_field_paragraph
 * Параграф
 * V 0.1.1
 */

//  Выставляем уровень обработки ошибок
error_reporting(E_ALL & ~E_NOTICE);

class base_field_paragraph extends base_field{
    //  Констуктор класса
    function __construct(
            $value,
            $parameters = ""){
        //  Вызываем конструктор базового класса
        parent::__construct(
                "",
                "paragraph",
                "",
                FALSE, 
                $value,
                $parameters,
                "",
                "");
    }
    //  Возващаем имя поля и самого тэга управления
    function get_html() {
        //  Формируем тэг
        $tag = htmlspecialchars($this->value, ENT_QUOTES);
        $pattern = "#\[b\](.+)\[\/b\]#isU";
        $tag = preg_replace($pattern, '<b>\\1</b>',$tag);
        $pattern = "#\[i\](.+)\[\/i\]#isU";
        $tag = preg_replace($pattern, '<i>\\1</i>' ,$tag);
        $pattern = "#[url\][\s]*((?=http:)[\S]*)[\s]*\[\/url\]#si";
        $tag = preg_replace($pattern, '<a href="\\1" target=_blank>\\1</a>', $tag);
        $pattern = "#\[url[\s]*=[\s]*((?=http:)[\S]+)[\s]*\][\s]*([^\[]*)\[/url\]#isU";
        $tag = preg_replace($pattern, '<a href="\\1" target=_blank>\\2</a>' ,$tag);
        if(get_magic_quotes_gpc()){
            $tag = stripcslashes($tag); // может строку 60 сюда!
        }
        return array($this->caption, n12br($tag));
    }    
    //  Метод проверяющий корректность переданых данных
    function check(){
        return "";
    }
}
