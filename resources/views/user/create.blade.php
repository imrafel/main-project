



@extends('layouts.app')

@section('content')

@if(Session::has('mensaje'))   
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    {{ Session::get('mensaje') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>

@endif 



<div class="container">
    <div class="row justify-content-center">
        <h2>Creacion de Usuarios</h2>  
        <form class="row g-3" action="{{ url('/user') }}" method="POST" enctype="multipart/form-data" >
            @csrf
            @include('user.form')
        </form>
    </div>
</div>

  @endsection