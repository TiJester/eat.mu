<!DOCTYPE html>
<!--
TiJester
UA Odessa 
-->
<?php
require_once ("includes/class_db.php");
    /*Учетные данные подключения к базе данных*/
//$dbHost="localhost"; //on MySql
//$dbXeHost="localhost/XE";
//$dbUsername="root";
//$dbPassword="";

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
    
    // создание соеденения с БД
//    $con = mysqli_connect($dbHost, $dbUsername,$dbPassword);
//    if (!$con)
//    {
//        exit("ошибка соединения (".mysqli_connect_errno().")".mysqli_connect_error());
//    }
//    //устанавливаем набор символов по умолчанию
//    mysqli_set_charset($con, 'utf-8');
    
//    // Убедитесь, что пользователь, чье имя совпадает с полем пользователя, уже существует 
//    mysqli_select_db($con, "eat_test_01012017");
//    $user = mysqli_real_escape_string($con, $_POST["user"]);
//    $users = mysqli_query($con, "SELECT id FROM user WHERE name='".$user."'");
//    $usersIDnum = mysqli_num_rows($users);
//    if ($usersIDnum) //есть ли данный пользоыватель в БД.
//    {
//        $userNameIsUnique = false; 
//    }
    
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
    /** Убедитесь, что логические значения показывают, что входные данные были успешно проверены. 
     * Если данные были успешно проверены, добавьте их как новую запись в базу данных «user». 
     * После добавления новой записи закройте соединение и перенаправьте приложение на editUserList.php. * /
     */
//    if (!$userIsEmpty && $userNameIsUnique && !$passwordIsEmpty && !$password2IsEmpty && $passwordIsValid)
//    {
//        $password = mysqli_real_escape_string($con, $_POST['password']);
//        mysqli_select_db($con, "eat_test_01012017");
//        mysqli_query($con, "INSERT user (name, password) VALUES ('". $user ."','".$password."')");
//        mysqli_free_result($users);
//        mysqli_close($con);
//        header('Location: editUserList.php');
//        exit;
//    }
    if (!$userIsEmpty && $userNameIsUnique && !$passwordIsEmpty && !$password2IsEmpty && $passwordIsValid)
    {
        class_db::getInstance()->create_user($_POST["user"], $_POST["password"]);
        header('Location: editUserList.php');
        exit;
    }
}
?>

<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
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
