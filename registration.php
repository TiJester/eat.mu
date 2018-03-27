<?php

/* 
 * TiJester
 * UA Odessa  * 
 */

/**
 * 2018(С) Шевченко Г.Ю.
 * Описание регистрации
 * V 0.1
 */

//  Подключаем базовый класс
require_once("class/base_field.php");
//  Подключаем класс текстового поля
require_once("class/base_field_text.php");
//  Подключаем класс формы
require_once("class/form.php");
//  Исключения
require_once("class/ExceptionObject.php");

require_once("class/ExceptionMember.php");

require_once("class/ExceptionMySql.php");


// Формирование HTML-формы
try{
    $name = new base_field_text("name",
            "Имя пользователя",
            TRUE, //    Обязательное поле
            $_POST['name']);
    $pass = new base_field_text("pass",
            "Пароль",
            TRUE,
            $_POST['pass']);
    $form = new form(array("name"=>$name,
            "pass"=>$pass),
            "Добавить",
            "fields");
    
//  Обработчик HTML-формы
    if(!empty($_POST))
    {
        // Устанавиваем соединение с базой данных
        require_once("/config/config.php");
        //  Проверяем корректность заполнения HTML-формы и обрабатываем текстовые поля
        $error = $form->check();
        if(empty($error))
        {
            //  Записываем полученные результаты в таблицу
            $query = "INSERT INTO users VALUES (NULL, '{$form->fields[name]->value}', MD5('{$form->fields[pass]->value}'), NOW())";
            
            if(mysqli_query($dbcon, $query))
            {
               // throw new ExceptionMySql(mysqli_error(), "connection", "Ошибка регистрации пользователя");
                      //  $query,
                        exit( "Ошибка регистрации пользователя");
            }
            else {
                exit("Регестрация успешна!");
            }
        
        //  Перегружаем страницу для сброса POST-данных
        header("Location:$_SERVER[PHP_SELF]");
        exit();
        }
    }
    
//  Формируем видимую часть страницы
//  Подключаем заголовок страницы
//  require_once("includes/top.php");

//  Выводим сообщение об ошибках, если они имеються
if(!empty($error))
{
    foreach($error as $err)
    {
        echo "<span style=\"color:red\">$err</span><br>";
    }
}    
//  Выводим HTML-форму
$form->print_form();
} 

catch (ExceptionObject $exc) {
//  Прехватываем исключение, Если производиться попытка передать классу form некорректный элемент управления
    
//  Включам заголовок страницы
//    require_once("includes/top.php");
    echo "<p class=help> Произошла исключительная ситуация <b>ExceptionObject</b> - попытка использовать"
    . " в качестве элемента управления объекта, класс которого не являеться производным от базового класса <b>"
    . "{$exc->getMessage()}.</p>";
    echo "<p class=help> Ошибка в файле:  {$exc->getFile()}, в строке {$exc->getLine()}.";
    
//  Включаем завершение страницы
//   require_once("includes/bottom.php");
    exit();
}

catch (ExceptionMember $exc) {
//  Перехватываем исключение, если выполняеться обращение к несуществующему элементу управления
//  Включаем заголовок страницы
//    require_once("includes/top.php");
    echo "<p class=help> Произошла исключительная ситуация <b> ExceptionMember</b> - попытка обращения к несуществующему члену класса{$exc->getMessage()}.</p>";
    echo "<p class=help> Ошибка в файле  {$exc->getFile()} в строке {$exc->getLine()}.";
//  Включаем завершение страницы
//  require_once("includes/bottom.php");
    exit();
} 
catch (ExceptionMySql $exc) {
//  Обработка исключения при обращении к MySQL
//  Включаем заголовок страницы
//    require_once("includes/top.php");
    echo "<p class=help> Произошла исключительная систуация <b> ExceptionMySql</b> при обращении к MySql</p>";
    echo "<p class=help> {$exc->getMySQLError()}<br>". /*n12br*/($exc->getSQLQuery())."</p>";  
    echo "<p class=help> Ошибка в файле{$exc->getFile()} в строке {$exc->getLine()}.</p>";
//  Включаем завершение страницы
//  require_once("includes/bottom.php");
    exit();
}