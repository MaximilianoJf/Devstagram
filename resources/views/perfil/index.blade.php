@extends('layouts.app')

@section('titulo')
    Editar Perfil: {{auth()->user()->username}}
@endsection

@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6 rounded-lg">
        {{-- enctype="multipart/form-data" permite procesar archivos  --}}
            <form class="mt-10 md:mt-0" method="POST" action="{{route('perfil.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                        Username
                    </label>
                    <input id="username" name="username"
                    placeholder="Tu Nombre de Usuario"
                    type="text" class="border p-1 w-full rounded-lg @error('username') border-red-500 @enderror"
                    value="{{auth()->user()->username}}">
                    @error('username')
                        <p class="text-center text-sm text-white my-2 p-2 bg-red-500 rounded-lg">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Email
                    </label>
                    <input id="email" name="email"
                    type="email" value="{{auth()->user()->email}}" placeholder="Tu Email" class="border p-1  w-full rounded-lg @error('email') border-red-500 @enderror">
                    @error('email')
                    <p class="text-center text-sm text-white my-2 p-2 bg-red-500 rounded-lg">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="contraseña" class="mb-2 block uppercase text-gray-500 font-bold">
                        Contraseña Actual
                    </label>
                    <input id="password" name="password"
                    type="password" value="" placeholder="Tu Password" class="border p-1 w-full rounded-lg @error('password') border-red-500 @enderror">
                    @error('password')
                    <p class="text-center text-sm text-white my-2 p-2 bg-red-500 rounded-lg">{{$message}}</p>
                    @enderror

                    @if(session('errorPass'))
                        <p class="text-center text-sm text-white my-2 p-2 bg-red-500 rounded-lg"> {{session('errorPass')}}</p>
                        <script>
                            document.getElementById('password').classList.add("border-red-500");
                        </script>
                    @endif
                   
                </div>
                <div class="mb-5">
                    <label for="nueva_contraseña" class="mb-2 block uppercase text-gray-500 font-bold @error('new_password') border-red-500 @enderror">
                        Nueva contraseña
                    </label>
                    <input id="new_password" name="new_password"
                    type="password" value="" placeholder="Tu Nueva Password" class="border p-1  w-full rounded-lg">
                    @error('new_password')
                    <p class="text-center text-sm text-white my-2 p-2 bg-red-500 rounded-lg">{{$message}}</p>
                    @enderror
                
                    @if(session('errorPass'))
                        <p class="text-center text-sm text-white my-2 p-2 bg-red-500 rounded-lg"> {{session('errorPass')}}</p>
                        <script>
                            document.getElementById('new_password').classList.add("border-red-500");
                        </script>
                    @endif
                
                </div>
                
                <div class="mb-5">
                    <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">
                        Imagen Perfil
                    </label>
                    <input id="imagen" name="imagen"
                    type="file" class="border p-1 w-full rounded-lg"
                    accept=".jpg, .png, jpeg"
                    >                
                </div>
                <input type="submit" value="Guardar Cambios" class="bg-sky-600
                 hover:bg-sky-700 transition-colors cursor cursor-pointer uppercase font-bold
                  w-full p-1 text-white rounded-lg">
                  
            </form>
        </div>
    </div>
@endsection
