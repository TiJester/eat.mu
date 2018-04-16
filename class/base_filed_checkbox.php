<?php

/*
 * TiJester
 * UA Odessa  * 
 */

/**
 * 2018(С) Шевченко Г.Ю.
 * Описание класа base_filed_checkbox
 * Флажок
 * V 0.1
 */

//  Выставляем уровень обработки ошибок
error_reporting(E_ALL & ~E_NOTICE);

class base_filed_checkbox extends base_field{
    //  Констуктор класса
    function __construct(
            $name, 
            $caption, 
            $value = "", 
            $parameters = "", 
            $help = "", 
            $help_url = ""
            ) {
        //  Вызываем констуктор базового класса
        parent::__construct(
                $name, 
                "checkbox", 
                $caption, 
                FALSE, 
                $value, 
                $parameters, 
                $help, 
                $help_url);
        //  Инициализируем члены класса
        if($value == "on"){
            $this->value = TRUE;
        }
        else if($value === TRUE) {
            $this->value = TRUE;
        }
        else{
            $this->value = FALSE;
        }
    }
    
    //  Метод возырата имени названия поля и самого тега управления
    function get_html() {
        //  Если элементы управления не пусты учитываем их
        if(!empty($this->css_style)){
            $style = "style=\"".$this->css_style."\"";
        }
        else {
            $style = "";
            if(!empty($this->css_class)){
                $class = "class=\"".$this->css_class."\"";
            }
            else {
                $class = "";
            }
        }
        
        //  Проверяем отмечен ли флажок
        if($this->value){
            $checked = "checked";
        }
        else{
            $checked = "";
        }
        
        //  Формируем тег
        $tag = "<input $style $class
            type=\"".$this->type."\"
            name=\"".$this->name."\"
            $checked>\n";
        
        //  Формируем подсказку
        $help = "";
        if(!empty($this->help)){
            $help .= "<span style='color:blue'>".n12br($this->help)."</span>";
        }
        if(!empty($help)){
            $help .= "<br>";
        }
        if(!empty($this->help_url)){
            $help .= "<span style ='color:blue'> <a href=".$this->help_url.">помощь</a></span>";
        }
        return array($this->caption, $tag, $help);
    }
    
    //  Метод проверяющий корректность переданных данных
    function check() {
        return "";
    }
}
