<?php

/* 
 * TiJester
 * UA Odessa  * 
 */

/**
 * 2018(С) Шевченко Г.Ю.
 * Страница постраничной навигации в деректории изображения
 * V 0.1.0
 */

//  Выставляем уровень обработки ошибок
error_reporting(E_ALL & ~E_NOTICE);

    require_once ("config/class_config.php");


    //  Объявляем объект постраничной навигации
    $obj = new pager_dir("photo", 3, 2);
    //  Выводим содержимое текущей страницы
    $arr = $obj->get_page();
    for($i=0; $i<count($arr); $i++){
        echo "<img src={$arr[$i]}&nbsp;&nbsp;&nbsp;>";
    }
    echo "<br>";
    
    //  Выводим ссылки на другие страницы
    echo $obj;