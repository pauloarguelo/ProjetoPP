<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements RepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function findAll(int $limit = 10, string $orderBy): array
    {        
        return $this->model::orderBy($orderBy)->take($limit)->get()->toArray();        
    }
}