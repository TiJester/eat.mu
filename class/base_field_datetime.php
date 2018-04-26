<?php

/*
 * TiJester
 * UA Odessa  * 
 */

/**
 * 2018(С) Шевченко Г.Ю.
 * Описание класа base_field_datetime
 * Дата и время
 * V 0.1
 */

//  Выставляем уровень обработки ошибок
error_reporting(E_ALL & ~E_NOTICE);

class base_field_datetime extends base_field{
    //  Время в time
    protected $time;
    //  Начальный год
    protected $begin_year;
    //  Конечный год
    protected $end_year;
    //  Констуктор класса
    function __construct(
            $name, 
            $caption, 
            $time,  
            $begin_year = 2000, 
            $end_year = 2020, 
            $parameters = "", 
            $help = "", 
            $help_url = "") {
        //  Конструктор базового класса
        parent::__construct(
                $name, 
                "datetime", 
                $caption, 
                FALSE, 
                $value, 
                $parameters, 
                $help, 
                $help_url);
        
        if(empty($time)){
            $this->time = time();
        }
        else if(is_array($time)){
            $this->time = mktime(
                    $time['hour'],
                    $time['minute'],
                    0,
                    $time['month'],
                    $time['day'],
                    $time['year']);
        }
        else{
            $this->time = $time;
            $this->begin_year = $begin_year;
            $this->end_year = $end_year;
        }
    }
    
    //  Дата в фомате MySQL
    function get_mysqli_format(){
        return date("Y-m-d H:i:s", $this->time);
    }
    
    //  Возвращаем имя названия поле и самого тэга управления
    function get_html() {
        //  Если элементы оформления не пусты, учитываем их
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
        
        //  Формируем тэг
        $date_month = @date("m", $this->time);
        $date_day = @date("d", $this->time);
        $date_year = @date("Y", $this->time);
        $date_hour = @date("H", $this->time);
        $date_minute = @date("i", $this->time);
        
        //  Выпадающий список для дня
        $tag = "<select title='День' $style $class type=text name='".$this->name."[day]'>\n";
        for($i = 1; $i <= 31; $i++){
            if($date_day == $i) {
                $temp = "selected";
            }
            else {
                $temp = "";
            }
            $tag .= "option value=$i $temp>".sprintf("%02d", $i);
        }
        $tag .= "</select>";
        //  Выпадающий список для месяца
        $tag .= "<select title='Месяц' $style $class type=text name'".$this->name."[month]'>";
        for($i = 1; $i <= 12; $i++){
            if($date_month == $i){
                $temp = "selected";
            }
            else{
                $temp = "";
            }
            $tag .= "<option value=$i $temp>".  sprintf("%02d", $i);
        }
        $tag .= "</select>";
        //  Выпадающий список года
        $tag .= "<select title='Год' $style $class type=text name='".$this->name."[year]'>";
        for($i = 2000; $i <= 2018; $i++){
            if($date_year == $i){
                $temp = "selected";
            }
            else{
                $temp = "";
            }
            $tag .= "<option value=$i $temp> $i";
        }
        $tag .= "</select>";
        //  Выпадающий список для часа
        $tag .= "&nbsp;&nbsp;<select title='Часы' $style $class type=text name'".$this->name."[hour]'>";
        for($i = 0; $i < 23; $i++){
            if($date_hour == $i) {
                $temp = "selected";
            }
            else {
                $temp = "";
            }
            $tag .= "<option value=$i $temp>". sprintf("%02d",$i);
        }
        $tag .= "<select>";
        //  Выпадающий список для минут
        $tag .= "<select title='Минуты' $style $class type=text name'".$this->name."[mitute]'>";
        for($i = 0; $i <=59; $i++){
            if($date_minute == $i){
                $temp = "selected";
            }
            else {
                $temp = "";
            }
            $tag .= "<option value=$i $temp>". sprintf("%02d", $i);
        }
        $tag .= "<select>";
        
        //  Если поле обязательно помечаем его
        if($this->is_required){
            $this->caption .= " *";
        }
        
        //  Формируем подсказку если она имееться
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
    
    //  Медод проверяющий корректность переданных данных
    function check() {
        if(date('Y', $this->time) > $this->end_year || date('Y', $this->time)< $this->begin_year){
            return "Поле \"".$this->caption."\" содержит недопустимое значение (его значение должно лежать в диапазоне".$this->begin_year."-".$this->end_year.")";
        }
        return "";
    }
}