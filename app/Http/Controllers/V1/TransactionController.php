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
     * @api {post} /transaction Transaction
     * @apiName Transaction
     * @apiGroup Transaction
     * 
     * @apiDescription Create a new transaction. Requires authentication.
     * 
     * @apiSampleRequest /api/v1/transaction
     * 
     * @apiParam {float} amount The transaction amount.
     * @apiParam {string} description The transaction description.
     * @apiParam {int} payer_id The transaction payer id.
     * @apiParam {int} payee_id The transaction payee id.
     * 
     * @apiParamExample {json} Request-Example:
     *           {
     *              "amount" : 10.50,
     *              "payer" : 11,
     *              "payee" : 2,
     *              "description" : "Peace of Cake"
     *           }          
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