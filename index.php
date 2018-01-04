<?php 
require_once ("includes/class_db.php");
$logonSuccess = FALSE;// нет подключения

//проверяет учетные данные пользователя
if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    $logonSuccess = (class_db::getInstance()->verify_user_credentials($_POST['user'],$_POST['userpassword']));
    if ($logonSuccess == TRUE)
    {
        session_start();
        $_SESSION['user'] = $_POST['user'];
        header('Location: editUserList.php');
        exit;
    }
}
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
<center>Привет Шапка</center>
    <br/>
    <hr>
    <form name="main" action="userList.php" method="GET">
        <input type="text" name="user" value="user" />
        <input type="submit" value="Показать" />
        <br>Вы зарегшестрированы?<a href="createNewUser.php"> <br>Регистрация</a>
    </form>
    <br>
    <h2>Войти: </h2>
    <form name="login-form" action="index.php" method="POST">
        Имя пользователя: <input type="text" name="user" value="" size="50" /><br>
        Пароль Пользователя: <input type="password" name="userpassword" value="" size="50" /><br>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            if (!$logonSuccess)
                echo "Ошибка в веденном логине или пароле!";
        }
        ?>
        <input type="submit" value="Дальше" name="Дальше" />
    </form>
    <br>
        </header>
<!--шапка-->

<!--тело-->
<div> 
    <center>тело</center>
</div>
<!--тело-->
<!--Низ-->
    <footer>
        <hr>
    <center>Привет футер</center>
        
    </footer>
<!--Низ-->
    </body>
</html>
