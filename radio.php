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
        // Тест радио-конпки
        //  Подключаем все необходимые классы
        require_once("config/class_config.php");
        
        $one = new base_field_radio(
                "one",
                "Вертикальный вариант",
                array("Да",
                    "Нет",
                    "Все возможно"),
                0);
        $two = new base_field_radio(
                "two", 
                "Горизонтальный вариант",
                array("Да",
                    "Нет"),
                1,
                "horizontal");
        
        $form = new form(array(
            "one" => $one,
            "two" => $two),
            "Вперед",
            $class_name);
        
    $form->print_form();   
        ?>
    </body>
</html>
