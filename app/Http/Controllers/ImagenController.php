<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    public function store(Request $request){
        //imagen que qqueda en memoria
        $imagen = $request->file('file');

        

        //dar un id unico a la imagen
        $nombreImagen = Str::uuid() . "." . $imagen->extension();

        //convertirla en intervetion image
        $imagenServidor= Image::make($imagen);
        //cambiar tamaño
        $imagenServidor->fit(1000,1000);

        $imagenPath = public_path('uploads') . '/' . $nombreImagen;
        $imagenServidor->save($imagenPath);
        
        return response()->json(['imagen' => $nombreImagen]);
    }
}
