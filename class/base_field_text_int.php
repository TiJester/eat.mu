<?php

/*
 * TiJester
 * UA Odessa  * 
 */

/**
 * 2018(С) Шевченко Г.Ю.
 * Описание класа base_field_text_int
 * Текстовое поле для вывода целочисленого значения
 * V 0.1
 */
//  Выставляем уровень обработки ошибок
    error_reporting(E_ALL & ~E_NOTICE);
    
class base_field_text_int extends base_field_text{
    //  Минимальное значение поля
    protected $min_value;
    //  Максимальное значение поля
    protected $max_value;
    
    public function __construct(
            $name,
            $caption,
            $is_required = FALSE,
            $valie = "",
            $min_value = 0,
            $max_value = 0,
            $maxlength = 255,
            $size = 41,
            $parameters = "",
            $help = "",
            $help_url = "") 
    {
        //  Вызываем констуктор базового класса для инициализации его данных
        parent:: __construct(
                $name, 
                $caption,
                $is_required,
                $valie,
                $maxlength,
                $size,
                $parameters,
                $help,
                $help_url);
        $this->min_value = intval($min_value);
        $this->max_value = intval($max_value);
        
        //  Минимальное значение должно быль больше максимального
        if($this->min_value > $this->max_value)
        {
            throw Exception("Минимальное значение должно быль больше максимального значения. Поле \"".$this->caption."\".");
        }
    }
    
    //  Метод, проверяющий корректность переданных данных
    function check() {
        $pattern = "|^[-\d]*$|i";
        if($this->is_required)
        {
            //  Проверяем поле value на максимальное и минимальное значение
            if($this->min_value != $this->max_value)
            {
                if($this->value < $this->min_value || $this->value > $this->max_value)
                {
                    return "Поле \"".$this->caption."\" должно быль больше ".$this->min_value." и меньше ".$this->max_value."";
                }
            }
            $pattern = "|^[-\d]+$|i";
        }
        
        //  Проверяем, являеться ли введеное значение целым числом
        if(!preg_match($pattern, $this->value))
        {
            return "Поле \"".$this->caption."\" должно содержать лиш цифры";
        }
        return "";
    }
}
