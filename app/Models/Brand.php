<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = "brand";

    public $timestamps = true;

    // Các cột cho phép mass assignment
    protected $fillable = ['name', 'created_at', 'updated_at'];

    public function products()
    {
        return $this->hasMany(Products::class, 'id_brand', 'id');
    }
}
