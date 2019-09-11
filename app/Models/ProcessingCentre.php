<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProcessingCentre extends Model
{
    protected $fillable = ['name','street','city','state','zip','country'];

    public function employees()
    {
        return $this->hasMany(App\Models\Employee::class);
    }
}
