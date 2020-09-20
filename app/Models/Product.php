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
        return $this->belongsTo('App\Models\Pricegroup', 'foreign_key', 'price_group_id');
    }

    public function variation()
    {
            return $this->hasMany('App\Models\Variation', 'foreign_key', 'product_id');
    }
}
