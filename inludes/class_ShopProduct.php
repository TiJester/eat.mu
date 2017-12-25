<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of class_ShopProduct
 *
 * @author Grib
 */
class class_ShopProduct {
    public $title;
    public $price;
    
    public function __construct($title, $price) 
    {
        $this->title=$title;
        $this->price=$price;
    }
    
    public function getPrice()
    {
        return $this->price;
    }
    
    public function getView()
    {
        $result = $this->title."<br />".$this->price;
        return $result;
    }
}

class class_DigitalProduct extends class_ShopProduct{ //дочерний класс
    public $type;
    public $size;
    
    public function __construct($title, $price, $type, $size) {
        parent::__construct($title, $price);
        $this->type=$type;
        $this->size=$size;        
    }
    
    public function getView() {
        $result = parent::getView();
        $result .= "<br />".$this->type."<br />".$this->size;
        return $result;
    }
}

$cd = new class_DigitalProduct("Metallica", 249, "CD", 680);
echo $cd->getView();
