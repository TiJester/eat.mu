<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of class_car
 *
 * @author Grib
 */
abstract class class_car 
{
    public $tire;
    
    public function startEngine()
    {
        echo "Двигатель завелся <br/>";
    }
}

class class_car_mega extends class_car
{
    public function stopEngine()
    {
        echo "Машина остановилась <br />";
    }
}

$car=new class_car_mega();
$car->startEngine();
$car->stopEngine();
