<?php

//TiJester
//UA Odessa 

require_once ("includes/class_db.php");

    /** другие переменные */
    $userNameIsUnique = true; //проверяем есть ли вводимый пользователь в базе данных
    $passwordIsValid = true;
    $userIsEmpty = false; // проверяем на метод передачи данных
    $passwordIsEmpty = false;
    $password2IsEmpty = false;

    //проверяем каким методом передаються данные!
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    /** Проверьте, заполнил ли пользователь имя пользователя в текстовом поле "user" */
    if ($_POST["user"]=="")
    {
        $userIsEmpty = true;
    }
        
    $userID = class_db::getInstance()->get_user_id_by_name($_POST["user"]);
    if ($userID)
    {
        $userNameIsUnique = FALSE;
    }
    
    //проверяем введены ли данные паролей и совпадают ли они
    if ($_POST["password"]=="")
    {
        $passwordIsEmpty = true;
    }
    if ($_POST["password2"]=="")
    {
        $password2IsEmpty = true;
    }
    if ($_POST["password"]!=$_POST["password2"])
    {
        $passwordIsValid = false;
    }
   
    if (!$userIsEmpty && $userNameIsUnique && !$passwordIsEmpty && !$password2IsEmpty && $passwordIsValid)
    {
        class_db::getInstance()->create_user($_POST["user"], $_POST["password"]);
                session_start();
        $_SESSION['user'] = $_POST['user'];
        //Перенаправление на страницу
        header('Location: editUserList.php');
        exit;
    }
}
?>

<html>
    <head>
        <meta charset=UTF-8">
    <title></title>
    </head>
    <body>
        Добро пожаловать!<br>
    <form action="createNewUser.php" method="POST">
        Ваше имя: <input type="text" name="user" value="" size="50" /> <br />
    <?php
    if ($userIsEmpty)
    {
        echo ("Введите пожайлуста имя!<br/>");
    }
    if (!$userNameIsUnique)
    {
        echo ("Пользователь с таким именем уже существует<br/>");
    }
    ?>
        Пароль: <input type="password" name="password" value="" size="50" /> <br />
    <?php
    if ($passwordIsEmpty)
    {
        echo ("Введите пожайлуста пароль!<br/>");
    }
    ?>
        Повторите Пароль: <input type="password" name="password2" value="" size="50" /><br />
    <?php
    if ($password2IsEmpty)
    {
        echo ("Подтвердите свой пароль<br/>");
    }
    if (!$password2IsEmpty && !$passwordIsValid)
    {
        echo ("Пароли не совпадают</br>!");
    }
    ?>
        <input type="submit" value="Регистрация" />
    </form>

    </body>
</html>
