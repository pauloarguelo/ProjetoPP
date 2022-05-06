<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       User::factory()->count(50)->create()->each(function ($user) {
           $user->wallet()->create([
               'balance' => $user->user_category_id == 1 ? 1000 : 555.55,
              ]);
         });
    }
}
