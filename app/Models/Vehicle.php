<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = ['plate_no','name'];

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
}
