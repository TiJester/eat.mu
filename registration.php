<?php

/* 
 * TiJester
 * UA Odessa  * 
 */

/**
 * 2018(С) Шевченко Г.Ю.
 * Форма регистрации пользователей
 * Добавлена проверка на уникальность почты
 * V 0.2.2
 */

//  Подключаем все необходимые классы
require_once("config/class_config.php");

// Формирование HTML-формы
try{
    $name = new base_field_text("name",
            "Имя пользователя",
            TRUE, //    Обязательное поле
            $_POST['name']);
    $pass = new base_field_password("pass",
            "Пароль",
            TRUE,
            $_POST['pass']);
    $pass2 = new base_field_password("pass2",
            "Повтор пароля",
            TRUE,
            $_POST['pass2']);
    $email = new base_field_text_email("email",
            "E-mail",
            TRUE,
            $_POST['email']);
    $description = new base_field_textarea("description",
            "О себе",
            FALSE,
            $_POST['description']);
    
    $form = new form(array(
        "name"=>$name,
        "pass"=>$pass,
        "pass2"=>$pass2,
        "email"=>$email,
        "description"=>$description),
        "Добавить",
        "fields");
    
//  Обработчик HTML-формы
    if(!empty($_POST))
    {
        // Устанавиваем соединение с базой данных
        require_once("config/config.php");
        //  Проверяем корректность заполнения HTML-формы и обрабатываем текстовые поля
        $error = $form->check();
        
        //  Проверяем идентичность паролей
        if($form->fields['pass']->value != $form->fields['pass2']->value){
            $error[] = "Пароли не совпадают";
        }
        
        //  Проверяем, не регистрировался ли ранее пользователь с идентичным email-ом
        $query = "SELECT * FROM users WHERE email = '{$form->fields[email]->value}'";
        $result = mysqli_query($link, $query); //    mysqli_query - выполнить запрос к базе данных
        if(!$link)
        {
            throw new ExceptionMySql(mysqli_error($link));
        }
        if(mysqli_fetch_assoc($result)){
            $error[] = "Пользователь с электронным адресом: <b><i>{$form->fields[email]->value}</i></b> - уже существует";
        }
        
        //  Проверяем, не регистрировался ли ранее пользователь с идентичным ником
        $query = "SELECT * FROM users WHERE name = '{$form->fields[name]->value}'";
        $result = mysqli_query($link, $query); //    mysqli_query - выполнить запрос к базе данных
        if(!$link)
        {
            throw new ExceptionMySql(mysqli_error($link));
        }
        if(mysqli_fetch_assoc($result)){
            $error[] = "Пользователь с Ником: <b><i>{$form->fields[name]->value}</i></b> - уже существует";
        }
            
        if(empty($error))
        {
            //  Записываем полученные результаты в таблицу
            $query = "INSERT INTO users VALUES (NULL, '{$form->fields[name]->value}', MD5('{$form->fields[pass]->value}'), '{$form->fields[email]->value}', '{$form->fields[description]->value}', NOW())";
            
            if(!mysqli_query($link, $query))
            {
                throw new ExceptionMySql(mysqli_error($link));
                //print (mysqli_error($dbcon));
            }
            else {
                exit("Регистрация успешна!<br>"."<a href=user_list.php>Список пользователей!</a>");//   Временно!
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