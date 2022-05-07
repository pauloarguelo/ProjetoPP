<?php
namespace App\Validators;

use App\Enums\UserCategoryEnum;
use App\Services\User\UserService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;

class ValidPermissionValidator implements ValidatorInterface
{
    public static function validate()
    {
        //Extending the custom validation rule.
        Validator::extend('validPermission', function ($attribute, $value, $parameters, $validator) {
            $test = App::make(UserService::class)->findByParam('id', $value);

            if (empty($test)) {
                return false;
            }
            if(in_array($test['user_category_id'], [UserCategoryEnum::JURIDICAL_PERSON])){
                return true;
            }	
            return false;
        });
        
        Validator::replacer('validPermission', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':attribute', $attribute, "Payer don`t have the permission to make this transaction.");
        });
    }
}
