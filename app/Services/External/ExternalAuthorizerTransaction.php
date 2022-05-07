<?php

namespace App\Services\External;

class ExternalAuthorizerTransaction extends BaseExternalRequest
{
    public function __construct()
    {
        parent::__construct(env('EXTERNAL_AUTHORIZER_PROVIDER'));
    }
}