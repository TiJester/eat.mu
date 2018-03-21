<?php

/*
 * TiJester
 * UA Odessa  * 
 */

/**
 * 2018(С) Шевченко Г.Ю.
 * Конфигурация CMS
 * V 0.2
 */

    //  Выставляем уровень обработки ошибок
    error_reporting(E_ALL & ~E_NOTICE);
    
    //  адрес сервера
    $host = "localhost";
    
    //  имя базы данных
    $database = "eat";
    
    //  имя пользователя базы данных
    $user = "root";
    
    //  пароль пользователя к базе данных
    $password = "";
    
    // 
    #   $port = "";
    
    //
    #   $socket = "";
    
    //  Устанавливаем соединение с базой данных
    $dbcon = @mysqli_connect($host, $user, $password, $database /*, $port, $socket*/);
    if (!$dbcon)
    {
        throw new ExceptionMySql(mysql_error(),
                "connection",
                "Невозможно установить соединение с MySQL-сервером");
    //exit ("<p>В настоящее время сервер базы данных не доступен, поэтому корректное отображение страницы не возможно</p>");
    }
    
    //  Выбираем базу данных 
    if(!@mysqli_select_db($database, $dbcon))
    {
        throw new ExeptionMySql(mysql_error(),
                "connection",
                "Ошибка выбора базы данных");
    //exit("<p>В настоящий момент база данных не доступна, поэтому корректное отображение страницы не возможно</p>");
    }    
    
    //  Устанавливаем кодировку
    //  в которой будут отправляться данные MySQL серверу
    @mysqli_query("SET NAMES", 'utf-8');

    if(!function_exists('get_magic_quotes_gpc'))
    {
        function get_magic_quotes_gpc()
        {
            return FALSE;
        }
    }
    