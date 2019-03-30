<?php

namespace mastani\IDPay;

class IDPayInquiry extends IDPay {
    public const URL_INQUIRY = 'https://api.idpay.ir/v1.1/payment/inquiry';

    private $ID = '';
    private $orderID = '';

    /**
     * Set ID.
     *
     * @param string $id
     * @return $this
     */
    public function setID($id) {
        $this->ID = $id;
        return $this;
    }

    /**
     * Set order ID.
     *
     * @param string $orderID
     * @return $this
     */
    public function setOrderID($orderID) {
        $this->orderID = $orderID;
        return $this;
    }

    public function request() {
        if (strlen($this->ID) == 0) die('ID is required.');
        if (strlen($this->orderID) == 0) die('order_id is required.');

        $response = parent::call(self::URL_INQUIRY, [
            'id' => $this->ID,
            'order_id' => $this->orderID
        ]);

        return $response;
    }
}