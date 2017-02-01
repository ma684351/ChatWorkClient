<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace client;

class ChatWorkClient {
    /**
     * chatWork token
     * @var string 
     */
    private $chatWorkToken;
    
    /**
     * CurlClientのインスタンス
     * @var CurlClient 
     */
    private $curlClient = null;
    
    /**
     * チャットルームid
     * @var string
     */
    private $roomId = null;
    
    
            
    function __construct($chatWorkToken) {
        $this->chatWorkToken = $chatWorkToken;
        $this->curlClient = new CurlClient();
    }
    

    const API_URL = 'https://api.chatwork.com/v2/';
    
    const ROOMS = 'rooms/';
    
    const MESSAGES = '/messages';
    
    /**
     * post message
     * @param string $message
     * @return string json
     * @throws Exception
     */
    function postMessage($message){
        if(!isset($this->roomId)){
            throw new Exception('null roomId');
        }
        
        $url = self::API_URL.self::ROOMS.$this->roomId.self::MESSAGES;
        $header = array("X-ChatWorkToken: {$this->chatWorkToken}");
        $parameters = http_build_query(array('body' => $message), '', '&');
        
        $response = $this->curlClient->httpPost($url, $parameters, $header);
        
        return $response;
    }
    
    
    /**
     * set room id
     * @param string $roomId
     */
    function setRoomId($roomId) {
        $this->roomId = $roomId;
    }

}
