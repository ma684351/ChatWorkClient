<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace client;

class CurlClient {

    /**
     * Curlのインスタンス
     * @var Curl
     */
    protected $curl = null;

    /**
     * curlのオプションを格納した配列
     * @var array 
     */
    protected $option = array();

    /**
     * http ステータスコード
     * @var int
     */
    protected $httpStatusCode = 0;

    function __construct() {
        //初期化しておく
        $this->curl = curl_init();
    }

    function post() {
        //無ければ例外を吐く
        if (!isset($this->option)) {
            throw new Exception('null options');
        }
        //curlの設定をセットする
        curl_setopt_array($this->curl, $this->option);
        $response = curl_exec($this->curl);
        //httpステータス
        $this->httpStatusCode = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);
        
        return $response;
    }

    
    
    function getOption() {
        return $this->option;
    }
    
    function getHttpStatusCode() {
        return $this->httpStatusCode;
    }
    
    function setOption($option) {
        $this->option = $option;
    }

}
