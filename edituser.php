<?php

/* 
 * TiJester
 * UA Odessa
 */

/**
 * 2018(С) Шевченко Г.Ю.
 * Страница редактирования пользователя
 * V 0.1
 */

//
    try {
        //  Подключам все необходимые классы
        require_once ("config/class_config.php");
        
        //  Если это первое обращение к HTML-форме извлекаем информацию из таблицы users
        if(empty($_POST)){
            $_GET['id_user'] = intval($GET['id_user']);
            
            //  1.Устанавливаем соединение с базой данных
            require_once ("config/config.php");
            
            $query = "SELECT * FORM users WHERE id_user = $_GET[id_user]";
            $result = mysqli_query($link, $query);
            if(!$result){
                throw new ExceptionMySql(mysqli_error($link));
            }
            $_REQUEST = mysqli_fetch_array($result); 
            $_REQUEST["pass"]=$_REQUEST["pass2"]; //    $_REQUEST Переменные HTTP-запроса
        }
        
        //  Формиование формы
        /////////////////////
        $pass = new base_field_password(
                "pass", 
                "Пароль", 
                TRUE, 
                $_REQUEST['pass']);
        $pass2 = new base_field_password(
                "pass2", 
                "Потвор пароля", 
                TRUE, 
                $_REQUEST['pass2']);
        $email = new base_field_text_email(
                "email",
                "E-mail",
                TRUE,
                $_REQUEST['email']);
        $description = new base_field_textarea(
                "description",
                "О себе",
                FALSE,
                $_REQUEST['description']);
        $id_user = new base_field_hidden_int(
                "id_user",
                TRUE,
                $_REQUEST["id_user"]);
        
        $form = new form(array(
            "pass" => $pass,
            "pass2" => $pass2,
            "email" => $email,
            "description" => $description,
            "id_user" => $id_user),
            "Добавить", "field");
        
        //  2.Обработчик HTML-Формы
        ///////////////////////////
        if(!empty($_POST))
        {
            
        }
        
        //  3.Видимая часть страницы
        ////////////////////////////
        //  Выводим сообщение об ошибках если они имеються
        
        //  Выводим HTML-форму
        $form->print_form();
        
    } catch (Exception $ex) {

    }