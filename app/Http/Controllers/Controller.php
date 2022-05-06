<?php

namespace App\Http\Controllers;
use App\Services\BaseService;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    protected $service;

    public function __construct(BaseService $service)
    {
        $this->service = $service;
    }
}
