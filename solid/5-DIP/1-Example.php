<?php

class SessionBasket
{
    public function add()
    {
    }
    public function remove()
    {
    }
    public function all()
    {
    }
    public function totalAmount()
    {
        return 'Total Amount' . PHP_EOL;
    }
}

class Order
{
    public function make()
    {
        $basket = new SessionBasket();
        echo $basket->totalAmount();
    }
}

class Payment
{
    public function pay()
    {
        $basket = new SessionBasket();
        echo $basket->totalAmount();
    }
}


(new Payment())->pay();
(new Order())->make();
