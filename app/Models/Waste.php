<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Waste extends Model
{
    protected $fillable = ['code','category_id','sub_category_id','name','description','unit_price','unit_id'];

    protected $with = ['unit','category'];

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function customers()
    {
        return $this->belongsToMany(Customer::class,'customer_wastes');
    }

    public function pricelists()
    {
        return $this->belongsToMany(PriceList::class,'price_list_items');
    }

    public function jobs()
    {
        return $this->belongsToMany(Job::class,'job_wastes');
    }

    public function invoices()
    {
        return $this->belongsToMany(Invoice::class);
    }
}
