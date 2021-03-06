<?php

/* 
 * TiJester
 * UA Odessa
 */

/**
 * 2018(С) Шевченко Г.Ю.
 * Список пользователей с email
 * V 0.1.0
 */

    //  Подключаем все необходимые классы
    require_once ("config/config.php");
    
    try{
        $query = "SELECT * FROM users";
        $result = mysqli_query($link, $query);
        if(!$result){
            throw new ExceptionMySql(mysqli_error($link));
        }
        
        //  Если имееться хоть бы одна запись выводим список пользователей
        if(mysqli_num_rows($result)){ //    Получает число рядов в результирующей выборке
            while($user = mysqli_fetch_array($result)){ //   Выбирает одну строку из результирующего набора и помещает ее в ассоциативный массив, обычный массив или в оба 
                echo "<a href=edituser.php?id_user=$user[id_user]>".htmlspecialchars($user['name'], ENT_QUOTES)."</a>, <a href=edituser.php?id_user=$user[id_user]>".htmlspecialchars($user['email'], ENT_QUOTES)."</a></br>";
            }
        }
    } catch (ExceptionMySql $ex) {
    //  Обработка исключения при обращении к MySQL
    //  Включаем заголовок страницы
    echo "<p class=help> Произошла исключительная систуация <b> ExceptionMySql</b> при обращении к MySql</p>";
    echo "<p class=help> {$exc->getMySQLError()}<br>". /*n12br*/($exc->getSQLQuery())."</p>";  
    echo "<p class=help> Ошибка в файле{$exc->getFile()} в строке {$exc->getLine()}.</p>";
    exit();
}