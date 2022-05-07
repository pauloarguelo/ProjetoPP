<?php

namespace App\Repositories\User;

use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository
{
  /**
     * Create a new register whith wallet
     * @param array $data
     * @return array
     */
    public function createTest(array $data)
    {
        return $this->model::create($data)->wallet()->create(['balance' => 0]);        
    }  
}