<?php

// Реализовать паттерн Адаптер для связи внешней библиотеки (классы SquareAreaLib и CircleAreaLib)
// вычисления площади квадрата (getSquareArea) и площади круга (getCircleArea) с интерфейсами ISquare и ICircle 
// имеющегося кода. Примеры классов даны ниже. Причём во внешней библиотеке используются для расчётов формулы
// нахождения через диагонали фигур, а в интерфейсах квадрата и круга — формулы, принимающие значения 
// одной стороны и длины окружности соответственно.

class CircleAreaLib
{
   public function getCircleArea(float $diagonal)
   {
       $area = (M_PI * $diagonal ** 2) / 4;

       return $area;
   }
}

class SquareAreaLib
{
   public function getSquareArea(float $diagonal)
   {
       $area = ($diagonal ** 2) / 2;

       return $area;
   }
}


interface ISquare
{
    function squareArea(float $sideSquare);
}

interface ICircle
{
    function circleArea(float $circumference);
}



class SquareAdapter implements ISquare
{
    private $target;

    public function __construct(SquareAreaLib $target) {
        $this->target = $target;
    }

    public function squareArea(float $sideSquare) 
    {
        $diagonal = sqrt(2 * $sideSquare ** 2);
        return $this->target->getSquareArea($diagonal);
    }
}


class CircleAdapter implements ICircle
{
    private $target;

    public function __construct(CircleAreaLib $target) {
        $this->target = $target;
    }

    public function circleArea(float $circumference) 
    {
        $diagonal = $circumference / M_PI;
        return $this->target->getCircleArea($diagonal);
    }
}



$adapter = new SquareAdapter(new SquareAreaLib());
echo $adapter->squareArea(4);