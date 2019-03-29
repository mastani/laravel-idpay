<?php

namespace mastani\IDPay;

class IDPayPaymentCallback {

    public $is_successful = false;
    public $result;

    public $status;
    public $trackID;
    public $ID;
    public $orderID;
    public $amount;
    public $cardNO;
    public $date;

    public function __construct($data) {
        $this->status = $data['status'];
        $this->trackID = $data['track_id'];
        $this->ID = $data['id'];
        $this->orderID = $data['order_id'];
        $this->amount = $data['amount'];
        $this->cardNO = $data['card_no'];
        $this->date = $data['date'];

        $this->parseStatus();
    }

    public function isSuccessful() {
        return $this->is_successful;
    }

    private function parseStatus() {
        switch ($this->status) {
            case 1;
                $this->is_successful = false;
                $this->result = 'پرداخت انجام نشده است';
                break;

            case 2;
                $this->is_successful = false;
                $this->result = 'پرداخت ناموفق بوده است';
                break;

            case 3;
                $this->is_successful = false;
                $this->result = 'خطا رخ داده است';
                break;

            case 4;
                $this->is_successful = false;
                $this->result = 'بلوکه شده';
                break;

            case 5;
                $this->is_successful = false;
                $this->result = 'برگشت به پرداخت کننده';
                break;

            case 6;
                $this->is_successful = false;
                $this->result = 'برگشت خورده سیستمی';
                break;

            case 10;
                $this->is_successful = false;
                $this->result = 'در انتظار تایید پرداخت';
                break;

            case 100;
                $this->is_successful = true;
                $this->result = 'پرداخت تایید شده است';
                break;

            case 101;
                $this->is_successful = true;
                $this->result = 'پرداخت قبلا تایید شده است';
                break;

            case 200;
                $this->is_successful = true;
                $this->result = 'به دریافت کننده واریز شد';
                break;
        }
    }
}