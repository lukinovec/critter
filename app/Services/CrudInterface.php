<?php

namespace App\Services;

interface CrudInterface {
    public function create(array $to_create);
    public function index(array $relations): \Illuminate\Database\Eloquent\Collection;
    public function update(int $id, array $toUpdate);
    public function delete(int $id);
}