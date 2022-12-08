@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row justify-content-center">
        <h2>Solicitud de Material y Equipo</h2>  
        <form id="material_form" class="row g-3" action="{{ url('/material') }}" method="POST" >
            @csrf
            @include('material.form')
        </form>
    </div>
</div>

  @endsection