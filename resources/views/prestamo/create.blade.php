@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row justify-content-center">
        <h2>Creacion de Prestamos</h2>  
        <form class="row g-3" action="{{ url('/prestamo') }}" method="POST" >
            @csrf
            @include('prestamo.form')
        </form>
    </div>
</div>

  @endsection