<?php

/*
 * TiJester
 * UA Odessa  * 
 */

/**
 * 2018(С) Шевченко Г.Ю.
 * Описание класа base_field_radio
 * Радио конопка
 * V 0.1.1
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
        if(!empty($this->css_style)){
            $style = "style=\"".$this->css_style."\"";
        }
        else{
            $style = "";
        }
        
        if(!empty($this->css_class)){
            $class = "class=\"".$this->css_class."\"";
        }
        else{
            $class = "";
        }
        $this->type = "radio";
        
        //  Формируем тэг
        $tag = "";
         if(!empty($this->radio)){
             foreach ($this->radio as $key => $value) {
                 if($key == $this->value){
                     $checked = "checked";
                 }
                 else{
                     $checked = "";
                 }
                 
                 if(strpost($this->parameters, "horizontal") !== FALSE){
                     $tag .= "<input $style $class type=".$this->type."name=".$this->name."[]$checked value='$key'>$value";
                 }
                 else{
                     $tag[] = "<input $style $class type=".$this->type."name=".$this->name."[]$checked value='$key'>$value";
                 }
             }
         }
         
         // Формируем подсказку если она имееться
         $help = "";
         if(!empty($this->help)){
             $help .= "<span style'color:blue'>".n12br($this->help)."</span>";
         }
         if(!empty($help)){
             $help .= "<br>";
         }
         if(!empty($this->help_url)){
             $help .= "<span style='color:blue'> <a href=".$this->help_url.">Помощь<a> </span>";
         }
         return array($this->caption, $tag, $help);
    }
    
    //  Проверяем корректность переданых данных
    function check() {
        //  Получаем список возможных значений
        if(!get_magic_quotes_gpc()){
            $this->value =  mysqli_escape_string($this->value);
        }
        if(!@in_array($this->value, array_keys($this->radio))){
            if(empty($this->value)){
                return "Поле \"".$this->caption."\" содержит недопустимое значение";
            }
        }
        return "";
    }
}
