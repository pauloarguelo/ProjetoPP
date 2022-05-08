<?php

namespace App\Repositories\User;

use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository
{
    /**
       * Create a new register whith wallet
       * @param array $data
       * @return array
       */
    public function createUser(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        return $this->model::create($data)->wallet()->create(['balance' => 0]);
    }
}
