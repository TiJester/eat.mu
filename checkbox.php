<!DOCTYPE html>
<!--
TiJester
UA Odessa 
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        //  Тестируем checkbox
        //  Подключаем все необходимые классы
        require_once("config/class_config.php");
        
        $one = new base_filed_checkbox(
                "one",
                "Чекбокс");
        
        $form = new form(array("one"=>$one), "GO");
        
        $form->print_form();
        ?>
    </body>
</html>
