<?php

/*
 * TiJester
 * UA Odessa  * 
 */

/**
 * 2018(С) Шевченко Г.Ю.
 * Конфигурация CMS
 * V 0.2.3
 */

    //  Выставляем уровень обработки ошибок
    error_reporting(E_ALL & ~E_NOTICE);
    
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); // Проверки ошибки MySQL

    //  адрес сервера
    $host = '127.0.0.1'; //"localhost"; //127.0.0.1
    
    //  имя базы данных
    $database = "eat";
    
    //  имя пользователя базы данных
    $user = "root";
    
    //  пароль пользователя к базе данных
    $password = "";
    
    //  порт подключения к базе данных
    #   $port = "3306";
    
    //
    #   $socket = "";
    
    //  Устанавливаем соединение с базой данных
    //$link = new mysqli($host, $user, $password, $database);

//    if(mysqli_connect_errno($link)){
//        echo "Не удалось подключиться к MySqli: ". mysqli_connect_error();
//    }
    
    //  Устанавливаем кодировку в которой будут отправляться данные MySQL серверу
/*    if(!mysqli_set_charset($link, "utf8"))
    {
        if(!function_exists('get_magic_quotes_gpc'))
        {
            function get_magic_quotes_gpc()
            {
                return FALSE;
            }
        }
    }
*/