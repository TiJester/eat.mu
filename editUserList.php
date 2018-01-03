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

