<?php

namespace App\Services\Transaction;

use App\Enums\TransactionCategoryEnum;
use App\Exceptions\CustomValidationException;
use App\Repositories\Transaction\TransactionRepository;
use App\Services\User\UserService;
use App\Services\Wallet\WalletService;
use Illuminate\Support\Facades\Validator;


class TransactionService
{       
    /**
     * @var TransactionRepository
     */
    protected $repository;

    /**
     * @var WalletService
     */
    protected $walletService;

    /**
     * @var UserService
     */
    protected $userService;

    public function __construct(TransactionRepository $repository, WalletService $walletService, UserService $userService)
    {
        $this->repository = $repository;
        $this->walletService = $walletService;
        $this->userService = $userService;
    }
    

    public function create($data){
        $user = auth()->user();
      
        if($this->validateRequestData($data)){


            $PayerWallet = $this->walletService->findByParam('user_id', $data['payer']);
            $PayeeWallet = $this->walletService->findByParam('user_id', $data['payee']);
            
            $PayeeWallet['balance'] += floatval($data['amount']) ;
            $PayerWallet['balance'] -= floatval($data['amount']);

            $this->walletService->update($PayeeWallet['id'], $PayeeWallet);
            $this->walletService->update($PayerWallet['id'], $PayerWallet);

  
            $data['wallet_payer_id'] = $PayerWallet['id'];
            $data['wallet_payee_id'] = $PayeeWallet['id'];
            

            return $this->repository->create($data);
            
        }
    }


    /**
     * Validate the data request
     * @param $data
     */
    public function validateRequestData(array $data)
    {

        $rules = [
            'amount' => 'required|numeric|min:0.1',	    
            'payer' => 'required|integer|exists:users,id|availableBalance:amount',
            'payee' => 'required|integer|different:payer|exists:users,id',
            'description' => 'nullable|string|max:255',	
        ];

        $validator = Validator::make($data, $rules);
        
        if($validator->fails()){
            throw new CustomValidationException($validator->errors());
        }

        return true;
    }

}