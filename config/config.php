<?php

/*
 * TiJester
 * UA Odessa  * 
 */

/**
 * 2018(С) Шевченко Г.Ю.
 * Конфигурация CMS
 * V 0.2.1
 */

    //  Выставляем уровень обработки ошибок
    error_reporting(E_ALL & ~E_NOTICE);

    //  адрес сервера
    $host = "localhost"; //127.0.0.1
    
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
    $link = mysqli_connect($host, $user, $password, $database);
    if (!$link)
    {
         throw new ExceptionMySql(mysqli_error($link));
    }
    
    //  Устанавливаем кодировку в которой будут отправляться данные MySQL серверу
    if(!mysqli_set_charset($link, "utf8"))
    {
        if(!function_exists('get_magic_quotes_gpc'))
        {
            function get_magic_quotes_gpc()
            {
                return FALSE;
            }
        }
    }
