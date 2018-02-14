<?php

/*
 * TiJester
 * UA Odessa  * 
 */

/**
 * 2018(С) Шевченко Г.Ю.
 * Описание класа ExeptionMember
 * Обраение к несуществующему члену (Исключение)
 */

class ExeptionMember extends Exception{
    //  Имя не существующего члена
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
