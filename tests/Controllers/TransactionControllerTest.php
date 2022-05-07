<?php

namespace Tests\Controllers;

use App\Enums\UserCategoryEnum;
use App\Models\User;
use Tests\TestCase;

class TransactionControllerTest extends TestCase
{
    public function test_create_new_transaction()
    {
        $payer = User::where('email', '=', 'paulo@teste.com')->first();	
        $payee = User::where('email', '=', 'grocery-store@teste.com')->first();	
        $response = $this->actingAs($payer, 'api')
        ->json('post', 'api/v1/transaction', [
            'amount' => 10.50,
            'payer' => $payer->id,
            'payee' => $payee->id,
            'description' => 'Peace of Cake'
        ]);

        $this->seeStatusCode(200);
    }

    public function test_create_new_transaction_with_invalid_payer()
    {
        $payee = User::where('email', '=', 'paulo@teste.com')->first();	
        $payer = User::where('email', '=', 'grocery-store@teste.com')->first();	
        $response = $this->actingAs($payer, 'api')
        ->json('post', 'api/v1/transaction', [
            'amount' => 10.50,
            'payer' => $payer->id,
            'payee' => $payee->id,
            'description' => 'Peace of Cake'
        ]);

        $this->seeStatusCode(400);
    }

    public function test_create_new_transaction_with_low_balance()
    {
        $payer = User::where('email', '=', 'paulo@teste.com')->first();	
        $payee = User::where('email', '=', 'grocery-store@teste.com')->first();	
        $response = $this->actingAs($payer, 'api')
        ->json('post', 'api/v1/transaction', [
            'amount' => 2000.00,
            'payer' => $payer->id,
            'payee' => $payee->id,
            'description' => 'Peace of Cake'
        ]);

        $this->seeStatusCode(400);
    }
}
