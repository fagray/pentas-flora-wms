<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['job_id','ref_no','customer_id','inv_no','due_date','total_amount','balance_amount','notes'];
    protected $with = ['customer','payments'];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function items()
    {
        return $this->belongsToMany(Waste::class,'invoice_items');
    }

    public function payments()
    {
        return $this->hasMany(InvoicePayment::class);
    }

    

}
