<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;


    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];

    public function user(){
        return $this->belongsTO(User::class)->select(['name','username','imagen']);
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

    public function likes(){
       return  $this->hasMany(Like::class);
    }

    public function checkLike(User $user){
        // ve si en la tabla de BD de likes contiene para esta instancia de post tal usuario consultado, debido a que ya establecimos la relacion post like
        return $this->likes->contains('user_id',$user->id);
    }
}
