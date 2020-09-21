<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menuname extends Model
{
    use HasFactory;

    protected $table = 'menu';
    public $timestamp = false;
    protected $fillable = array('parent_id', 'name', 'route', 'icon');

    public function parent()
    {
        return $this->hasOne(Menuname::class, 'menu_id');
    }

    public function children() {
        return $this->hasMany(Menuname::class, 'parent_id', 'menu_id')->where('status', '=', 1);
    }
    
}
