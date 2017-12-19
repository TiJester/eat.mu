<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user_class
 *
 * @author admin
 */
class user_class //класс уюзер
{
    public $name = "Grib";
    public $age = 30;
    public $job = "АУСП";
    
    public function person()
    {
        return "Привет ".$this->name."</br>".
        "Тебе ".$this->age." лет </br>".
        "Твоя должность: ".$this->job;
        
    }
}

$grib = new user_class(); //создаем и вызываем метод класса
//созданы как константы строки 16-18
//$grib->name = "Grib";
//$grib->age = 30;
//$grib->job = "АУСП";

echo $grib->person();