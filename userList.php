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
    $userID = class_db::getInstance()->get_user_id_by_name($_GET["user"]);
    if (!$userID)
    {
        exit("<br/>Пользователь не найден: <b>" .$_GET["user"]."</b> Проверте орфографию и поробуйте еще раз.<br/>");
    }
?>
    
    <table border="black"> 
        <tr> <th>Адрес</th></tr>
<?php
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
?>
    </table>
    </body>
</html>

