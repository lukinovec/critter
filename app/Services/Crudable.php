<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Service;
// Rozhraní pro CRUD operace

class Crudable implements CrudInterface {
    protected Model|string $model;
    public function __construct()
    {
        $this->model = "\\App\\Models\\" . (new Service(get_called_class()))->name();
    }

    /**
     * @param array $to_create
     *
     * @return Model
     */
    public function create(array $to_create): Model
    {
        return $this->model::create($to_create);
    }

    /**
     * @param array $relations
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index(array $relations = []): \Illuminate\Database\Eloquent\Collection
    {
        if (empty($relations)) {
            return $this->model::all();
        }
        return $this->model::with($relations)->get();
    }

    public function find($id): Model
    {
        return $this->model::find($id);
    }

    /**
     * @param int $id
     *
     * @return int
     */
    public function delete(int $id): int
    {
        return $this->model::destroy($id);
    }

    public function update(int $id, array $to_update)
    {
        return $this->find($id)->update($to_update);
    }
}