<?php

namespace Tests\Validators;

use Tests\TestCase;
use Illuminate\Support\Facades\Validator;

class CpfCnpjValidatorTest extends TestCase
{
    public function providerCNPJ()
    {
        return [
            ['59.843.299/0001-99', true],
            ['59.842.299/0001-99', false],
            ['00.000.000/0000-00', false],
            ['544.161.550-85', false],
            [0, false]
        ];
    }

    public function providerCPF()
    {
        return [
            ['731.862.410-57', true],
            ['59.842.299/0001-99', false],
            ['731.862.410-57-45', false],
            ['831.862.410-57', false],
            ['544.161.550-85', true],
            [0, false],
            ['11111111111', false]
        ];
    }



    /**
     * Test CPF validator.
     *
     * @dataProvider providerCPF
     */
    public function test_cpf_validator($cpf, $valid)
    {
        $validator = Validator::make(['document' => $cpf], ['document' => 'cpf']);
        $this->assertEquals($valid, $validator->passes());
    }

    /**
     * Test CNPJ validator.
     *
     * @dataProvider providerCNPJ
     */
    public function test_cnpj_validator($cnpj, $valid)
    {
        $validator = Validator::make(['document' => $cnpj], ['document' => 'cnpj']);
        $this->assertEquals($valid, $validator->passes());
    }
}
