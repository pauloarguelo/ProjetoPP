<?php

namespace App\Http\Controllers\V1;

use App\Exceptions\CustomValidationException;
use App\Services\Transaction\TransactionService;
use Laravel\Lumen\Routing\Controller as BaseController;

class TransactionController extends BaseController
{   
    /**
     * 
     */
    protected $service;

    /**
     * @var TransactionService
     */
    public function __construct(TransactionService $service)
    {   
           $this->service = $service;
    }

    /**
     * 
     */
    public function new()
    {
        try {
            
            /*
            if(auth()->user()->id != request()->get('payer')){	
                throw new CustomValidationException('You are not allowed to make this transaction.');
            }
            */

            $this->service->create(request()->all());            
            return response()->json(['message' => 'Transaction created.'], 200);
        } catch (CustomValidationException $e) {   
            return response()->json(['error' => $e->getMessage()], 400);
        }  

    }
}