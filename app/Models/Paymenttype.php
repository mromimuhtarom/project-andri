<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paymenttype extends Model
{
    use HasFactory;
    protected $table       = 'payment_type';
    protected $primary_key = 'payment_id';
    protected $guarded     = [];
    public    $timestamps   = false;
}
