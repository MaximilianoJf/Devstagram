<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use App\Rules\MatchOldPassword;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $user){
        return view('perfil.index');
    }

    public function store(Request $request){
       

        $request->request->add(['username'=>Str::slug($request->username)]);

        $this->validate($request,[
                    //evita que se repita el username del el id autentificado
                    //Siempre pasar el id no otro dato para el ignore
            'username' => ['required',
                             Rule::unique('users','username')->ignore(auth()->user()->id), 'min:3', 'max:20'],
            'email' => ['required', 'email', 'max:60', Rule::unique('users', 'email')->ignore(auth()->user()->id)],
            //se creo una nueva regla para ver si coincidia con la actual
            'password' => [new MatchOldPassword,'nullable','min:6'],
            //'new_password' => ['required_with:password','min:6'],
            'new_password' => ['nullable','min:6'],
            //in:Cliente,Proveedor (Significa que solo puede utilizar cliente o Proveedor)
        ]);
 
        if(!($request->password == $request->new_password)){
            return back()->with('errorPass','Complete Ambos Campos, Si Desea Cambiar Su Contraseña');
        }
        
        if($request->imagen){
            $imagen = $request->file('imagen');
            
            //dar un id unico a la imagen
            $nombreImagen = Str::uuid() . "." . $imagen->extension();

            //convertirla en intervetion image
            $imagenServidor= Image::make($imagen);
            //cambiar tamaño
            $imagenServidor->fit(1000,1000);

            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;
            $imagenServidor->save($imagenPath);
      
        }

        //guardar cambios
        //buscar al usuario
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->email = $request->email; 
        $usuario->password = $request->new_password ?? auth()->user()->password; 
        
                                    // el ?? significa "o"
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;
        $usuario->save();

        //redireccionar
        return redirect()->route('posts.index', $usuario->username);
    }
}
