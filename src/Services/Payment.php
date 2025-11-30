<?php
namespace rahatPay\Services;

use rahatPay\Drivers\Zarinpal;
use rahatPay\Drivers\Zibal;

class Payment
{
    protected $driver;

    public function __construct($driverName = null)
    {
        $driverName = $driverName ?: config('rahatPay.default');
        $this->driver = $this->resolveDriver($driverName);
    }

    public function resolveDriver($name)
    {
        $name = strtolower($name);
        switch($name) {
            case 'zarinpal':
                return new Zarinpal(config('rahatPay.drivers.zarinpal'));
            case 'zibal':
                return new Zibal(config('rahatPay.drivers.zibal'));
            default:
                throw new \Exception("Payment driver [$name] not supported.");
        }
    }
    public function setAmount($amount)
    {
        $this->driver->setAmount($amount);
        return $this;
    }
    public function setCallback($callback)
    {
        $this->driver->setCallback($callback);
        return $this;
    }
    public function setDescription($description)
    {
        $this->driver->setDescription($description);
        return $this;
    }
    public function pay()
    {
        return $this->driver->pay();
    }
    public function startPay($authority)
    {
        return $this->driver->startPay($authority);
    }
    public function verify($authority,$amount)
    {
        return $this->driver->verify($authority,$amount);
    }
}
