<?php
/* 
 * TiJester
 * UA Odessa  * 
 */
    require_once ("includes/class_db.php");
    
    session_start();
    if (array_key_exists("user", $_SESSION)){
        echo "Привет сесия: " . $_SESSION['user']/*." ".$_SESSION['']*/;
    }
    else {
        header('Location: index.php');
        exit;
    }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//RU">

<html>
    <head>
    <meta http-equiv = "Content-Type" content = "text/html; charset=UTF-8" />      
    </head>
    <body>
        <form name="addNewAddress" action="editUser.php">
            <input type="submit" value="Добавить" name="Добавить" />
            <input type="submit" value="назад" name="back" />
        </form>
        <table border="black"> 
        <tr> <th>Адрес</th></tr>
<?php
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); //вывод ошибки!
    $userID = class_db::getInstance()->get_user_id_by_name($_SESSION["user"]);
    $result = class_db::getInstance()->get_user_by_users_id($userID);
    while ($row = mysqli_fetch_array($result)) 
    {
        echo "<td>".htmlentities($row["address_country"]).", ";
        echo htmlentities($row["address_city"]).", ";
        echo htmlentities($row["address_street"]).", ";
        echo htmlentities($row["address_street_num"]).", ";
        echo htmlentities($row["address_apartment"])."</td>";
    }

?>
        </table>

    </body>
    
</html>

