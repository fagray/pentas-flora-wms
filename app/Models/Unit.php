<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = ['name','symbol'];

    public function wastes()
    {
        return $this->hasMany(Waste::class);
    }

    public function jobWaste()
    {
        return $this->belongsToMany(JobWaste::class);
    }
}
