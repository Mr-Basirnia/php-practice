<?php


interface PaymentInterface
{
    public function pay();
}

interface PaymentMustBeVerifyInterface
{
    public function verify();
}

class OnlinePayment implements PaymentInterface, PaymentMustBeVerifyInterface
{
    public function pay()
    {
    }

    public function verify()
    {
    }
}


class Cart2CartPayment implements PaymentInterface
{
    public function pay()
    {
    }
}
