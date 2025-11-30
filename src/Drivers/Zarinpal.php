<?php

namespace rahatPay\Drivers;

use GuzzleHttp\Client;
use rahatPay\Contracts\PaymentInterface;

class Zarinpal implements PaymentInterface
{
    protected $amount;
    protected $callback;
    protected $description;
    protected $merchant;
    protected $request_url;
    protected $verify_url;
    protected $startPay_url;

    public function __construct()
    {
        $config = config('rahatPay.drivers.zarinpal');
        $this->merchant = $config['merchant_id'];
        $this->request_url = $config['routes'][$config['default']]['request_url'];
        $this->startPay_url = $config['routes'][$config['default']]['startPay_url'];
        $this->verify_url = $config['routes'][$config['default']]['verify_url'];
    }

    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }
    public function setCallback($url)
    {
        $this->callback = $url;
        return $this;
    }
    public function setDescription($description = null)
    {
        $this->description = $description;
        return $this;
    }

    public function pay()
    {
        $client = new Client();
        $result = $client->post($this->request_url,[
            'json' => [
                'merchant_id' => $this->merchant,
                'amount' => $this->amount,
                'description' => $this->description,
                'callback_url' => $this->callback,
            ]
        ]);
        return $result;
    }


    public function startPay($authority)
    {
        return $this->startPay_url . $authority;
    }


    public function verify($authority,$amount)
    {
        $client = new Client();
        $result = $client->post($this->verify_url,[
            'json' => [
                'merchant_id' => $this->merchant,
                'amount' => $amount,
                'authority' => $authority,
            ]
        ]);
        return $result;
    }
}
