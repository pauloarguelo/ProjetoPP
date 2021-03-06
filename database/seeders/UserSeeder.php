<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(10)->create()->each(function ($user) {
           $user->wallet()->create([
               'balance' => $user->user_category_id == 1 ? 1000 : 555.55,
              ]);
        });

        User::factory() ->create([
                'name' => 'Paulo',
                'email' => 'paulo@teste.com',
                'document' => '09420900045',
                'password' => Hash::make('secret'),
                'user_category_id' => 1,
            ])->wallet()->create([
                'balance' => 200.50
            ]);
        
        User::factory() ->create([
            'name' => 'Marcos',
            'email' => 'marcos@teste.com',
            'document' => '77686066045',
            'password' => Hash::make('secret'),
            'user_category_id' => 1,
        ])->wallet()->create([
                'balance' => 200.50,
            ]);
       

        User::factory()->create([
            'name' => 'Grocery store',
            'email' => 'grocery-store@teste.com',
            'document' => '31891035000191',
            'password' => Hash::make('secret'),
            'user_category_id' => 2
          ])->wallet()->create([
                'balance' => 200.50
          ]);

    }
}
