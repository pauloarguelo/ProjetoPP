<?php
namespace App\Validators;

use Illuminate\Support\Facades\Validator;

class CpfValidator implements ValidatorInterface
{
    public static function validate()
    {
        //Extending the custom validation rule.
        Validator::extend('cpf', function ($attribute, $value) {
            $cpf = preg_replace('/[^0-9]/is', '', $value);
                       
            if (strlen($cpf) != 11) {
                return false;
            }
           
            if (preg_match('/(\d)\1{10}/', $cpf)) {
                return false;
            }
           
            for ($t = 9; $t < 11; $t++) {
                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf[$c] * (($t + 1) - $c);
                }
                $d = ((10 * $d) % 11) % 10;
                if ($cpf[$c] != $d) {
                    return false;
                }
            }

            return true;
        });
        
        Validator::replacer('cpf', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':attribute', $attribute, ":attribute is not a valid CPF number.");
        });
    }
}
