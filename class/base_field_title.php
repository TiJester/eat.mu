<?php

/*
 * TiJester
 * UA Odessa  * 
 */

/**
 * 2018(С) Шевченко Г.Ю.
 * Описание класа base_field_title
 * Заголовок
 * V 0.1.1
 */

//  Выставляем уровень обработки ошибок
error_reporting(E_ALL & ~E_NOTICE);


class base_field_title extends base_field{
    //  Размер заголовка 1, 2, 3, 4, 5, 6 для h1, h2, h3, h4, h5, h6
    protected $h_type;
    //  Констуктор класса
    function __construct(
            $value,
            $h_type = 3,
            $parameters = ""){
        //  Вызываем конструктор базового класса
        parent::__construct(
                "",
                "title",
                "",
                FALSE, 
                $value,
                $parameters,
                "",
                "");
        // Проверяем диапазон заголовков
        if($h_type > 0 && $h_type < 7){
            $this->h_type = $h_type;
        }
        else{
            $this->h_type = 3;
        }
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
        $tag = "<h".$this->h_type.">".$this->value."</h>".$this->h_type.">";
        return array($this->caption, $tag);
    }    
    //  Метод проверяющий корректность переданых данных
    function check(){
        return "";
    }
}
