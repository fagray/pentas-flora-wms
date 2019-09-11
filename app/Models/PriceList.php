<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PriceList extends Model
{
    protected $fillable = ['name','description'];

    protected $with = ['wastes'];

    public function wastes()
    {
        return $this->belongsToMany(Waste::class,'price_list_items')->withPivot('unit_price','unit_id');
    }


}
