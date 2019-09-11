<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobWaste extends Model
{
    protected $table = 'job_wastes';
    protected $fillable = ['job_id','volume','waste_id','volume_collected','unit_id','unit_price'];

    protected $with = ['unit'];
    
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
