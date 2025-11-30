<?php

namespace rahatPay;

use rahatPay\Contracts\PaymentInterface;
use rahatPay\Exceptions\PaymentException;

class RahatPay
{
    protected PaymentInterface $driver;

    public function driver($name)
    {
        $class = "rahatPay\\Drivers\\" . ucfirst($name);

        if (!class_exists($class)) {
            throw new PaymentException("Driver {$name} not found.");
        }

        $this->driver = new $class();

        return $this;
    }

    public function __call($method, $args)
    {
        if (!method_exists($this->driver, $method)) {
            throw new PaymentException("Method {$method} not found");
        }

        return $this->driver->$method(...$args);
    }
}
