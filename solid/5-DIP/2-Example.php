<?php

interface Basket
{
    public function add();
    public function remove();
    public function all();
    public function totalAmount();
}

class DatabaseBasket implements Basket
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
        return 'Total Amount Database' . PHP_EOL;
    }
}

class SessionBasket implements Basket
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
        return 'Total Amount Session' . PHP_EOL;
    }
}

class Order
{
    private $basket;

    public function __construct(Basket $basket)
    {
        $this->basket = $basket;
    }

    public function make()
    {
        echo $this->basket->totalAmount();
    }
}

class Payment
{
    private $basket;

    public function __construct(Basket $basket)
    {
        $this->basket = $basket;
    }
    public function pay()
    {
        echo $this->basket->totalAmount();
    }
}

// IOC Container  => Inversion Of Control Container
$basket = new DatabaseBasket();

(new Order($basket))->make();
(new Payment($basket))->pay();
