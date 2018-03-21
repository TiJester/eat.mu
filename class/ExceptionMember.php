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

//  Выставляем уровень обработки ошибок
error_reporting(E_ALL & ~E_NOTICE);

class ExceptionMember extends Exception{
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
