<?php

namespace App\Repositories;

class UserRepository extends BaseRepository
{
  /**
     * Create a new register whith wallet
     * @param array $data
     * @return array
     */
    public function createTest(array $data)
    {
        return $this->model::create($data)->with('wallet');        
    }  
}