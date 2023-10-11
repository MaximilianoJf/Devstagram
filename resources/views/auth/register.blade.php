@extends('layouts.app')

@section('titulo')
    Registrate en DevStagram
@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:gap-4 md:items-center">
        <div class="md:w-6/12 md:p-10 rounded-lg">
            <img src="{{ asset('img/registrar.jpg')}}" alt="Imagen registro de usuarios">
        </div>
    
        <div class="md:w-4/12 bg-white p-10 rounded-lg shadow-xl">
            <form action="{{route('register')}}" method="POST" novalidate>
                @csrf {{-- seguridad cross siite request ver clase 58 --}}
                <div class="mb-5">
                    <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">
                        Nombre
                    </label>
                    <input id="name" name="name"
                    type="text" placeholder="Nombre" class="border p-1 w-full rounded-lg @error('name') border-red-500 @enderror"
                    value="{{old('name')}}">
                    {{-- old name sirve para conservar el valor anterior al enviar el formulario y este sea erroneo (refrescar pagina) --}}
                    @error('name')
                        <p class="text-center text-sm text-white my-2 p-2 bg-red-500 rounded-lg">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                        Username
                    </label>
                    <input id="username" name="username"
                    type="text" placeholder="Tu nombre de usuario" class="border p-1  w-full rounded-lg @error('name') border-red-500 @enderror"">
                    @error('username')
                    <p class="text-center text-sm text-white my-2 p-2 bg-red-500 rounded-lg">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Email
                    </label>
                    <input id="email" name="email"
                    type="email" placeholder="Email de registro" class="border p-1  w-full rounded-lg @error('name') border-red-500 @enderror"">
                    @error('email')
                    <p class="text-center text-sm text-white my-2 p-2 bg-red-500 rounded-lg">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                        Password
                    </label>
                    <input id="password" name="password"
                    type="password" placeholder="Password de registro" class="border p-1  w-full rounded-lg @error('name') border-red-500 @enderror"">
                    @error('password')
                    <p class="text-center text-sm text-white my-2 p-2 bg-red-500 rounded-lg">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">
                        Repetir Password
                    </label>
                    <input id="password_confirmation" name="password_confirmation"
                    type="password" placeholder="Repite tu password" class="border p-1  w-full rounded-lg @error('name') border-red-500 @enderror"">
                </div>

                <input type="submit" value="crear Cuenta" class="bg-sky-600
                 hover:bg-sky-700 transition-colors cursor cursor-pointer uppercase font-bold
                  w-full p-1  text-white rounded-lg">
                    
                
            </form>
        </div>
    </div>
    
@endsection