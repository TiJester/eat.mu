<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of class_bd
 *
 * @author admin
 */
// Параметры соединения с базой данных
define('DB_SERVER', 'localhost');       // IP адрес сервера БД или если локальный ПК localhost
define('DB_USERNAME', 'root');         // Имя пользователя
define('DB_PASSWORD', ''); // Пароль пользователя
define('DB_DATABASE', 'test');        // Имя базы данных

class class_db extends mysqli // Расширяем класс для работы с БД
{
    public static $ConnectDB;	// Хранит результат соединения с базой данных
    public static $SelectDB;	// Хранит результат выбора базы данных
// Метод создает соединение с базой данных
    public static function ConnectDB($host, $user, $pass, $name)
    {
	// Пробуем создать соединение с базой данных
	self::$ConnectDB = mysql_connect($host, $user, $pass);

	// Если подключение не прошло, вывести сообщение об ошибке..
	if(!self::$ConnectDB)
	{
            echo "<p><b>К сожалению, не удалось подключиться к серверу MySQL</b></p>";
            exit();
            return false;
	}

	// Пробуем выбрать базу данных
	self::$SelectDB = mysql_select_db($name, self::$ConnectDB);

	// Если база данных не выбрана, вывести сообщение об ошибке..
	if(!self::$SelectDB)
	{
            echo "<p><b>".mysql_error()."</b></p>";
            exit();
            return false;
	}

	// Возвращаем результат
	return self::$ConnectDB;
    }
        // Метод закрывает соединение с базой данных
	public function Close()
	{
		// Возвращает результат
		return mysql_close(self::$ConnectDB);
	}    
}
