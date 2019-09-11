<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable = ['name','street','city','state','zip','country','latitude','longtitude'];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}


