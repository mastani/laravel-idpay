<?php

namespace mastani\IDPay;

class IDPayPayment extends IDPay {
    public const URL_PAYMENT = 'https://api.idpay.ir/v1.1/payment';

    private $orderID = '';
    private $amount = 0;
    private $name = '';
    private $phone = '';
    private $mail = '';
    private $desc = '';
    private $callback = '';
    private $redirect = false;

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

    /**
     * Set amount.
     *
     * @param int $amount
     * @return $this
     */
    public function setAmount($amount) {
        $this->amount = $amount;
        return $this;
    }

    /**
     * Set price.
     *
     * @param int $price
     * @return $this
     */
    public function setPrice($price) {
        return $this->setAmount($price);
    }

    /**
     * Set user name.
     *
     * @param string $name
     * @return $this
     */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    /**
     * Set user phone.
     *
     * @param string $phone
     * @return $this
     */
    public function setPhone($phone) {
        $this->phone = $phone;
        return $this;
    }

    /**
     * Set user mail.
     *
     * @param string $mail
     * @return $this
     */
    public function setMail($mail) {
        $this->mail = $mail;
        return $this;
    }

    /**
     * Set transaction description.
     *
     * @param string $desc
     * @return $this
     */
    public function setDesc($desc) {
        $this->desc = $desc;
        return $this;
    }

    /**
     * Set callback URL.
     *
     * @param string $callback
     * @return $this
     */
    public function setCallback($callback) {
        $this->callback = $callback;
        return $this;
    }

    /**
     * Set auto redirect.
     *
     * @param bool $redirect
     * @return $this
     */
    public function setAutoRedirect($redirect) {
        $this->redirect = $redirect;
        return $this;
    }

    public function request() {
        if (strlen($this->callback) == 0) die('callback is required.');
        if (strlen($this->orderID) == 0) die('order_id is required.');
        if ($this->amount == 0) die('amount is required.');

        $response = parent::call(self::URL_PAYMENT, [
            'order_id' => $this->orderID,
            'amount' => $this->amount,
            'name' => $this->name,
            'phone' => $this->phone,
            'mail' => $this->mail,
            'desc' => $this->desc,
            'callback' => $this->callback
        ]);

        if ($response->isSuccessful() && $this->redirect)
            header("Location: " . $response->link);

        return $response;
    }
}