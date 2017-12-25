<?php // тестовое соединение
// Загружаем соединение с базой данных
require_once 'includes/class_db.php';

// Соединение с базой данных
class_db::ConnectDB(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

// Выполняет запрос к базе данных
$result = mysql_query("SELECT VERSION() AS VERSION");

// Обрабатывает ряд результата запроса и возвращает ассоциативный массив
$row = mysql_fetch_assoc($result);

// Выводит версию сервера MySQL
echo "MySQL: ".$row['VERSION'];

// Закрываем соединение с базой данных
class_db::Close();
// тестовое соединение
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
<!--шапка    -->
    <body>
        <header>
<!--шапка-->
    Привет Шапка
        <?php
        // put your code here
        ?>          
        </header>
<!--шапка-->
<!--тело-->
<div>
    тело
</div>
<!--тело-->
<!--Низ-->
        <footer>
    Привет футер        
        </footer>
<!--Низ-->
    </body>
</html>
