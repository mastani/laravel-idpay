<?php

namespace mastani\IDPay;

class IDPay {
    const URL_PAYMENT = 'https://api.idpay.ir/v1.1/payment';
    const URL_INQUIRY = 'https://api.idpay.ir/v1.1/payment/inquiry';

    private $apiKey;
    private $sandbox = false;

    public function __construct() {
        if (!$this->_hasCurl())
            die('curl is required for use this class');
    }

    /**
     * set API Key.
     *
     * @param string $apiKey
     * @return $this
     */
    public function setApiKey($apiKey) {
        $this->apiKey = $apiKey;
        return $this;
    }

    /**
     * set Sandbox status.
     *
     * @param bool $sandbox
     * @return $this
     */
    public function setSandbox($sandbox) {
        $this->sandbox = $sandbox;
        return $this;
    }

    public function call($params) {
        $header = array(
            'Content-Type: application/json',
            'X-API-KEY:' . $this->apiKey,
            'X-SANDBOX:' . $this->sandbox,
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, self::URL_PAYMENT);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $result = curl_exec($ch);
        $result_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return IDPayResponse::parse($result_code, json_decode($result));
    }

    private function _hasCurl() {
        return function_exists('curl_version');
    }
}