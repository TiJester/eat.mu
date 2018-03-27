<?php

/*
 * TiJester
 * UA Odessa  * 
 */

/**
 * 2018(С) Шевченко Г.Ю.
 * Описание класса ExeptionMember
 * Обраение к несуществующему члену (Исключение)
 * ошибки класса, связанные с обращением к несуществующим членам кассов. 
 * Как правило, это исключение генерируется в специаьных методах _get ( ) И _set ( ) ;
 * V 0.1
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
        parent::__construct($key, $massage); //$massage обзательный
    }
    
    public function getKey()
    {
        return $this->key;
    }
}
