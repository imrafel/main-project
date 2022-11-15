@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <a class="btn btn-success" href="{{ url('/articulo')}}" >Inventario</a>
                            </div>
                            <div class="col">
                                <a class="btn btn-primary" href="{{ url('/user') }}" >Usuarios</a>
                            </div>
                            <div class="col">
                                <a class="btn btn-warning" href="{{ url('/prestamo') }}" >Prestamos</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
