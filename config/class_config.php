<?php

/*
 * TiJester
 * UA Odessa 
 */

/**
 * 2018(С) Шевченко Г.Ю.
 * Конфигурация классов CMS
 * V 0.1.1
 * 13 включений
 */

    //  Выставляем уровень обработки ошибок
    error_reporting(E_ALL & ~E_NOTICE);
    
    require_once ("class/base_field.php"); //   Базовый класс
    require_once ("class/base_field_text.php"); //  Класс текстового поля
    require_once ("class/base_field_text_email.php"); //    Класс корректности поля email
    require_once ("class/base_field_text_english.php"); //  Класс проверки корреткности на латиницу
    require_once ("class/base_field_text_int.php"); //  Класс проверки на целочисленное значение
    require_once ("class/base_field_textarea.php"); //  Класс текстовой обости textarea
    require_once ("class/base_field_password.php"); //  Класс текстового поля со скрытым значением
    require_once ("class/base_field_hidden.php"); //    Класс скрытого поля
    require_once ("class/base_field_hidden_int.php"); //    Класс скрытого поля с целочисленым значением
    
    require_once ("class/form.php"); // Класс формирование формы
    
    require_once ("class/ExceptionMember.php"); //  Исключения к несуществующему элементу
    require_once ("class/ExceptionMySql.php"); //  Исключения Запросов
    require_once ("class/ExceptionObject.php"); //  Исключения объектов