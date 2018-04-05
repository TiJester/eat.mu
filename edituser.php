<?php

/* 
 * TiJester
 * UA Odessa
 */

/**
 * 2018(С) Шевченко Г.Ю.
 * Страница редактирования пользователя
 * V 0.1.2
 */

//
    try {
        //  Подключам все необходимые классы
        require_once ("config/class_config.php");
        
        //  Если это первое обращение к HTML-форме извлекаем информацию из таблицы users
        if(empty($_POST)){
            $_GET['id_user'] = intval($_GET['id_user']);
            
            //  1.Устанавливаем соединение с базой данных
            require_once ("config/config.php");
            
            $query = "SELECT * FROM users WHERE id_user = $_GET[id_user]";
            $result = mysqli_query($link, $query);
            if(!$link){
                throw new ExceptionMySql(mysqli_error($link));
            }
            $_REQUEST = mysqli_fetch_array($result); 
            $_REQUEST["pass"] = $_REQUEST["pass2"]; //    $_REQUEST Переменные HTTP-запроса
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
            //  Устанавливаем соеденение с базой данных
            require_once ("config/config.php");
            //  Проверяем корректность заполнения HTML-формы и обрабатываем текстовые поля
            $error = $form->check();
            
            //  Проверяем, равны ли пароли
            if($form->fields['pass']->value != $form->fields['pass2']->value){
                $error[] = "Пароли не равны";
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
            
            //  Подгружаем информацию о себе из базы данных
            $query = "SELECT COUNT(*) FROM users WHERE description ='{$form->fields[description]->value}'";
            $result = mysqli_query($link, $query);
            if(!$result){
                throw new ExceptionMySql(mysqli_error($link));
            }
            
            //  Обновляем запись пользователя
            $query = "UPDATE users SET pass = MD5('{$form->fields[pass]->value}'), email = '{$form->fields[email]->value}', description = '{$form->fields[description]->value}' WHERE id_user = '{$form->fields[id_user]->value}'";
            if(!mysqli_query($link, $query)){
                throw new ExceptionMySql(mysqli_error($link));
            }
            
            //  Перегружаем страницу для сброса POST данных
            header("Location:user_list.php");
            exit();
        }
        
        //  3.Видимая часть страницы
        ////////////////////////////
        //  Выводим сообщение об ошибках если они имеються
        if(!empty($error)){
            foreach ($error as $err){
                echo "<span style=\"color:red\">$err</span><br>";
            }
        }
        //  Выводим HTML-форму
        //***************************
        $query = "SELECT * FROM users WHERE id_user = '{$form->fields[id_user]->value}'";
        $result = mysqli_query($link, $query);
        //  Если имееться хоть бы одна запись выводим список пользователей
        if(mysqli_num_rows($result)){ //    Получает число рядов в результирующей выборке
            while($user = mysqli_fetch_array($result)){ //   Выбирает одну строку из результирующего набора и помещает ее в ассоциативный массив, обычный массив или в оба 
                echo "Имя пользователя: <b>{$user['name']}</b>";
            }
        }        
        //***************************
        $form->print_form();          
    } catch (ExceptionMySql $exc) {
        echo "<p class=help> Произошла исключительная систуация <b> ExceptionMySql</b> при обращении к MySql</p>";
        echo "<p class=help> {$exc->getMySQLError()}<br>". /*n12br*/($exc->getSQLQuery())."</p>";  
        echo "<p class=help> Ошибка в файле{$exc->getFile()} в строке {$exc->getLine()}.</p>";
        exit();
    }