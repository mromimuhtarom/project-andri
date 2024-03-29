<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variationdetail extends Model
{
    use HasFactory;

    protected $table       = 'variation_detail';
    public    $timestamps   = false;
    protected $guarded     = [];
    protected $primary_key = 'id';
}
