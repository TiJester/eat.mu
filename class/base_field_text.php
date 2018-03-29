<?php

/*
 * TiJester
 * UA Odessa  * 
 */

/**
 * 2018(С) Шевченко Г.Ю.
 * Описание класа base_field_text
 * Текстовое поле text
 * V 0.1
 */

//  Выставляем уровень обработки ошибок
error_reporting(E_ALL & ~E_NOTICE);

class base_field_text extends base_field{
    //  Размер текстового поля
    public $size;
    
    //  Максимальный размер текстового поля
    public $maxlength;
    
    //  Конструктор класса
    function __construct(
            $name, 
//            $type, 
            $caption, 
            $is_required = FALSE, 
            $value ="", 
            $maxlength = 255,
            $size = 41,
            $parameters = "", 
            $help = "", 
            $help_url = "") 
        {
        //  Вызываем конструктор базового класса base_field 
        //  для инициализации его данных
        parent::__construct(
                $name, 
                "text", 
                $caption, 
                $is_required, 
                $value, 
                $parameters, 
                $help, 
                $help_url);
        // Инициализируем члены класса
        $this->size = $size;
        $this->maxlength = $maxlength;
        }
        
    //  Метод, для возврата инени названия поля и самого тега элемента управления
    function get_html() {
        //  Если элементы оформление не пусты - учитываем их
        if(!empty($this->css_style))
        {
            $style = "style=\"".$this->css_style."\"";
        }
        else $style = "";
        if(!empty($this->css_class))
        {
            $class = "class=\"".$this->css_class."\"";
        }
        else $class = "";
        
        //  Если определены размеры - учитываем их
        if(!empty($this->size)) {
            $size = "size=".$this->size;
        }
        else $size = "";
        if(!empty($this->maxlength))
        {
            $maxlenght = "maxlenght=".$this->maxlength;
        }
        else $maxlenght ="";
        
        //  Формируем тег
        $tag = "<input $style $class
               type=\"".$this->type."\"
               name=\"".$this->name."\"
               value=\"".
               htmlspecialchars($this->value, ENT_QUOTES)."\"
               $size $maxlength> \n";
        
        //  Если поле обязательное, помечаем его
        if($this->is_required) $this->caption.= "&nbsp;*";
        
        //  Формируем подсказку если она есть
        $help ="";
        if(!empty($this->help))
        {
            $help .= "<span style='color:blue'>".n12br($this->help)."</span>";
        }
        if(!empty($help)) $help .= "<br>";
        if(!empty($this->help_url))
        {
            $help .= "<span style='color:blue'><a href=".
            $this->help_url.">Помощь</a></span>";
        }
        return array($this->caption, $tag, $help);
    }    
    
    //Метод проверяющий корректность переданных данных
    public function check() {
        // Обезопасить текст перед внесением в базу данных
        if (!get_magic_quotes_gpc());
        {
        //    $this->value = $dbcon->real_escape_string($this->value);
        }

        // Если поле обязательно для заполнения
        if ($this->is_required)
        {
            // Проверяем не пустое ли оно
            if(empty($this->value))
            {
                return "Поле <b>\"".$this->caption."\"</b> не заполнено";
            }
        }
        return "";
    }
}
