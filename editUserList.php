<?php
/* 
 * TiJester
 * UA Odessa  * 
 */
    session_start();
    if (array_key_exists("user", $_SESSION)){
        echo "Привет сесия: " . $_SESSION['user'];
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
            <input type="submit" value="" name="Добавить" />
        </form>
    </body>
    
</html>

