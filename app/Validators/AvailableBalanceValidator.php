<?php
namespace App\Validators;

use App\Models\Wallet;
use App\Services\User\UserService;
use App\Services\Wallet\WalletService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;

class AvailableBalanceValidator implements ValidatorInterface
{   
    /**
     * Validate the balance of payer is greater than the amount requested.
     */
    public static function validate()
    {
        Validator::extend('availableBalance', function ($attribute, $value, $parameters, $validator) {
            $amountNecessary = $validator->getData()[$parameters[0]];
            $teste = App::make(WalletService::class)->findByParam('user_id', $value);
            
            if (empty($teste) || floatval($teste["balance"]) < floatval($amountNecessary)) {
                return false;
            }
            return true;
        });

        Validator::replacer('availableBalance', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':attribute', $attribute, "You don't have enought balance to make this transaction.");
        });
    }
}
