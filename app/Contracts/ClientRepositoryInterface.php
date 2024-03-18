<?php

namespace App\Contracts;

interface ClientRepositoryInterface
{
    /**
     * Retrieve all clients from the CSV file.
     *
     * @return array
     */
    public function all(): array;

    /**
     * Find a client by ID (assuming ID is a unique identifier).
     *
     * @param int $id
     * @return array|null
     */
    public function find(int $id): ?array;

    /**
     * Create a new client and store it in the CSV file.
     *
     * @param array $data
     * @return void
     */
    public function create(array $data): void;

    /**
     * Update a client identified by ID in the CSV file.
     *
     * @param int $id
     * @param array $data
     * @return bool True if updated, False if not found
     */
    public function update(int $id, array $data): bool;

    /**
     * Delete a client identified by ID from the CSV file.
     *
     * @param int $id
     * @return bool True if deleted, False if not found
     */
    public function delete(int $id): bool;
}
