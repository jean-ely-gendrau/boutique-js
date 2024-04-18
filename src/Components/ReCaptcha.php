<?php

namespace App\Boutique\Components;

class ReCaptcha
{
    private $secretKey = '6Lf4Cb8pAAAAAKtGy0bsEgzfOUGBJ3R8n1nbbCYQ';

    public function notRobot($response)
    {
        $secretKey = $this->secretKey;
        $api_url = 'https://www.google.com/recaptcha/api/siteverify';
        $resq_data = array(
            'secret' => $secretKey,
            'response' => $response,
            'remoteip' => $_SERVER['REMOTE_ADDR']
        );

        $curlConfig = array(
            CURLOPT_URL => $api_url,
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => $resq_data,
            CURLOPT_SSL_VERIFYPEER => false
        );

        $ch = curl_init();
        curl_setopt_array($ch, $curlConfig);
        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            $api_error = curl_error($ch);
        }
        curl_close($ch);

        $responseKeys = json_decode($response, true);
        if ($responseKeys['success']) {
            return true;
        } else {
            return false;
        }
    }
}