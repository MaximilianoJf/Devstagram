<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{


    public function __construct()
    
    {
        $this->middleware('auth')->except(['show','index']);
        
   /*      En Laravel, $this hace referencia a la instancia actual del controlador en el que se encuentra ese código.
         Cuando colocas $this->middleware('auth'); en un controlador de Laravel, estás llamando a un método del controlador
          para aplicar un middleware específico a ese controlador.
        En este caso, $this->middleware('auth'); se utiliza para aplicar el middleware de autenticación
         ('auth') a todas las acciones (métodos) definidas en ese controlador. Esto significa que antes de que se 
         ejecute cualquiera de las acciones en ese controlador, Laravel verificará si el usuario está autenticado. */

    }

    public function index(User $user)
    {
        //aqui se devuelve el usuario que coincidio con el nombre en la bd

        //       |          Consulta             |get trae los resultados|
        $posts = Post::where('user_id', $user->id)->paginate(20);
        //si no quiero separacion por paginas, $posts = Post::where('user_id', $user->id)->get();
        

        // de esta forma se puede pasar data a la vista
        return view('dashboard',[
            'user' => $user,
            'posts' => $posts
        ]);
    } 

    public function create()
    {

        // de esta forma se puede pasar data a la vista
       
        return view('posts.create');
        
    } 

    public function show(User $user, Post $post){
        return view('posts.show', [
            'post' => $post,
            'user' => $user        ]);
    }

    public function store(Request $request){
        $this->validate($request, [
            'titulo' => 'required|max:255',
            'descripcion' =>  'required',
            'imagen' => 'required'
        ]);
        
        /* Post::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]); */

        //otra forma de agregar datos a la BD
       /*  $post = new Post;
        $post->titulo = $request->titulo;
        $post->descripcion = $request->descripcion;
        $post->imagen = $request->imagen;
        $post->user_id = auth()->user()->id;
        $post->save(); */
        
        //otra form de agregar post con relacion luego de crear las relaciones en los modelos

        $request->user()->posts()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('posts.index', auth()->user()->username);

    }

    public function destroy(Post $post){
       $this->authorize('delete',$post);
       //Illuminate\Database\Eloquent\Model::delete
       $post->delete();

       //creamos el url donde se almacenan las imagenes
        $imagen_path = public_path('uploads/' . $post->imagen);

        //facade para eliminar archivo
        if(File::exists($imagen_path)){
            //lo elimina
            unlink($imagen_path);
        }
       return redirect()->route('posts.index', auth()->user()->username);

    }
}
