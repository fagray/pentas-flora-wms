<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoicePayment extends Model
{
    protected $fillable = ['amount_paid','payment_date','cheque_no','bank_name','mode','invoice_id','deposit_slip_no','notes'];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

}
