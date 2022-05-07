<?php

namespace App\Services\External;

use App\Exceptions\ExternalRequestException;

class BaseExternalRequest
{
    protected $url;

    public function __construct($endpoint)
    {
        $this->url = $endpoint;
    }

    public function request()
    {
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', $this->url);
            return $response->getStatusCode();
        } catch (\Exception $e) {         
             throw new ExternalRequestException('External request failed. '. $e->getMessage());
        }
    }
        
}
