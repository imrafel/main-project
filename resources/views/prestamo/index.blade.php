@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row">
        <div class="col">
            <a class="btn btn-success" href="{{ url('/prestamo/create') }}">Nuevo</a>
        </div>
        <div class="col col-lg-2">
            <input type="text" class="form-control" name="nombreArticulo" id="nombreArticulo" placeholder="Buscar">
        </div>
    </div>
    <div class="row justify-content-center">
        <table class="table table ">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Usuario prestado</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Fecha de Solicitud</th>
                    <th scope="col">Fecha de Practica</th>
                    <th scope="col">Programa</th>
                    <th scope="col">Options</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($prestamos as $dato)
                    <tr>
                        <td>{{ $dato->id }}</td>
                        <td>{{ $dato->user->name }}</td>
                        <td>{{ $dato->nombreCompleto }}</td>
                        <td>{{ $dato->fecha_solicitud }}</td>
                        <td>{{ $dato->fecha_practica }}</td>
                        <td>{{ $dato->programa }}</td>
                        <td>
                            <form action="{{ url('/prestamo/' . $dato->id) }}" method="POST">
                                @csrf
                                {{ method_field('DELETE') }}
                                <input type="submit" value="Delete" class="btn btn-danger"
                                    onclick="return confirm('Seguro quieres eliminar?')" />
                                    <a class="btn btn-primary" href="{{ url('/prestamo/' . $dato->id) }}">Detalle</a>
                                    <a class="btn btn-warning" href="{{ url('/prestamo/' . $dato->id) }}">Descargar</a>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection