<?php

namespace App\Services;

interface ServiceInterface
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
    public function delete(int $id): bool;

    /**
     * Find registers by param.
     * @param string $param
     * @param string $value
     */
    public function findByParam($param, $value): array;
}
