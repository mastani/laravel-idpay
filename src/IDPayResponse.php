<?php

namespace mastani\IDPay;

class IDPayResponse {
    public $response_code;
    public $is_successful = false;

    public function isSuccessful() {
        return $this->is_successful;
    }

    public function getResponseCode() {
        return $this->response_code;
    }

    public static function parse($result_code, $json) {
        $response = new IDPayResponse();
        $response->response_code = $result_code;

        switch ($result_code) {
            case 200:
            case 201:
                $response->is_successful = true;
                break;

            case  400:
            case  403:
            case  405:
            case  406:
                $response->is_successful = false;
                break;
        }

        foreach ($json as $key => $val) {
            $response->{$key} = $val;
        }

        return $response;
    }
}