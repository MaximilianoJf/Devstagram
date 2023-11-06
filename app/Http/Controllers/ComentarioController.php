<?php

namespace App\Http\Controllers;

use auth;
use App\Models\Comentario;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    //debo si o si imporar  el usuario aunque se trate del usuario que se selecciono en la url el que hizo el post
    // por que asi se definio en la url, sin embargo no hay problema con no utilizarlo
    //el usuario que necesito para hacer un comentario es el autentificado
    public function store(Request $request, User $user, Post $post){
       //validar
       $this->validate(($request),[
            'comentario' => 'required|max:255'
       ]);

       //almacenar el resultado
       Comentario::create([
        'user_id' => auth()->user()->id,
        'post_id' => $post->id,
        'comentario' => $request->comentario
       ]);

       return back()->with('mensaje','Comentario Realizado Correctamente');
    }
}
