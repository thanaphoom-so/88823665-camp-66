<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = "categories";
    public $timestamps = false;

    public function products() {
        return $this->hasMany(ProductList::class, 'category_id', 'id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id',);
    }
}
