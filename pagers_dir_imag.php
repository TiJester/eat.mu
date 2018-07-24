<?php

/* 
 * TiJester
 * UA Odessa  * 
 */

/**
 * 2018(С) Шевченко Г.Ю.
 * Страница постраничной навигации в деректории изображения
 * V 0.1.1
 */

    require_once("config/class_config.php");

    //  Объявляем объект постраничной навигации
    $obj = new pager_dir("photo", 3);
    
    //  Выводим содержимое текущей страницы
    $arr = $obj->get_page();
    for($i=0; $i<count($arr); $i++){
        echo "<img src={$arr[$i]}&nbsp;&nbsp;&nbsp;>";
    }
    echo "<br>";
        
    //  Выводим ссылки на другие страницы
    echo $obj->print_page();