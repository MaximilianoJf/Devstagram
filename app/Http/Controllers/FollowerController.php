<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function store(User $user){
        //cuando relacionas con la misma tabla es decir, usas tabla pivote, muchos a muchos
        //objeto user tiene la lista de fallowers que se consulto, luego le dice que le agregue el autenticado
        $user->followers()->attach(auth()->user()->id);

        return back();
    }

    public function destroy(User $user){
        $user->followers()->detach(auth()->user()->id);
       
        return back();
    }
}


