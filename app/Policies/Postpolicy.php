<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class Postpolicy
{

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Post $post)
    {
        //sirve para especificar por controlador si se puede acceder a un metodo del controlador
        //asumire qu epor conveniencia identifica al autenticado, pero de igual manera 
        //espero la respuesta del profesor
        return $user->id === $post->user_id;
    }

}
