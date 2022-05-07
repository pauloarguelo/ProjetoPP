<?php

namespace Tests;

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class AuthTest extends TestCase
{
    /**
     * Test login success
     *
     * @return void
     */
    public function test_login()
    {
        $parameters = [
            'email' => 'paulo@teste.com',   
            'password' => 'secret',
        ];
        $this->post('/api/v1/auth/login', $parameters);	
        $this->seeStatusCode(200);
    }

    /**
     * Test login failure wrong password
     *
     * @return void
     */
    public function test_login_wrong_password()
    {
        $parameters = [
            'email' => 'paulo@teste.com',   
            'password' => 'wrongpassowrd',
        ];
        $this->post('/api/v1/auth/login', $parameters);	
        $this->seeStatusCode(401);
    }

}
