<?php

namespace App\Services;

use App\Exceptions\ValidationException;
use Database\Factories\UserFactory;
use Illuminate\Support\Facades\Validator;

class UserService extends BaseService
{
    public function validateRegisterNewUser(array $data)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'document' => 'required|string|max:255|unique:users',
            'user_category_id' => 'required|integer|exists:user_categories,id',
        ];

        $validator = Validator::make($data, $rules);
        
        if($validator->fails()){
            throw new ValidationException(join(", ", $validator->errors()->all()));
        }

        return true;
    }
    
    public function registerUser(array $data){
       $this->repository->create($data);
    }
}