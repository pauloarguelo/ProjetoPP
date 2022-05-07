<?php

namespace Tests\Validators;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AvailableBalanceValidatorTest extends TestCase
{
    
   
    public function test_available_balance_validator()
    {   
        $wallet = User::where('email', '=', 'paulo@teste.com')->first()->wallet()->first();
        $data = [
            'amount' => 100,
            'payer' => $wallet['user_id'],
        ];

        $validator = Validator::make($data, ['payer' => 'available_balance:amount']);
        $this->assertEquals(($wallet['balance'] >= $data['amount']), $validator->passes());
    }

    public function test_available_balance_validator_with_negative_amount()
    {   
        $wallet = User::where('email', '=', 'paulo@teste.com')->first()->wallet()->first();
        $data = [
            'amount' => 10000,
            'payer' => $wallet['user_id'],
        ];

        $validator = Validator::make($data, ['payer' => 'available_balance:amount']);
        $this->assertEquals(false, $validator->passes());
    }
    

  
}
