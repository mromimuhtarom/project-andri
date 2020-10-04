<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $table = 'address';
    public $timestamps = false;
    protected $fillable = array('accept_name', 'province_id', 'province_name', 'city_id', 'city_name', 'postal_code', 'detail_address', 'user_id', 'status', 'telp');
}
