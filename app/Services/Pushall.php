<?php

namespace App\Services;

interface Pushall
{   
    public function __construct($id, $apiKey);
    
    public function send($message);
}
