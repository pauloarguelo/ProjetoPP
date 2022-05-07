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

    /**
     * Find all registers based on the given parameters.
     * @param int $limit
     * @param string $orderBy
     * @return array
     */
    public function findAll(int $limit = 10, string $orderBy): array
    {
        return $this->model::orderBy($orderBy)->take($limit)->get()->toArray();
    }

    /**
     * Find a register by id.
     * @param int $id
     * @return array
     */
    public function findById(int $id): array
    {
        return $this->model::find($id)->toArray();
    }

    /**
     * Create a new register.
     * @param array $data
     * @return array
     */
    public function create(array $data): array
    {
        return $this->model::create($data)->toArray();
    }

    /**
     * Update a register.
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        return $this->model::find($id)->update($data);
    }

    /**
     * Delete a register.
     */
    public function delete($id): bool
    {
        return $this->model::destroy($id) ? true : false;
    }
    
    /**
     * Find registers by param.
     */
    public function findByParam($param, $value): array
    {
        $register = $this->model::where($param, $value)->get()->first();               
        return $register ? $register->toArray() : [];
    }
}
