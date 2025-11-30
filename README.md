# rahatPay
پکیج ساده و قابل توسعه برای اتصال به درگاه‌های پرداخت **Zarinpal** و **Zibal** در لاراول.

این پکیج به شما اجازه می‌دهد بدون درگیر شدن با جزییات هر درگاه، تنها با یک ساختار یکسان پرداخت را انجام دهید.

---

## 🚀 نصب

### 1. نصب از طریق Composer
```bash
composer require alirezasadeghian79/rahatpay


## 🚀 نصب

### 2. zarinpal
```bash
use rahatPay\Services\Payment;

$rahatPay = new Payment();
$payment = $rahatPay->setAmount(15000)
    ->setDescription('ثبت سفارش')
    ->setCallback(route('pay.result'));

$response = $payment->pay();
$authority = json_decode($response->getBody(),true)['data']['authority'];
$redirect_url = $payment->startPay($authority);
return redirect()->to($redirect_url);
