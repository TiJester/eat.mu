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
class class_product //класс продукт
{
    public $title = "Первый товар";
    private $price = 0;
    
    function __construct($title, $price) //конструктор
    {
        $this->title = $title;
        $this->price = $price;
    }
    
    public function getPrice() //функция вывода цены
    {
        return $this->price;
    }
}

class Saller
{
    function sale(class_product $product, $sale)
    {
//        $product->price = $product->price -($product->price*$sale);
//        return $product->price;
        return $product->getPrice()-($product->getPrice()*$sale);
    }
}

$product = new class_product("Часы", 1000);
$saler = new Saller();

echo $product->title." без скидки: ".$saler->sale($product, 0.0) 
.", со скидкой: ".$saler->sale($product, 0.1);
//echo "<br/>".$saler->sale($product, 0.1)." скидка 10%";
//echo "<br/>".$saler->sale($product, 0)." скидка 0";
