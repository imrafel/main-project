@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row justify-content-center">
        <h3>Editar Usuario</h3>  
        <form class="row g-3" action="{{ url('/user/' . $user->id ) }}" method="post" enctype="multipart/form-data" >
            @csrf
            {{ method_field('PATCH') }}
            @include('user.form')
        </form>
    </div>
</div>

  @endsection