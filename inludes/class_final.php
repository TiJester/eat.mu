<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of class_final
 *
 * @author Grib
 */
final class class_final 
{
    public function startEngine() 
    {
        echo "Машина двинулась <br/>";
    }
    public function stopEngine() 
    {
        echo "Машина остановилась<br/>";
    }
}

class MegaCar extends class_final
{
    
}

$car=new MegaCar();
$car->startEngine();
$car->stopEngine();
