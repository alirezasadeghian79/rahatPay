<?php

namespace rahatPay\Contracts;

interface PaymentInterface
{
    public function setAmount($amount);
    public function setCallback($url);
    public function setDescription($description = null);
    public function pay();
    public function startPay($authority);
    public function verify($authority,$amount);
}
