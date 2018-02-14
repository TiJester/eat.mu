<?php

/*
 * TiJester
 * UA Odessa  * 
 */

/**
 * 2018(С) Шевченко Г.Ю.
 * Описание класа ExceptionObject
 * Обращение к объекту, отличному от base_field - производного
 */

class ExceptionObject extends Exeption{
    //  Имя объекта
    protected $key;
    
    public function __construct($key, $massage) 
    {
        $this->key = $key;
        
        //Вызываем конструктор базового класса
        parent::__construct($key, $massage);
    }
    
    public function getKey()
    {
        return $this->key;
    }
}
