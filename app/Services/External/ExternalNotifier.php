<?php

namespace App\Services\External;

class ExternalNotifier extends BaseExternalRequest
{
    public function __construct()
    {
        parent::__construct(env('EXTERNAL_NOTIFIER_PROVIDER'));
    }
}