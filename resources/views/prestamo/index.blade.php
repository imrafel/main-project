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
                    <th scope="col">Area</th>
                    <th scope="col">Options</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($prestamos as $dato)
                    <tr>
                        <td>{{ $dato->id }}</td>
                        <td>{{ $dato->user_id }}</td>
                        <td>{{ $dato->area }}</td>
                        <td>
                            <form action="{{ url('/prestamo/' . $dato->id) }}" method="POST">
                                @csrf
                                {{ method_field('DELETE') }}
                                <input type="submit" value="Delete" class="btn btn-danger"
                                    onclick="return confirm('Seguro quieres eliminar?')" />
                                {{-- <a class="btn btn-warning" href="{{ url('/articulo/' . $dato->id . '/edit') }}">Edit</a>
                                <a class="btn btn-primary" href="{{ url('/articulo/' . $dato->id) }}">Detail</a> --}}
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- <div class="row" >
            {{ $articulos->links() }}
        </div> --}}
    </div>
</div>
@endsection