<!DOCTYPE html>
<!--
TiJester
UA Odessa 
Поиск по ключевому слову
V 0.1.0
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
<!--        <form method="get">
            <input type="text" name="search" value="<? /*htmlspecialchars($_GET['search'],ENT_QUOTES);*/?>">
            <input type="submit" value="GO">
        </form>-->
        
        <?php
        require_once("config/class_config.php");
        
        $form_one = new base_field_text(
                "search",
                "ПОИСК",
                FALSE,
                htmlspecialchars($_GET['search'],ENT_QUOTES));
        
        $form = new form(array(
        "form_one"=>$form_one),
        "Искать",
        "fields");
        
        
            //  Выводим HTML-форму
            $form->print_form();
        
        //  Обработчик формы
        if(!empty($_GET)){
            //  Объявляем объект постраничной навигации
            $obj = new pager_file_search($_GET['search'], "words_test.txt", 5);
            //  Выводим содержимое текущей страницы
            $arr = $obj->get_page();
            for($i=0; $i<count($arr); $i++){
                echo "{$arr[$i]}<br>";
            }
            //  Выводим ссвлки на другие страницы
            echo $obj;
        }
        ?>
    </body>
</html>
