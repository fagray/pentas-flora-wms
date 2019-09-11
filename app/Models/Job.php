<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = ['employee_id','vehicle_id','price_list_id','agreement_type',
            'collection_date','collected_at','status','notes'];

    
    protected $with = ['costcenter','wastes','invoices','employee','vehicle'];
            
    /**
     * Get all of the models that own the jobs.
     */
    public function costcenter()
    {
        return $this->morphTo();
    }

    public function wastes()
    {
        return $this->belongsToMany(Waste::class,'job_wastes')
            ->withPivot('unit_price','volume','volume_collected','evidence_img_url');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class); // this is the driver
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
