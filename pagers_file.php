<?php

/* 
 * TiJester
 * UA Odessa
 */

/**
 * 2018(С) Шевченко Г.Ю.
 * Страница постраничной навигации в файле
 * V 0.1.1
 */

    require_once ("config/class_config.php");
    //  Объявляем объект постраничной навигации
    $obj = new pager_file("words.txt", 25, 5);
    //  Выводим ссылки на другие страницы
    echo $obj;
    
    //  Выводим содержимое текущей страницы
    $arr = $obj->get_page();
    for($i = 0; $i < count($arr); $i++){
        echo "{$arr[$i]}<br>";
    }
    
    //  Выводим ссылки на другие страницы
    echo $obj;
