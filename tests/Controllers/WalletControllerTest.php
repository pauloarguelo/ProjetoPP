<?php

namespace Tests\Controllers;


use App\Models\User;
use Tests\TestCase;

class WalletControllerTest extends TestCase
{
    public function test_retrieve_wallet()
    {
        $user = User::where('email', '=', 'paulo@teste.com')->first();	
       
        $response = $this->actingAs($user, 'api')
        ->json('get', 'api/v1/wallet');
        
        $this->seeStatusCode(200);
    }
}