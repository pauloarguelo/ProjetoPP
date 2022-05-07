<?php

namespace App\Services\User;

use App\Services\BaseService;
use App\Exceptions\CustomValidationException;
use Illuminate\Support\Facades\Validator;


class UserService extends BaseService
{
    public function validateRegisterNewUser(array $data)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'document' => 'required|string|min:11|unique:users|cnpj',
            'user_category_id' => 'required|integer|exists:user_categories,id',
        ];

        $validator = Validator::make($data, $rules);
        
        if($validator->fails()){
            throw new CustomValidationException($validator->errors());
        }

        return true;
    }
    
    public function registerUser(array $data){
       return $this->repository->createTest($data);
    }
}