<?php

namespace App\Services\Transaction;

use App\Exceptions\CustomValidationException;
use App\Exceptions\ExternalRequestException;
use App\Exceptions\TransactionErrorException;
use App\Jobs\SendNotificationEmail;
use App\Repositories\Transaction\TransactionRepository;
use App\Services\External\ExternalAuthorizerTransaction;
use App\Services\Notification\NotificationService;
use App\Services\Wallet\WalletService;
use \Exception;
use Illuminate\Bus\Dispatcher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Queue;
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
     * @var ExternalAuthorizerTransaction
     */
    protected $externalAuthorizationService;

    /**
     * @var NotificationService
     */
    protected $notificationService;

    public function __construct(TransactionRepository $repository, ExternalAuthorizerTransaction $externalAuthorizationService,
    NotificationService $notificationService,WalletService $walletService)
    {
        $this->repository = $repository;
        $this->walletService = $walletService;
        $this->notificationService = $notificationService;        
        $this->externalAuthorizationService = $externalAuthorizationService;
    }
    

    public function create($data){
        
      
        if($this->validateRequestData($data)){

            try {

                DB::beginTransaction();

                $PayerWallet = $this->walletService->findByParam('user_id', $data['payer']);
                $PayeeWallet = $this->walletService->findByParam('user_id', $data['payee']);
            
                $PayeeWallet['balance'] += floatval($data['amount']) ;
                $PayerWallet['balance'] -= floatval($data['amount']);

                $this->walletService->update($PayeeWallet['id'], $PayeeWallet);
                $this->walletService->update($PayerWallet['id'], $PayerWallet);

  
                $data['wallet_payer_id'] = $PayerWallet['id'];
                $data['wallet_payee_id'] = $PayeeWallet['id'];

                if (!$this->externalAuthorizationService->request() == 200) {
                    throw new TransactionErrorException('Transaction failed');
                }
            
               $result = $this->repository->create($data);

               $this->notificationService->notifyUser($data['payee'], 'Transaction', 'Congratulations, you have received a transaction');	
               
               DB::commit();

               return $result;

            } catch (Exception  $e) {
                dd($e->getMessage());
                DB::rollBack();
               throw new CustomValidationException('A problem occurred while creating the transaction. Try again later.');
            }
            
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
            'payer' => 'required|integer|exists:users,id|availableBalance:amount|validPermission',
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