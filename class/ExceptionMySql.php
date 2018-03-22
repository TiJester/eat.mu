<?php

/*
 * TiJester
 * UA Odessa  * 
 */

/**
 * 2018(С) Шевченко Г.Ю.
 * Описание класа ExceptionMySql
 * Ошибки обращения к СУБД MySQL
 */

//  Выставляем уровень обработки ошибок
error_reporting(E_ALL & ~E_NOTICE);

class ExceptionMySql extends Exception{
    //  Сообщение об ошибке
    protected $mysql_error;
    
    //  SQL запрос
    protected $sql_query;
    
    public function __consruct($mysql_error, $sql_query, $massage)
    {
        $this->mysql_error = $mysql_error;
        $this->sql_query = $sql_query;
        
        //вызываем консруктор базового класса
        parent::__construct($massage);
        }
        
    public function getMySQLError()
    {
        return $this->mysql_error;
    }
    
    public function getSQLQuery()
    {
        return $this->sql_query;
    }
}
