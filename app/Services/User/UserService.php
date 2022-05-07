<?php

namespace App\Services\User;

use App\Services\BaseService;
use App\Exceptions\CustomValidationException;
use Illuminate\Support\Facades\Validator;
use App\Enums\UserCategoryEnum;


class UserService extends BaseService
{   
    public function register(array $data){
        if($this->validate($data)){
            return $this->repository->create($data);
        }
    }

    public function validate(array $data)
    {

        $documentRule = $data['user_category_id'] == UserCategoryEnum::PRIVATE_PERSON ? 'cpf' : 'cnpj';

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'document' => 'required|string|min:11|unique:users|'.$documentRule,
            'user_category_id' => 'required|integer|exists:user_categories,id',
        ];

        $validator = Validator::make($data, $rules);
        
        if($validator->fails()){
            throw new CustomValidationException($validator->errors());
        }

        return true;
    }
    
}