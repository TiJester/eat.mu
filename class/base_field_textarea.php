<?php

/*
 * TiJester
 * UA Odessa  * 
 */

/**
 * 2018(С) Шевченко Г.Ю.
 * Описание класа base_field_textarea
 * Текстовая область textarea
 * V 0.1
 */

//  Выставляем уровень обработки ошибок
error_reporting(E_ALL & ~E_NOTICE);

class base_field_textarea extends base_field{
    //  Размер текстового поля
    protected $cols;
    //  Максимальный размер вводимых данных
    protected $rows;
    //  Блокировка поля
    protected $disabled;
    // Только для чтения
    protected $readonly;
    //  Отсудствие автоперевода строк
    protected $wrap;

    //  Констуктор класса
    public function __construct(
            $name,
            $caption,
            $is_required = FALSE,
            $value = "",
            $cols = 35,
            $rows = 7,
            $disabled = FALSE,
            $readonly = FALSE,
            $wrap = FALSE,
            $parameters = "",
            $help = "",
            $help_url = "")
    {
        //  Вызываем констуктор базового класа для инициализации его данных
        parent::__construct(
                $name,
                "textarea",
                $caption,
                $is_required,
                $value,
                $parameters,
                $help,
                $help_url);
        //  Инициализируем члены класса base_field_textarea
        $this->cols = $cols;
        $this->rows = $rows;
        $this->disabled = $disabled;
        $this->readonly = $readonly;
        $this->wrap = $wrap;
    }

    //  Метод для возврата имени названия поля и самого тэга элемента управления
    public function get_html() {
        
        //  Если элементы оформления не пусты - учитываем их
        if(!empty($this->css_style)){
            $style = "style=\"".$this->css_style."\"";
        } 
        else 
        {
            $style = "";
        }       
        if(!empty($this->css_class)){
            $class = "class=\"".$this->css_class."\"";
        } 
        else
        {
            $class = "";
        }
        //  Если определены размеры, учитываем их
        if(!empty($this->cols)){
            $cols = "cols=".$this->cols;
        } 
        else
        {
            $cols = "";
        }
        if(!empty($this->rows)){
            $rows = "rows=".$this->rows;
        } 
        else 
        {
            $rows = "";
        }
        //  Атрибуты текстовой области
        if($this->disabled){$disabled = "disabled";} else {$disabled = "";}
        if($this->readonly){$readonly = "readonly";} else {$readonly = "";}
        if($this->wrap){$wrap = "wrap";} else{$wrap = "";} 
        if(is_array($this->value))
        {$this->value = implode("\r\n", $this->value);}
        if(get_magic_quotes_gpc()){
            $output = str_replace('\r\n', "\r\n", $this->value);
        } else {
            $output = $this->value;
            $tag = "<textarea $style $class name=\"".$this->name."\" $cols $rows $disabled $readonly $wrap>".htmlspecialchars($output, ENT_QUOTES)."</textarea>\n";
        }
        //  Если поле обязательное, помечаем его
        if($this->is_required){$this->caption.= "&nbsp;*";}
        //  Формируем подсказку если она есть
        $help = "";
        if(!empty($this->help)){$help .= "<span style='color:blue'>".n12br($this->help)."</span>";}
        if(!empty($help)){$help .= "<br>";}
        if(!empty($this->help_url)){$help .= "<span style='color:blue'><a href=".$this->help_url.">помощь</a></span>";}
        return array($this->caption, $tag, $help);
    }
    //  Метод, проверяющий корректность данных
    public function check() {
        //  Обезопасить текст перед внесением в базу данных
        if(!get_magic_quotes_gpc())
        {
        //    $this->value = mysqli_escape_string($this->value);
        }
        if($this->is_required)
        {
            if(empty($this->value)){
                return "Поле \"".$this->caption."\" не заполнено";
            }
        }
        return "";
    }
}
