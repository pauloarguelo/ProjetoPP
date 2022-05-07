<?php
namespace App\Validators;

use Illuminate\Support\Facades\Validator;

class CnpjValidator implements ValidatorInterface
{
    public static function validate()
    {
        //Extending the custom validation rule.
        Validator::extend('cnpj', function ($attribute, $value) {
            $cnpj = preg_replace('/[^0-9]/is', '', $value);

            if (strlen($cnpj) != 14) {
                return false;
            }

            if (preg_match('/(\d)\1{13}/', $cnpj)) {
                return false;
            }

            for ($t = 12; $t < 14; $t++) {
                for ($d = 0, $m = ($t - 7), $i = 0; $i < $t; $i++) {
                    $d += $cnpj[$i] * $m;
                    $m = ($m == 2 ? 9 : --$m);
                }
                $d = ((10 * $d) % 11) % 10;
                if ($cnpj[$i] != $d) {
                    return false;
                }
            }
        
            return true;
        });
        
        Validator::replacer('cnpj', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':attribute', $attribute, ":attribute is not a valid CNPJ number.");
        });
    }
}
