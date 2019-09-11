<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PricelistItem extends Model
{
    protected $table = 'price_list_items';
    protected $fillable = ['price_list_id','waste_id','unit_price','unit_id'];

    public function pricelist()
    {
        return $this->belongsTo(Pricelist::class,'price_list_id');
    }
}
