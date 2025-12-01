# rahatPay
پکیج ساده و قابل توسعه برای اتصال به درگاه‌های پرداخت **Zarinpal** و **Zibal** در لاراول.

این پکیج به شما اجازه می‌دهد بدون درگیر شدن با جزییات هر درگاه، تنها با یک ساختار یکسان پرداخت را انجام دهید.

---

## 🚀 نصب

### 1. نصب از طریق Composer
```bash
composer require alirezasadeghian79/rahatpay
```

### 1. publish
```bash
php artisan vendor:publish --provider="rahatPay\Providers\PaymentServiceProvider"
```

### 2. تنظیمات config.php
```bash
    'default' => 'zarinpal', // انتخاب درایور
    'drivers' => [
        'zarinpal' => [
            'merchant_id' => env('ZARINPAL_MERCHANT_ID'), // کد مرچنت zarinpal
            'default' => 'sandbox',  // sandbox || payment حالت استفاده بین این دو گزینه
            'routes' => [
              ...
            ]
        ],
        'zibal' => [
            'merchant_id' => env('ZIBAL_MERCHANT_ID'), // کد مرچنت zibal برای تست همان zibal قرار دهید
            'routes' => [
                ...
            ],
        ]
    ],
```

### 3. pay - ایجاد درخواست
```bash
use rahatPay\Services\Payment; // فراخوانی کتابخانه

$rahatPay = new Payment(); // فراخوانی متود سازنده

$payment = $rahatPay
    ->setAmount(15000) // مبلغ سفارش
    ->setDescription('ثبت سفارش') // توضیحات سفارش
    ->setCallback(route('pay.result')); // آدرس callBack
    
$response = $payment->pay(); // ایجاد درخواست

$authority = $response['authority']; // authority شناسه تراکنش ایجاد شده

$redirect_url = $payment->startPay($authority); // ایجاد آدرس درگاه پرداخت برای ریدایرکت

return redirect()->to($redirect_url); // ریدایرکت به درگاه
```

### 4. verify - تایید پرداخت
```bash
use rahatPay\Services\Payment; // فراخوانی کتابخانه

$rahatPay = new Payment(); // فراخوانی متود سازنده

// Zarinpal
$authority = $request->get('Authority'); // Authority شناسه پرداخت 
$status = $request->get('Status'); وضعیت پرداخت
if ($status == 'OK'){
    $result = $payment->verify($authority,15000); // تایید درخواست
}

// Zibal
$authority = $request->get('trackId'); // Authority شناسه پرداخت 
$status = $request->get('success'); وضعیت پرداخت
if ($status == 1){
    $result = $payment->verify($authority,15000); // تایید درخواست
}    
```
