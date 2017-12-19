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
    public $price = 0;
    
    function __construct($title, $price) //конструктор
    {
        $this->title = $title;
        $this->price = $price;
    }
}

class Saller
{
    function sale(class_product $product, $sale)
    {
        $product->price = $product->price -($product->price*$sale);
        return $product->price;
    }
}

$product = new class_product("Часы", 1000);
$saler = new Saller();

echo $product->title." без скидки: ".$product->price.", со скидкой: ". $saler->sale($product, 0.1);
echo "<br/".$saler->sale($product, 0.1);


// https://www.youtube.com/watch?v=dsgqs9ZSUR8 11