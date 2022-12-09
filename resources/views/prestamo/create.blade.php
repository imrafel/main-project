@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row justify-content-center">
        <h2>Vale de prestamo de Herramienta</h2>  
        
        <form id="prestamo_form" class="row g-3" action="{{ url('/prestamo') }}" method="POST" >
            {{-- @livewire('disponible') --}}
            @csrf
            @include('prestamo.form')
        </form>
    </div>
</div>

  @endsection