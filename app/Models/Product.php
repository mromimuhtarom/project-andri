<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';
    protected $primary_key = 'product_id';
    protected $guarded = [];
    public $timestamps = false;

    public function pricegroup()
    {
        return $this->hasOne(Pricegroup::class, 'price_group_id', 'price_group_id');
    }

    public function variation()
    {
            return $this->hasOne('App\Models\Variation', 'product_id', 'product_id');
    }

    public function variation_detail()
    {
        return $this->variation->hasMany('App\Models\Variationdetail', 'variation_id', 'variation_id');
    }
}
