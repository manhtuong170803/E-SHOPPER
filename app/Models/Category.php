<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "category";

    public $timestamps = true;

    // Các cột cho phép mass assignment
    protected $fillable = ['name', 'created_at', 'updated_at'];



    public function products()
    {
        return $this->hasMany(Products::class, 'id_category', 'id');
    }
}
