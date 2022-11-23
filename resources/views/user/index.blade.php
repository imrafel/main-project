  



@extends('layouts.app')

@section('content')

@if(Session::has('mensaje'))   
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ Session::get('mensaje') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>

@endif

<div class="container">
    <a class="btn btn-success" href="{{ url('/user/create')}}" >Nuevo</a>
    <div class="row justify-content-center">
        
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">name</th>
                <th scope="col">email</th>
                <th scope="col">options</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $dato)
                <tr> 
                    <td>{{ $dato->id }}</td>
                    <td>{{ $dato->name }}</td>
                    <td>{{ $dato->email }}</td>
                    <td>
                        <form action="{{ url('/user/'. $dato->id) }}" method="POST">
                            @csrf
                            {{ method_field('DELETE') }}
                            <input type="submit" value="Delete" 
                                class="btn btn-danger" 
                                onclick="return confirm('Seguro quieres eliminar?')" />
                                {{-- <a class="btn btn-warning" href="{{ url('/articulo/' . $dato->id . '/edit') }}" >Edit</a> --}}
                                {{-- <a class="btn btn-primary" href="{{ url('/articulo/' . $dato->id ) }}" >Detail</a> --}}
                                <a href="" class="btn btn-warning">Edit</a>
                                <a href="" class="btn btn-primary">Detail</a>
                        </form>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

  @endsection
