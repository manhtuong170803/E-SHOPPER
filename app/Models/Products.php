<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    //use HasFactory;
    protected $table = 'products';
    protected $fillable = ['id_user', 'name', 'price','id_category', 'id_brand', 'status', 'sale', 'company', 'image', 'detail', 'created_at', 'updated_at'];

    public function brand() {
        return $this->belongsTo(Brand::class, 'id_brand'); 
    }
    public function category() {
        return $this->belongsTo(category::class, 'id_category'); 
    }

}


