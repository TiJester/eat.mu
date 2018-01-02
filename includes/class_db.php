<?php

/*
 * TiJester
 * UA Odessa  * 
 */

/**
 * Description of class_db
 *
 * @author Grib
 */

//Расширяем класс MySQLi
class class_db extends mysqli{
    // единый экземпляр self, общий для всех экземпляров
    private static $instance = null;
    
    //конфигурация подключения к базе данных
    private $user = "root";
    private $pass = "";
    private $dbName = "eat_test_01012017";
    private $dbHost = "localhost";
}
