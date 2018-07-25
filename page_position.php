<?php

/* 
 * TiJester
 * UA Odessa
 */

/**
 * 2018(С) Шевченко Г.Ю.
 * Постраничная навигация из БД
 * V 0.1.1
 */

    //  Устанавливаем соединение с БД
    require_once("config/config.php");

    //  Подключаем классы (постраничной навигации)
    require_once("config/class_config.php");
    
    try{
        //  Объявляем объект постраничнной навигации
        $obj = new pager_mysqli(
                "postions",
                "",
                "ORDER BY name");
        //  Выводим содержимое текущей страницы
        $arr = $obj->get_page();
        for($i = 0; $i < count($arr);$i++)
        {
            echo "<a href=position.php?id={$arr[$i][id_position]}>{$arr[$i][name]}</a><br>";
        }
        //  Выводим ссылки на другие страницы
        echo $obj;
    } catch (ExceptionMySql $ex) {
        require ("class/ExceptionMySql.php");
    }