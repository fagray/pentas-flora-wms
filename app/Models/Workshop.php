<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    protected $fillable  = ['display_name','contact_no','fax','email',
                            'street','city','state','zip','country','latitude','longtitude'];
    /**
     * Get all of the workshop's jobs.
     */
    public function jobs()
    {
        return $this->morphMany('App\Models\Job', 'costcenter');
    }

    /**
     * Determine where the workshop endure costs.
     */
    public function invoiceItems()
    {
        return $this->morphMany('App\Models\InvoiceItem', 'costcenter');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    
}
