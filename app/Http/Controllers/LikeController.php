<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LikeController extends Controller
{

    //laravel guarda el usuario autentificado en request y este puede ser consultado cuando envias una solicitud
    public function store(Request $request, Post $post){
       $post->likes()->create([
        //no se pasa el id del post ya que tenemos una funcion en post para crear like
        //y laravel entiende que se crea con ese objeto instanciado de post
            'user_id' => $request->user()->id
       ]);
       return Redirect::back()->with('scrollToElement', '#likeSection');
    }

    public function destroy(Request $request, Post $post){
        $request->user()->likes()->where('post_id', $post->id)->delete();
        return Redirect::back()->with('scrollToElement', '#likeSection');
    }
    
}
