@extends('layouts.app')

@section('titulo')
        
@endsection


@section('contenido')
{{--componente
    Si quisiera pasar mas de un componente
    <x-tu-componente :posts="$posts" :users="$users" />
    --}}
<x-listar-post :posts="$posts"/>

    
@endsection

