<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    //use HasFactory;
    protected $table = "blog";

    public $timestamps = true;

    // Các cột cho phép mass assignment
    protected $fillable = ['title', 'image', 'Description', 'content', 'created_at', 'updated_at'];

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }
}


