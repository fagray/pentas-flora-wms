<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    public function wastes()
    {
        return $this->hasMany(Waste::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
