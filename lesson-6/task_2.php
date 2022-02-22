<?php

// Стратегия: есть интернет-магазин по продаже носков. Необходимо реализовать возможность оплаты 
// различными способами (Qiwi, Яндекс, WebMoney). Разница лишь в обработке запроса на оплату 
// и получение ответа от платёжной системы. В интерфейсе функции оплаты достаточно общей суммы 
// товара и номера телефона.

class Shop
{
    private $strategy;

    public function __construct(Strategy $strategy)
    {
        $this->strategy = $strategy;
    }


    public function setStrategy(Strategy $strategy)
    {
        $this->strategy = $strategy;
    }


    public function makeOrder() : void
    {
        $paySystemResponse = $this->strategy->paySystem(450, '8-911-666-66-66'); // цифры для теста
        echo $paySystemResponse[message], '<br>';
    }
}


interface Strategy
{
    public function paySystem($totalCost, $phoneNumber) : array;
}


class Qiwi implements Strategy
{
    public function paySystem($totalCost, $phoneNumber) : array
    {
        // Обработка платежа

        $response = 
        [
            'status' => 200,
            'message' => "Товар на сумму $totalCost оплачен с вашего Qiwi-кошелька $phoneNumber",
        ];

        return $response;
    }
}


class Yandex implements Strategy
{
    public function paySystem($totalCost, $phoneNumber) : array
    {
        // Обработка платежа

        $response = 
        [
            'status' => 200,
            'message' => "Спасибо за покупку на сумму $totalCost. Чек на оплату будет выслан в СМС на номер $phoneNumber. С уважением, Яндекс",
        ];

        return $response;
    }
}


class WebMoney implements Strategy
{
    public function paySystem($totalCost, $phoneNumber) : array
    {
        // Обработка платежа

        $response = 
        [
            'status' => 200,
            'message' => "С вашего кошелька $phoneNumber оплачена покупка на сумму $totalCost. Спасибо, что используете WebMoney",
        ];

        return $response;
    }
}


$shop = new Shop(new Qiwi);
$shop->makeOrder();

$shop->setStrategy(new Yandex);
$shop->makeOrder();