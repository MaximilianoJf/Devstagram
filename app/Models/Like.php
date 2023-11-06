<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
       //No es necesario poner el post_id ya que lo detectara con eloquent 'post_id'
       //por la relacion hasMany
    ];
}
