<?php

/*
 * TiJester
 * UA Odessa  * 
 */

/**
 * 2018(С) Шевченко Г.Ю.
 * Описание класа base_field_select
 * Выпадающий список
 * V 0.1
 */

//  Выставляем уровень обработки ошибок
error_reporting(E_ALL & ~E_NOTICE);

class base_field_select {
    //  Размер текстового поля
    protected $options;
    //  Являеться ли список - мультисписком
    protected $multi;
    //  Высота списка
    protected $secect_size;
    //  Констуктор класса
    function __construct(
            $name,
            $caption,
            $option = array(),
            $value,
            $multi = FALSE,
            $select_size = 4,
            $parametrs = "") {
        //  Вызываем констуктор базового класса
        parent::__construct(
                $name,
                "select",
                $caption,
                FALSE,
                $value,
                $parametrs);
        //  Инициализируем члены класса
        $this->options = $option;
        $this->multi = $multi;
        $this->select_size = $select_size;
    }
    
    //  Метод для возврата имени названия поля и самого тега элемента упрпавления
    function get_html(){
        //  Если элементы управления не пусты учитываеи их
        if(!empty($this->css_style)){
            $style = "style = \"".$this->css_style."\"";
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
        
        if($this->multi && $this->secect_size){
            $multi = "multiple size=".$this->secect_size;
            $this->name = $this->name."[]";
        }
        else{
            $multi = "";
        }
        //  Формируем тег
        $tag = "<select $style $class name=\"".$this->name."\" $multi>\n";
        if(!empty($this->options)){
            foreach($this->options as $key => $value){
                if(is_array($this->value)){
                    if(in_array($key, $this->value)){
                        $selected = "selected";
                    }
                    else{
                        $selected = "";
                    }
                }
                else if($key == trim($this->value)){
                    $selected = "selected";
                }
                else{
                    $selected = "";
                }
                $tag .= "<option value='".htmlspecialchars($key, ENT_QUOTES)."' $selected>".htmlentities($value, ENT_QUOTES)."</option>\n";
            }
        }
        $tag .= "</select>";
        
        //  Формируем посдказку если она имееться
        $help = "";
        if(!empty($this->help)){
            $help .= "<span style='color=blue'>".n12br($this->help)."</span>";
        }
        if(!empty($help)){
            $help .= "<br>";
        }
        if(!empty($this->help_url)){
            $help .= "<span style='color:blue'><a href=".$this->help_url.">Помощь</a></span>";
        }
        return array($this->caption, $tag, $help);
    }
    
    //  Метод проверяющий корректность переданых данных
    function check(){
        //  Получаем список возможных значений списка
        if(!in_array($this->value, array_keys($this->options))){
            if(empty($this->value)){
                return "Поле \"".$this->caption."\" содержит не допустимое значение";
            }
        }
        if (!get_magic_quotes_gpc()){
            for($i = 0; $i < count($this->value); $i++){
                $this->value[$i] = mysqli_escape_string($this->value[$i]);
            }
        }
        return "";
    }
    
    //  Выбраный элемент
    function selected(){
        return $this->value[0];
    }
}
