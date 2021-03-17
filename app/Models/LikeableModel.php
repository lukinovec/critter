<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\Service;

class LikeableModel extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function likes()
    {
        return $this->hasMany(Like::class, "parent_id")->where("parent", strtolower((new Service(get_called_class()))->name()));
    }

    public function author()
    {
        return $this->belongsTo(Profile::class, "profile_id");
    }
}
