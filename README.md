# IDPay payment gateway for Laravel (https://idpay.ir)

IDPay gateway in Laravel.

[![Total Downloads](https://poser.pugx.org/mastani/laravel-idpay/downloads)](https://packagist.org/packages/mastani/laravel-idpay)
[![Latest Stable Version](https://poser.pugx.org/mastani/laravel-idpay/v/stable)](https://packagist.org/packages/mastani/laravel-idpay)
[![Latest Unstable Version](https://poser.pugx.org/mastani/laravel-idpay/v/unstable)](https://packagist.org/packages/mastani/laravel-idpay)
[![License](https://poser.pugx.org/mastani/laravel-idpay/license)](https://packagist.org/packages/mastani/laravel-idpay)

Table of contents
=================
<!--ts-->
   * [Installation](#installation-in-laravel-55-and-up)
   * [Request new payment](#request-new-payment)
   * [Handle callback result](#handle-callback-result)
   * [Verify payment](#verify-payment)
   * [Inquiry an old payment](#inquiry-an-old-payment)
   * [Contributors](#contributors)
   * [License](#license)
<!--te-->

### Installation in Laravel 5.5 and up

```bash
$ composer require mastani/laravel-idpay
```

The package will automatically register itself.

### Installation in Laravel 5.4

```bash
$ composer require mastani/laravel-idpay
```

Next up, the service provider must be registered:

```php
// config/app.php

'providers' => [
    ...
    mastani\IDPay\IDPayServiceProvider::class,
];
```

### Installation without Laravel

Another way is install the component through [composer](https://getcomposer.org/download/).

Either run
```bash
$ composer require mastani/laravel-idpay
```
or add
```json
"mastani/laravel-idpay": "dev-master"
```
to the require section of your composer.json.

## Usage

### Request new payment
```php
$pay = new IDPayPayment();
$response = $pay->setApiKey('IDPay API Key')
            ->setSandbox(true)
            ->setOrderID('10000') // Locally generated
            ->setCallback('https://my-website.com/callback')
            ->setPrice(50000)
            ->setName("Amin") // optional
            ->setPhone("09353361569") // optional
            ->setMail("amin@mail.com") // optional
            ->setDesc("Pay for bronze account") // optional
            ->request();
            
if ($response->is_successful) {
    // save payment details to database
    header("Location: " . $response->link);
} else {
    // handle error
}
```
##### Successful response
```code
[response_code] => 201
[is_successful] => true
[id] => 91cb30a55598f6dbdd0d4d7ad9613d88
[link] => https://idpay.ir/p/ws-sandbox/91cb30a55598f6dbdd0d4d7ad9613d88
```
##### Failed response
```code
[response_code] => 406
[is_successful] => false
[error_code] => 34
[error_message] => مبلغ `amount` باید بیشتر از 10,000 ریال باشد
```

### Handle callback result
```code
$callback = new IDPayPaymentCallback($_POST);
```

### Verify payment
```php
$verify = new IDPayVerify();
$response = $verify->setApiKey('IDPay API Key')
            ->setSandbox(true)
            ->setID('91cb30a55598f6dbdd0d4d7ad9613d88')
            ->setOrderID('10000')
            ->request();
            
if ($response->is_successful) {
    echo 'Order: ' . $response->order_id;
    echo 'Card Number: ' . $response->payment->card_no;
    // handle user credit
} else {
    // handle error
}
```
##### Successful response
```code
[response_code] => 200
[is_successful] => true
[status] => 101
[track_id] => 46826
[id] => 91cb30a55598f6dbdd0d4d7ad9613d88
[order_id] => 10000
[amount] => 50000
[date] => 1553954369
[payment] => stdClass Object
(
    [track_id] => 59670764
    [amount] => 50000
    [card_no] => 123456******1234
    [date] => 1553954369
)
[verify] => stdClass Object
(
    [date] => 1553954623
)
```
##### Failed response
```code
[response_code] => 405
[is_successful] => false
[error_code] => 53
[error_message] => تایید پرداخت امکان پذیر نیست.
```

### Inquiry an old payment
```php
$inquiry = new IDPayInquiry();
$response = $inquiry->setApiKey('IDPay API Key')
            ->setSandbox(true)
            ->setID('91cb30a55598f6dbdd0d4d7ad9613d88')
            ->setOrderID('10000')
            ->request();
            
if ($response->is_successful) {
    // success
    echo 'Order: ' . $response->order_id;
    echo 'Card Number: ' . $response->payment->card_no;
} else {
    // handle error
}
```
##### Successful response
```code
[response_code] => 200
[is_successful] => true
[status] => 100
[track_id] => 46826
[id] => 91cb30a55598f6dbdd0d4d7ad9613d88
[order_id] => 10000
[amount] => 50000
[wage] => stdClass Object
(
    [by] => payee
    [type] => percent
    [amount] => 1000
)
[date] => 1553954369
[payer] => stdClass Object
(
    [name] =>
    [phone] =>
    [mail] =>
    [desc] =>
)
[payment] => stdClass Object
(
    [track_id] => 59670764
    [amount] => 50000
    [card_no] => 123456******1234
    [date] => 1553954369
)
[verify] => stdClass Object
(
    [date] => 1553954623
)
[settlement] => stdClass Object
(
    [track_id] => 13040079970
    [amount] => 47000
    [date] => 1553984280
)
```
##### Failed response
```code
[response_code] => 400
[is_successful] => false
[error_code] => 52
[error_message] => استعلام نتیجه ای نداشت.
```

## Contributor(s)
 * Amin Mastani [https://mastani.app](https://mastani.app)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
