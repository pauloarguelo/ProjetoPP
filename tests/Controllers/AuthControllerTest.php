<?php

namespace Tests;

use App\Enums\UserCategoryEnum;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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


    /**
     * Register user success
     */
    public function test_register_new_user()
    {
        $parameters = [
            'name' => 'New User Request',
            'email' => 'new-user-request@gmail.com',
            'password' => 'secret',
            'password_confirmation' => 'secret',
            'document' => '547.193.240-45',
            'user_category_id' => UserCategoryEnum::PRIVATE_PERSON,
        ];
        $this->post('/api/v1/auth/register', $parameters);
        $this->seeStatusCode(200);
    }

    /**
     * @depends test_register_new_user
     */
    public function test_register_new_user_with_existing_email()
    {
        $parameters = [
            'name' => 'New User Request',
            'email' => 'new-user-request@gmail.com',
            'password' => 'secret',
            'password_confirmation' => 'secret',
            'document' => '547.193.240-45',
            'user_category_id' => UserCategoryEnum::PRIVATE_PERSON,
        ];
        $this->post('/api/v1/auth/register', $parameters);
        $this->seeStatusCode(400);

        User::where('email', 'new-user-request@gmail.com')->delete();
    }

    /**
     * Test register user with wrong document
     */
    public function test_register_new_user_with_wrong_document()
    {
        $parameters = [
            'name' => 'Mess User',
            'email' => 'mess@gmail.com',
            'password' => 'secret',
            'password_confirmation' => 'secret',
            'document' => '547.193.240-45',
            'user_category_id' => UserCategoryEnum::JURIDICAL_PERSON,
        ];
        $this->post('/api/v1/auth/register', $parameters);
        $this->seeStatusCode(400);
    }
    
}
