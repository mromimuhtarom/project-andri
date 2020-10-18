<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Config;

class Storeorder extends Model
{
    use HasFactory;
    protected $table       = 'store_order';
    protected $primary_key = 'id';
    protected $guarded     = [];
    public    $timestamps  = false;

    public function config(){
        return Config::where('id', 1)->select('value')->first();
    }
    public function strStatus($val) {
        $explode =  explode(',', str_replace(':', ',', $this->config()->value));
        $status_order = [
            $explode[0] => $explode[1],
            $explode[2] => $explode[3],
            $explode[4] => $explode[5],
            $explode[6] => $explode[7],
            ''          => ''
        ];

        return statusstoreorder($status_order[$val]);
    }
}
