<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    protected $with = ['subCategories'];

    public function wastes()
    {
        return $this->hasMany(Waste::class);
    }

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }
}
