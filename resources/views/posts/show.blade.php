@extends('layouts.app')

@section('titulo')
    {{$post->titulo}}
@endsection

@section('contenido')
    <div class="container mx-auto flex">
        <div class="md:w-1/2">
            <img src="{{asset('uploads') .'/' . $post->imagen }}" 
            alt="Imagen del post {{$post->titulo}}">

            <div class="p-3">
                <p>0 Likes</p>
            </div>

            <div class="p-3">
                <p class="font-bold">{{$post->user->username}}</p>
                                        
            </div>
        </div>
    </div>
@endsection