<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cmt extends Model
{
    // use HasFactory;
    protected $fillable = ['id_user', 'id_blog', 'cmt', 'name', 'avatar', 'level', 'created_at', 'updated_at'];


    public function replies()
    {
        return $this->hasMany(Cmt::class, 'parent_id');
    }

}
