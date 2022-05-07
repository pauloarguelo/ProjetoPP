<?php

namespace Tests\Validators;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class ValidPermissionValidatorTest extends TestCase
{
    
    /**
     * Validate the request data.
     */
    public function test_valid_permission_validator()
    {   
        $user = User::where('email', '=', 'paulo@teste.com')->first();
        $data = [            
            'payer' => $user['id']
        ];

        $validator = Validator::make($data, ['payer' => 'validPermission']);
        $this->assertEquals(true, $validator->passes());
    }

    /**
     * Validate the request data.
     */
    public function test_valid_permission_validator_with_invalid_permission()
    {   
        $user = User::where('email', '=', 'grocery-store@teste.com')->first();
        $data = [            
            'payer' => $user['id']
        ];

        $validator = Validator::make($data, ['payer' => 'validPermission']);
        $this->assertEquals(false, $validator->passes());
    }



  
}