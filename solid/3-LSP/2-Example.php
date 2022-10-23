<?php
interface OnlinePaymentInterface
{
    public function pay();
    public function verify();
}

interface OfflinePaymentInterface
{
    public function pay();
}

class OnlinePayment implements OnlinePaymentInterface
{
    public function pay()
    {
    }

    public function verify()
    {
    }
}

class Cart2CartPayment implements OfflinePaymentInterface
{
    public function pay()
    {
    }
}
