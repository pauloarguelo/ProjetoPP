<?php

namespace App\Http\Controllers\V1;


use App\Services\Wallet\WalletService;
use Laravel\Lumen\Routing\Controller as BaseController;

class WalletController extends BaseController
{
    protected $service;

    public function __construct(WalletService $service)
    {
        $this->service = $service;
    }

     /**
     * @api {get} /wallet Wallet
     * @apiName Wallet
     * @apiGroup Wallet
     * @apiVersion 1.0.0
     *
     * @apiDescription Return the current user wallet. Requires authentication.
     *
     * @apiSampleRequest /api/v1/wallet
     *
     * 
     * @apiHeader {String} Authorization Bearer Token.
     *
     * 
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *      {
     *          {
     *          "id": 11,
     *          "balance": 179.5,
     *          "user_id": 11,
     *          "created_at": "2022-05-08T05:49:46.000000Z",
     *          "updated_at": "2022-05-08T15:11:31.000000Z"
     *      }
     *      
     */
    public function myWallet(){
        return $this->service->findByParam('user_id' , auth()->user()->id);
    }
    
}