<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    protected $fillable = ['invoice_id','volume','waste_id','unit_id','price','costcenter_type',''];
    /**
     * Get all of the models that own the invoice items.
     */
    // public function costcenterable()
    // {
    //     return $this->morphTo();
    // }
}
