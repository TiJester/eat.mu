<?php
    session_start();
    if (!array_key_exists("user", $_SESSION))
    {
        header('Location: index.php');
        exit;
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
            Страна<input type="text" name="address_country" value="" />
            Населенный пункт<input type="text" name="address_city" value="" />
            Улца<input type="text" name="address_street" value="" />
            Номер дома<input type="text" name="address_street_num" value="" />
            Номер квартиры<input type="text" name="address_apartment" value="" />
            <input type="submit" value="Сохранить" name="saveUser" />
            <input type="submit" value="Назад" name="back" />
        </form>
        <?php
        // put your code here
        ?>
    </body>
</html>
