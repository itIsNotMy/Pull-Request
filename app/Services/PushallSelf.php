<?php

namespace App\Services;

class PushallSelf implements Pushall
{
    private $id;
    private $apiKey;
    
    public function __construct($id, $apiKey)
    {
        $this->id = $id;
        $this->apiKey = $apiKey;
    }
    
    public function send($message)
    {
        $ch = curl_init();
        curl_setopt_array($ch, [
        CURLOPT_URL => "https://pushall.ru/api.php",
        CURLOPT_POSTFIELDS => [
            "type" => "self",
            "id" => $this->id,
            "key" => $this->apiKey,
            "text" => $message,
            "title" => "Добавленна статья",
        ],
        CURLOPT_RETURNTRANSFER => true
        ]);
        
        $return = json_decode(curl_exec($ch)); //получить ответ или ошибку
        
        curl_close($ch);
    }
}
