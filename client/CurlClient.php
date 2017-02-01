<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace client;

class CurlClient {

    /**
     * curlのオプションを格納した配列
     * @var array 
     */
    protected $option = array();

    /**
     * レスポンスのステータス情報
     * @var array
     */
    protected $curlResponseInfo = array();

    function httpPost($url, $parameters, $header = false) {
        $ch = $this->commonCurlParamerters($url);
        
        if ($header !== false){
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        }
        
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
        curl_setopt($ch, CURLOPT_HEADER, false);

        $response = $this->execute($ch);
        return $response;
    }

    private function commonCurlParamerters($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_PORT, 443);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        return $ch;
    }

    private function execute($ch) {
        $response = '';
        $response = curl_exec($ch);
        if ($response === false) {
            $errorMessage = "Unable to post request, underlying exception of " . curl_error($ch);
            curl_close($ch);
            throw new \Exception($errorMessage);
        } else {
            $this->curlResponseInfo = curl_getinfo($ch);
        }
        curl_close($ch);
        return $response;
    }

}
