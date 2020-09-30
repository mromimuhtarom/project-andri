<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'category';
    public $timestamps = false;
    protected $fillable = array('parent_id', 'name', 'category_id');

    public function parent()
    {
        return $this->hasOne(Category::class, 'category_id');
    }

    public function children() {
        return $this->hasMany(Category::class, 'parent_id', 'category_id');
    }
    public function product(){
        return $this->parent->hasMany(Product::class, 'category_id', 'category_id');
    }
}
