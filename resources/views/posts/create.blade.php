@extends('layouts.app')

@section('titulo')
    Crea una nueva Publicación
@endsection
@push('styles')
      <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('contenido')
  <div class="md:flex md:items-center md:justify-center">
    <div class="shadow-xl bg-white rounded-lg md:w-3/4 md:flex md:justify-center md:p-4">
        <div class="md:w-full p-4 md:p-0">
            <form action="{{route('imagenes.store')}}" method="POST" id="dropzone" enctype="multipart/form-data" class="dropzone border-dashed border-2 w-full h-96 rounded-xl flex flex-col justify-center items-center">
                @csrf
            </form>
        </div>
        
        <div class="md:w-full px-10  p-6 bg-white rounded-lg md:mt-0 mt-10 ">
            <form action="{{route('posts.store')}}" method="POST" novalidate>
                @csrf {{-- seguridad cross siite request ver clase 58 --}}
                <div class="mb-5">
                    <label for="titulo" class="mb-2 block uppercase text-gray-500 font-bold">
                        Titulo
                    </label>
                    <input id="titulo" name="titulo"
                    type="text" placeholder="Titulo de la publicación" class="border p-1 w-full rounded-lg @error('titulo') border-red-500 @enderror"
                    value="{{old('titulo')}}">
                
                    @error('titulo')
                        <p class="text-center text-sm text-white my-2 p-2 bg-red-500 rounded-lg">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="titulo" class="mb-2 block uppercase text-gray-500 font-bold">
                        Descripción
                    </label>
                    <textarea 
                            id="descripcion" name="descripcion"
                            placeholder="Descripción de la publicación" 
                            class="border p-1 w-full rounded-lg @error('descripcion') border-red-500 @enderror"
                    >{{old('descripcion')}}</textarea>   
                    @error('descripcion')
                        <p class="text-center text-sm text-white my-2 p-2 bg-red-500 rounded-lg">{{$message}}</p>
                    @enderror
                </div>
                 {{-- input que contiene el nombre de la imagen oculto --}}
                <div class="mb-5">
                    <input 
                    name="imagen"
                    type="hidden"
                    value="{{old('imagen')}}"
                    >
                    {{-- Siempre respetar el name correspondiente a lo colocado en el modelo DB y controlador--}}
                
                    @error('imagen')
                        <p class="text-center text-sm text-white my-2 p-2 bg-red-500 rounded-lg">{{$message}}</p>
                    @enderror
                </div>

                <input type="submit" value="crear publicación" class="bg-sky-600
                    hover:bg-sky-700 transition-colors cursor cursor-pointer uppercase font-bold
                    w-full p-1  text-white rounded-lg">
                        
            </form>
        </div>
    </div>
  </div>
@endsection