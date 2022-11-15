@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row justify-content-center">
        <h3>Editar Articulo</h3>  
        <form class="row g-3" action="{{ url('/articulo/' . $articulo->id ) }}" method="post" enctype="multipart/form-data" >
            @csrf
            {{ method_field('PATCH') }}
            @include('articulo.form')
        </form>
    </div>
</div>

  @endsection