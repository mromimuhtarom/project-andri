<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variation extends Model
{
    use HasFactory;
    protected $table       = 'variation';
    public    $timestamps   = false;
    protected $guarded     = [];
    protected $primary_key = 'variation_id';
}
