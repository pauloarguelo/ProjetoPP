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
     * @apiVersion 1.0.0
     * 
     * @apiDescription Create a new transaction. Requires authentication.
     * 
     * @apiSampleRequest /api/v1/transaction
     * 
     * @apibody {Number} amount The transaction amount.
     * @apibody {string} description The transaction description.
     * @apibody {Number} payer_id The transaction payer id.
     * @apibody {Number} payee_id The transaction payee id.
     * 
     * @apiHeader {String} Authorization Bearer Token.
     * 
     * @apiParamExample {json} Request-Example:
     *           {
     *              "amount" : 10.50,
     *              "payer" : 11,
     *              "payee" : 2,
     *              "description" : "Peace of Cake"
     *           }          
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *      {
     *          "message": "Transaction created."
     *      }
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