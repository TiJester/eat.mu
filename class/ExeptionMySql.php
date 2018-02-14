<?php

/*
 * TiJester
 * UA Odessa  * 
 */

/**
 * 2018(С) Шевченко Г.Ю.
 * Описание класа ExeptionMySql
 * Ошибки обращения к СУБД MySQL
 */

class ExeptionMySql extends Exeption{
    //  Сообщение об ошибке
    protected $mysqli_error;
    
    //  SQL запрос
    protected $sql_query;
    
    public function __consruct($mysqli_error, $sql_query, $massage)
    {
        $this->mysqli_error = $mysqli_error;
        $this->sql_query = $sql_query;
        
        //вызываем консруктор базового класса
        parent::__construct($massage);
        }
        
    public function getMySQLError()
    {
        return $this->mysqli_error;
    }
    
    public function getSQLQuery()
    {
        return $this->sql_query;
    }
}
