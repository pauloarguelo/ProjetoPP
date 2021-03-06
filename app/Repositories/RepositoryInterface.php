<?php

namespace App\Repositories;

interface RepositoryInterface
{
    /**
     * Return all registers.
     * @param int $limit
     * @param string $orderBy
     */
    public function findAll(int $limit = 10, string $orderBy): array;

    /**
     * Find a register by id.
     * @param int $id
     * @return array
     */
    public function findById(int $id): array;

    /**
     * Find a register by param.
     */
    public function findByParam($param, $value): array;

    /**
     * Create a new register.
     * @param array $data
     * @return array
     */
    public function create(array $data): array;

    /**
     * Update a register.
     * @param int $id
     * @return bool
     */
    public function update(int $id, array $data) : bool;

    /**
     * Delete a register.
     * @param int $id
     * @return bool
     */
    public function delete($id): bool;
}
