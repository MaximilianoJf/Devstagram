<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
      $this->middleware('auth');
    }

    public function __invoke()
    {
      
      //obtener a quienes seguimos
                 //Elegir lo que quiero traer    convertir en arreglo
      $ids = auth()->user()->followings->pluck('id')->toArray();
      //el metodo whereIn verifica si contiene
      $posts = Post::whereIn('user_id', $ids)->latest()->paginate(20);
      return view('home', [
        'posts' => $posts
      ]);   
      
     
    }
}
