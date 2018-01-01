<?php

/* 
 * TiJester
 * UA Odessa* 
 */
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
    Добро пожаловать: 
<?php
    echo "<b>".htmlentities($_GET["user"])."</b><br/>";
    
    //подключение к базе данных
    $con = mysqli_connect("localhost", "root", "");
    if (!$con) {
    exit('Connect Error (' . mysqli_connect_errno() . ') '
    . mysqli_connect_error());
    }
    
    // установить набор символов клиента по умолчанию
    mysqli_set_charset($con, 'utf-8');
    
    //соеденение с БД
    mysqli_select_db($con, "eat_test_01012017");
    $user = mysqli_real_escape_string($con, htmlentities($_GET["user"]));
    $user_table = mysqli_query($con, "SELECT id FROM user WHERE name='".$user."'");
    if (mysqli_num_rows($user_table)<1)
    {
        exit("Пользователь не найден: ". htmlentities($_GET["user"]) ." Проверте орфографию и поробуйте еще раз.");
    }
    $row = mysqli_fetch_row($user_table);
    $userID = $row[0];
    mysqli_free_result($user_table);
?>
    
    <table border="black"> 
        <tr> <th>Имя</th> <th>Адрес</th> </tr>
<?php
    $result = mysqli_query($con, "SELECT address_country, address_city, address_street, address_street_num, address_apartment FROM address WHERE  ")
?>
    </table>
    </body>
</html>

