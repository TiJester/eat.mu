<?php 
//require_once ("includes/class_db.php");
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
    <br/>
    <form name="main" action="main.php" method="GET">
        <input type="text" name="user" value="user" />
        <input type="submit" value="Показать" />
        <br>Вы зарегшестрированы?<a href="createNewUser.php">Регистраци</a>
    </form>         
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
