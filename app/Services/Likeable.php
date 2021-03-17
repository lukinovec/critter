<?php

namespace App\Services;

use App\Models\Like;
use App\Helpers\Service;
// Rozhraní pro přidání a odebrání like

class Likeable extends Crudable
{
    /**
     * @param int $id
     *
     * @return Like
     */
    public function like(int $id): Like
    {
         return Like::create([
            "profile_id" => auth()->id(),
            "parent_id" => $id,
            "parent" => strtolower((new Service(get_called_class()))->name())
        ]);
    }

    /**
     * @param int $id
     *
     * @return int
     */
    public function unlike(int $parent_id): int
    {
        return Like::where([
            "profile_id" => auth()->id(),
            "parent_id" => $parent_id,
        ])->delete();
    }
}