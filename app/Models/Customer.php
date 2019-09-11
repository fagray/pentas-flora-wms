<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable  = ['type','display_name','contact_no','fax','email',
                            'street','city','state','zip','country','latitude','longtitude'];

    protected $with = ['workshops'];
    
    /**
     * Get all of the customer's jobs.
     */
    public function jobs()
    {
        return $this->morphMany('App\Models\Job', 'costcenter');
    }

    /**
     * Determine where the customer endure costs.
     */
    public function invoiceItems()
    {
        return $this->morphMany('App\Models\InvoiceItem', 'costcenter');
    }

    public function wastes()
    {
        return $this->belongsToMany(Waste::class,'customer_wastes');
    }

    public function workshops()
    {
        return $this->hasMany(Workshop::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

   
}
