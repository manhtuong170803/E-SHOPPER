<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    //use HasFactory;
    protected $table = "history";

    public $timestamps = true;

    // Các cột cho phép mass assignment
    protected $fillable = ['email','phone','name','price','id_user', 'created_at', 'updated_at'];
}
