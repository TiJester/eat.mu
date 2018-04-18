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
        // Тест списков
        //  Подключаем все необходимые классы
        require_once("config/class_config.php");

        $one = new base_field_select(
                "one", 
                "Выбор множества <br> значеня",
                array(
                    "Первый",
                    "Второй",
                    "Третий"),
                array(0,2),
                TRUE,
                3);
        $form = new form(array(
            "one" => $one),
                $button_name,
                $class_name);
        ?>
    </body>
</html>
