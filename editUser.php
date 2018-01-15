<?php   
    session_start();
    if (!array_key_exists("user", $_SESSION))
    {
        header('Location: index.php');
        exit;
    }
    
    require_once ("includes/class_db.php");
    $userID = class_db::getInstance()->get_user_id_by_name($_SERVER['user']);
    
    $userDescriptionIsEmpty = FALSE;
    if ($_SERVER['REQURST_METHOD'] == "POST")
    {
        if (array_key_exists("back", $_POST))
        {
            header('Location: editUserList.php');
            exit;
        }
//        else 
//        {
//            if ($_POST)
//        }
    }
{
    
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//RU">
<!--
TiJester
UA Odessa 
-->
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title></title>
    </head>
    <body>
        <form name="editUser" action="editUser.php" method="POST">
            Страна<input type="text" name="address_country" value="" /><br>
            Населенный пункт<input type="text" name="address_city" value="" /><br>
            Улца<input type="text" name="address_street" value="" /><br>
            Номер дома<input type="text" name="address_street_num" value="" /><br>
            Номер квартиры<input type="text" name="address_apartment" value="" /><br>
            <input type="submit" value="Сохранить" name="saveUser" />
            <input type="submit" value="Назад" name="back" />
        </form>
        <?php
        // put your code here
        ?>
    </body>
</html>
