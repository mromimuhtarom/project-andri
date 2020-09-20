<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pricegroup extends Model
{
    use HasFactory;

    protected $table       = 'price_group';
    protected $primary_key = 'price_group_id';
    protected $guarded     = [];
    public    $timestamp   = false;

}
