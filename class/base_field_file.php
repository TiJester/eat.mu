<?php

/*
 * TiJester
 * UA Odessa  * 
 */

/**
 * 2018(С) Шевченко Г.Ю.
 * Описание класа base_field_file
 * Загрузка файла
 * V 0.1.2
 */

//  Выставляем уровень обработки ошибок
error_reporting(E_ALL & ~E_NOTICE);

class base_field_file {
    //  Дириктория назначения
    protected $dir;
    //  Префикс
    protected $prefix;
    //  Констуктор класса
    function __construct(
            $name,
            $caption,
            $is_required = FALSE,
            $value, // $_FILES
            $dir,
            $prefix ="",
            $help = "",
            $help_url = "") {
        //  Вызываем класс базового класса
        parent::__construct(
                $name,
                "file",
                $caption,
                $is_required,
                $value,
                "",
                $help,
                $help_url);
        $this->dir = $dir;
        $this->prefix = $prefix;
        
        if(!empty($this->value)){
            //  Проверяем не являеться ли файл скриптом
            $extention = array(
                "#\.php#is",
                "#\.phtml#is",
                "#\.php3#is",
                "#\html#is",
                "#\htm#is",
                "#\hta#is",
                "#\pl#is",
                "#\xml#is",
                "#\inc#is",
                "#\shtml#is",
                "#\xht#is",
                "#\xhtml#is");
            //  Заменяем русские символы на трансит
            $this->value[$this->name]['name'] = $this->encodestring($this->value[$this->name]['name']);
            //  Извлиаем из имени файла расширение
            $path_parts = pathinfo($this->value[$this->name]['name']);
            $ext = ".".$path_parts['extension'];
            $path = basename($this->value[$this->name]['name'], $ext);
            $add = $ext;
            foreach($extention AS $exten)
            {
                if(preg_match($exten, $ext)) $add = ".txt";
            }
            $path .= $add;
            $path = str_replace("//","/",$dir."/".$prefix.$path);
            //  Перемещаем файл из временной деректории в постоянную
            if(copy($this->value[$this->name]['tmp_name'], $path)){
                //  Удаляем файл во временной директории
                @unlink($this->value[$this->name]['tmp_name']);
                //  Изменяем права доступа к файлу
                @chmod($path, 0644);
            }
        }
    }
    //  Метод для возврата имени поля
    function  get_html(){
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
        
        //  формируем тэг
        $tag = "<input $style $class type=\"".$this->type."\" name=\"".$this->name."\"> \n";
        
        //  Если поля обязательно, помечаем его
        if($this->is_required){
            $this->caption .= " *";
        }
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
    
    //  Метод проверяющий корректность переданых данных
    function  check(){
        if($this->is_required){
            if(!empty($this->value[$this->name])){
                return "Поле \"".$this->caption."\" не заполнено";
            }
        }
        return "";
    }
    //  Возвращает перекодированое имя файла
    function get_filename(){
        if(!empty($this->value)){
            if(!empty($this->value[$this->name]['name'])){
                return mysqli_escape_string($this->encodestring($this->prefix.$this->value[$this->name]));
            }
            else{
                return "";
            }
        }
        else{
            return "";
        }
    }
}
