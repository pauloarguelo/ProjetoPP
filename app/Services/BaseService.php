<?php

namespace App\Services;
use App\Repositories\RepositoryInterface;
use Illuminate\Support\Arr;

abstract class BaseService implements ServiceInterface
{
    protected  $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    
    /**
     * Return all registers.
     * @param int $limit
     * @param string $orderBy
     * @return array
     */
    public function findAll(int $limit = 10, string $orderBy): array
    {
        return $this->repository->findAll($limit, $orderBy);
    }

    /**
     * Find a register by id.
     * @param int $id
     * @return array
     */     
    public function findById(int $id): array
    {
        return $this->repository->findById($id);
    }
    
    /**
     * Create a new register.
     * @param array $data
     * @return array
     */    
    public function create(array $data): array
    {
        return $this->repository->create($data);
    }
    
    /**
     * Update a register.
     * @param int $id
     * @return bool
     */     
    public function update(int $id, array $data): bool
    {
        return $this->repository->update($id, $data);
    }

    /**
     * Delete a register.
     * @param int $id
     * @return bool
     */     
    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }    

    /**
     * Find registers by param.
     * @param string $param
     * @param string $value
     */
    public function findByParam($param, $value): array
    {
        return $this->repository->findByParam($param, $value);
    }
}