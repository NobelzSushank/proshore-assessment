<?php

namespace App\Repositories\Contracts;

interface BaseRepositoryInterface
{
    public function fetchAll(array $with = []): object;
    public function fetch(string $id, array $with = []): object;
    public function store(array $data): object;
    public function update(array $data, string $id): object;
    public function delete(string $id): object;
    public function sync(
        object $model,
        string $relation,
        mixed $attributes,
        bool $detaching = true
    ): object;
}
