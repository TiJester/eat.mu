<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Grib
 */
interface Car // Интерфейс
{
    function startEngine();
    function stopEngine();
}

class MegaCar implements Car
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

$car=new MegaCar();
$car->startEngine();
$car->stopEngine();
