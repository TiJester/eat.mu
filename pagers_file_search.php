<?php

/* 
 * TiJester
 * UA Odessa
 */

/**
 * 2018(С) Шевченко Г.Ю.
 * Страница постраничной навигации и поиска в файле
 * V 0.1.0
 */

    require_once("config/class_config.php");
    //  Объявляем объект постраничной навигации
    $obj = new pager_file_search(
            "ab",
            "words_test.txt",
            5,
            2);
    //  Выводим содержимое текущей страницы
    $arr = $obj->get_page();
    for($i = 0; $i < count($arr); $i++){
        echo "{$arr[$i]}<br>";
    }
    
    //  Выводим ссылку на другие объекты
    echo $obj->print_page();