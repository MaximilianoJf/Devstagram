@extends('layouts.app')

@section('titulo')
    Inicio Sesión en DevStagram
@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:gap-4 md:items-center">
        <div class="md:w-6/12 md:p-10 rounded-lg">
            <img src="{{ asset('img/login.jpg')}}" alt="Imagen login de usuarios">
        </div>
    
        <div class="md:w-4/12 bg-white p-10 rounded-lg shadow-xl">
            <form action="{{route('login')}}" method="POST" novalidate>
                @csrf {{-- seguridad cross siite request ver clase 58 --}}
                @if(session('mensaje'))
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{session('mensaje')}}
                    </p>
                @endif
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Email
                    </label>
                    <input id="email" name="email"
                    type="email" placeholder="Email de registro" class="border p-1  w-full rounded-lg @error('email') border-red-500 @enderror"">
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
                    <input type="checkbox" name="remember"><label class="uppercase
                     text-gray-500 font-bold text-sm">
                        Mantener mi sesión abierta
                    </label>
                </div>

                <input type="submit" value="Ingresar" class="bg-sky-600
                 hover:bg-sky-700 transition-colors cursor cursor-pointer uppercase font-bold
                  w-full p-1  text-white rounded-lg">
                    
                
            </form>
        </div>
    </div>
    
@endsection