<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Storeorder extends Model
{
    use HasFactory;
    protected $table       = 'store_order';
    protected $primary_key = 'id';
    protected $guarded     = [];
    public    $timestamp   = false;
    public $status_name = [
        '0' => 'Menunggu',
        '1' => 'Terima',
        '2' => 'Mengirimkan',
        '3' => 'Tolak',
        '4' => 'Selesai'
    ];

    public function strStatus()
    {
        return $this-status_name[$this->status];
    }
}
