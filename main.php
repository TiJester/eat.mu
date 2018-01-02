<?php
/* 
 * TiJester
 * UA Odessa* 
 */
require_once ("includes/class_db.php");
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
    
//    //подключение к базе данных
//    $con = mysqli_connect("localhost", "root", "");
//    if (!$con) {
//    exit('Connect Error (' . mysqli_connect_errno() . ') '
//    . mysqli_connect_error());
//    }
//
//    
//    // установить набор символов клиента по умолчанию
//    mysqli_set_charset($con, 'utf-8');
//    
//    //соеденение с БД
//    mysqli_select_db($con, "eat_test_01012017");
//    $user = mysqli_real_escape_string($con, htmlentities($_GET["user"]));
//    $user_table = mysqli_query($con, "SELECT id FROM user WHERE name='".$user."'");
//    if (mysqli_num_rows($user_table)<1)
//    {
//        exit("Пользователь не найден: ". htmlentities($_GET["user"]) ." Проверте орфографию и поробуйте еще раз.");
//    }
//    $row = mysqli_fetch_row($user_table);
//    $userID = $row[0];
//    mysqli_free_result($user_table);
    $userID = class_db::getInstance()->get_user_id_by_name($_GET["user"]);
    if (!$userID)
    {
        exit("<br/>Пользователь не найден: <b>" .$_GET["user"]."</b> Проверте орфографию и поробуйте еще раз.<br/>");
//        exit("Пользователь не найден: ". htmlentities($_GET["user"]) ." Проверте орфографию и поробуйте еще раз.");
    }
?>
    
    <table border="black"> 
        <tr> <th>Адрес</th></tr>
<?php
//    $result = mysqli_query($con, "SELECT address_country, address_city, address_street, address_street_num, address_apartment FROM address WHERE id_user =".$userID);
    $result = class_db::getInstance()->get_user_by_users_id($userID);
    while ($row = mysqli_fetch_array($result)) 
    {
        echo "<td>".htmlentities($row["address_country"]).", ";
        echo htmlentities($row["address_city"]).", ";
        echo htmlentities($row["address_street"]).", ";
        echo htmlentities($row["address_street_num"]).", ";
        echo htmlentities($row["address_apartment"])."</td>";
    }
    mysqli_free_result($result);
//    mysqli_close($con);
?>
    </table>
    </body>
</html>

