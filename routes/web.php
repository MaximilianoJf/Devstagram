<?php

use App\Http\Controllers\ImagenController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('principal');
});

Route::get('/register', [RegisterController::class,'index'])->name('register');
Route::post('/register', [RegisterController::class,'store']); 
// si no se define una ruta tomara la anterior siempre y cuando sea la misma url

Route::get('/login', [LoginController::class,'index'])->name('login');
Route::post('/login', [LoginController::class,'store']);
Route::post('/logout', [LogoutController::class,'store'])->name('logout');

//no te confundas! aqui laravel devolvera el objeto de usuario encontrado que coincida con el username en la BD
Route::get('{user:username}', [PostController::class,'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class,'create'])->name('posts.create');
Route::post('/posts', [PostController::class,'store'])->name('posts.store');

//show segun la convencion determinada en laravel de actions handled resource controller
Route::get('/{user:username}/posts/{post}', [PostController::class,'show'])->name('posts.show');

Route::post('/imagenes', [ImagenController::class,'store'])->name('imagenes.store');