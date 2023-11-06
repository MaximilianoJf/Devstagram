<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        if(auth()->user()){
            return redirect()->route('home', [
              'posts' => auth()->user()->posts
            ]);
          }
        return view('auth.login');
    }

    public function store(Request $request)
    {
        //dd($request->remember);
        
        $this->validate($request,[
            'email' => 'required',
            'password' => 'required',
        ]);

        //autenticar usuario
        //auth directamente busca en la base de datos modelo user si los datos son correctos y los guarda en un attempt
        if(!auth()->attempt($request->only('email', 'password'), $request->remember)){
            return back()->with('mensaje','Credenciales Incorrectas'); //request remember verifica si hay un token para
             //guardarlo en la base de datos (token se puede verificar en cookies)
        }
        // return back significa que me regrese a la vista anterior y ademas con un mensaje en session

        return redirect()->route('posts.index', auth()->user()->username);
    }

    
}