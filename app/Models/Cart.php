<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'chart';
    public $timestamps = false;
    protected $fillable = array('product_id', 'qty', 'user_id');

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function variation_detail()
    {
        return $this->hasOne(Variationdetail::class, 'id', 'variation_detail_id');
    }

    public function variation()
    {
        return $this->hasOne(Variation::class, 'variation_id', 'variation_id');
    }
}
