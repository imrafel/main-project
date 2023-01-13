@extends('layouts.app')

@section('content')
    @if (Session::has('mensaje'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('mensaje') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="container">

        <div class="row">
            <div class="col">
                <a class="btn btn-success" href="{{ url('/articulo/create') }}">Agregar Articulo</a>
            </div>
            <div class="col col-lg-2">
                <form action="">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="articulo" placeholder="Ex: Martillo">
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon1">Buscar</button>
                      </div>
                </form>
            </div>
        </div>
        <div class="row justify-content-center">
            <table class="table table ">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Codigo</th>
                        <th scope="col">Objeto</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($articulos as $dato)
                        <tr>
                            <td>{{ $dato->id }}</td>
                            <td>{{ $dato->codigo }}</td>
                            <td>{{ $dato->objeto }}</td>
                            <td>{{ $dato->descripcion }}</td>
                            <td>{{ $dato->cantidad }}</td>
                            <td>{{ $dato->fecha }}</td>
                            <td>
                                <form action="{{ url('/articulo/' . $dato->id) }}" method="POST">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <input type="submit" value="Delete" class="btn btn-danger"
                                        onclick="return confirm('Seguro quieres eliminar?')" />
                                    <a class="btn btn-warning" href="{{ url('/articulo/' . $dato->id . '/edit') }}">Edit</a>
                                    <a class="btn btn-primary" href="{{ url('/articulo/' . $dato->id) }}">Detail</a>
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
