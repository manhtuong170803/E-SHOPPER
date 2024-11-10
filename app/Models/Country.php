<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //use HasFactory;
    protected $table = "country";

    public $timestamps = true;

    // Các cột cho phép mass assignment
    protected $fillable = ['name', 'created_at', 'updated_at'];

}
