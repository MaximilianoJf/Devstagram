<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{ 
    public function index ()
    {
        return view('auth.register');
    }

    public function store (Request $request)
    {
     
        //dd($_REQUEST);

        //dd($request->get('name'));
        // this se refiere al objeto (request) actual que se  esta procesando
        
        $request->request->add(['username'=>Str::slug($request->username)]);
        
        // La razón por la que se utiliza $request->request es que Laravel organiza los datos de la solicitud en diferentes "bolsas" o "bags" para facilitar su acceso. Algunos de los bags más comunes en Laravel son:

        //     $request->request: Contiene los datos enviados en el cuerpo del formulario, generalmente cuando se utiliza el método POST en un formulario HTML.
        //     $request->query: Contiene los parámetros de consulta (query parameters) enviados en la URL.
        //     $request->headers: Contiene las cabeceras HTTP de la solicitud.
        //     $request->session: Proporciona acceso a la sesión de la aplicación.
        //     $request->cookie: Proporciona acceso a las cookies enviadas con la solicitud.
        
        $this->validate($request,[
            'name' => 'required|max:30',
            'username' => 'required|unique:users|min:3|max:20',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            //'password' => Hash::make($request->password) encriptar password ahora hash se hace automatico
            'password' => $request->password
        ]);

        //autenticar usuario

        auth()->attempt([
            'email' => $request->email,
            'password' => $request->password
        ]);
            

        return redirect()->route('posts.index', auth()->user()->username);
    }

}
