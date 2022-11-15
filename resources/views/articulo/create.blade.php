@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row justify-content-center">
        <h2>Creacion de Articulos</h2>  
        <form class="row g-3" action="{{ url('/articulo') }}" method="POST" enctype="multipart/form-data" >
            @csrf
            @include('articulo.form')
        </form>
    </div>
</div>

  @endsection