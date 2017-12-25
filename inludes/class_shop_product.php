<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of class_shop_product
 *
 * @author admin
 */
class class_shop_product 
{
    public $title = "Первый товар";
    public $lastname = "Фамилия";
    public $firstname = "Имя";
    public $price = 0;
    
    function __construct($title, $lastname, $firstname, $price) //конструктор
    {
        $this->title = $title;
        $this->lastname = $lastname;
        $this->firstname = $lastname;
        $this->price = $price;
        
        echo $this->getAllView();
    }
    
    function __destruct() //деструктор - эмуляция занесения в БД
    {
        echo $this->title. " был занесен в БД <br/>";
    }
            
    function getAllView()
    {
        return "Автор: {$this->lastname} {$this->firstname}<br />"
        . "Название: {$this->title}<br />"
        . "Цена: {$this->price}<hr />";
    }
}


//$tovar1 = new class_shop_product();
////$tovar1->title = "Мастер и Маргарита";
//$tovar1->lastname = "Булгаков";
//$tovar1->firstname = "Михаил";
//$tovar1->price = 10;

//$tovar2 = new class_shop_product();
//$tovar2->title = "Лабиритны Эхо";
//$tovar2->lastname = "Фрай";
//$tovar2->firstname = "Макс";
//$tovar2->price = 20;

//echo "Автор: {$tovar1->firstname} {$tovar1->lastname} - название: \"{$tovar1->title}\"<br />";
//echo "Автор: {$tovar2->firstname} {$tovar2->lastname} - название: \"{$tovar2->title}\"<br />";

$tovar1 = new class_shop_product("Мастер и Маргарита", "Булгаков", "Михаил", 10);
$tovar2 = new class_shop_product("Лабиритны Эхо", "Фрай", "Макс", 25);

//echo $tovar1->getAllView();
//echo $tovar2->getAllView();