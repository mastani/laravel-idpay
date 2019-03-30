<?php

class TestCase extends \PHPUnit\Framework\TestCase {

    const MY_API = "*****";
    const MY_CALLBACK = "https://mastani.app/";
    const SANDBOX = true;

    public function testPayment() {
        $pay = new \mastani\IDPay\IDPayPayment();

        $res = $pay->setApiKey(self::MY_API)
            ->setSandbox(self::SANDBOX)
            ->setOrderID('10000')
            ->setCallback(self::MY_CALLBACK)
            ->setPrice(50000)
            ->request();

        echo print_r($res, true);
        $this->assertTrue(true);
    }

    public function testVerify() {
        $pay = new \mastani\IDPay\IDPayVerify();

        $res = $pay->setApiKey(self::MY_API)
            ->setSandbox(self::SANDBOX)
            ->setID('c89d57be6ff07c013009cc6783ec1c76')
            ->setOrderID('10000')
            ->request();

        echo print_r($res, true);
        $this->assertTrue(true);
    }

    public function testInquiry() {
        $pay = new \mastani\IDPay\IDPayInquiry();

        $res = $pay->setApiKey(self::MY_API)
            ->setSandbox(self::SANDBOX)
            ->setID('c89d57be6ff07c013009cc6783ec1c76')
            ->setOrderID('10000')
            ->request();

        echo print_r($res, true);
        $this->assertTrue(true);
    }
}