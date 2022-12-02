@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-12">
            <a class="btn btn-danger" href="{{ url('/prestamo') }}">Regresar</a>
        </div>
        <div>
        </div>
        <br>
        <h4>BODEGA KINAL</h4>
        <h5>VALE DE PRESTAMO HERRAMIENTA, EQUIPO, ETC.
        </h5>
        <br>
        <div>
            <table class="table">
                <tr>
                    <td><b>Fecha de Solicitud</b> &nbsp; &nbsp; {{ $prestamo->fecha_solicitud }} </td>
                    <td><b>Fecha de Practica</b> &nbsp;&nbsp;{{ $prestamo->fecha_practica }}</td>
                </tr>
                <tr>
                    <td><b>Nombre Completo</b> &nbsp;&nbsp; {{ $prestamo->nombreCompleto }}</td>
                    <td><b>Carne</b> &nbsp;&nbsp;{{ $prestamo->carne }}</td>
                </tr>
                <tr>
                    <td><b>Jornada</b> &nbsp;&nbsp;{{ $prestamo->jornada }}</td>
                    <td><b>Carrera</b> &nbsp;&nbsp;{{ $prestamo->carrera }}</td>

                </tr>
                <tr>
                    <td><b>Programa</b> &nbsp;&nbsp; {{ $prestamo->programa }}</td>
                    <td>
                        <b>Grado </b>&nbsp;{{ $prestamo->grado }} &nbsp; - &nbsp;
                        <b>Seccion</b> &nbsp; {{ $prestamo->seccion }}
                    </td>
                </tr>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Herramienta</th>
                            <th scope="col">Descripcion</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detalles as $key => $detalle)
                            <tr>
                                <td>{{ $detalle->cantidad }}</td>
                                <td>{{ $detalle->herramienta }}</td>
                                <td>{{ $detalle->descripcion }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </table>
            <div class="form-check form-check-inline">
                @if ( $prestamo->gerencia == 1)
                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" checked>
                @else
                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" >
                @endif
                <label class="form-check-label" for="inlineCheckbox1">Gerencia</label>
            </div>
            <div class="form-check form-check-inline">
                @if ( $prestamo->bodega == 1)
                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" checked>
                @else
                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" >
                @endif
                <label class="form-check-label" for="inlineCheckbox2">Bodega</label>
            </div>
            <div class="form-check form-check-inline">
                @if ( $prestamo->compra == 1)
                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" checked>
                @else
                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" >
                @endif
                <label class="form-check-label" for="inlineCheckbox3">Compra</label>
            </div>
        </div>
        <br>
        <form action="{{ url('/prestamo/' . $prestamo->id ) }}" method="post" enctype="multipart/form-data" >
            @csrf
            {{ method_field('PATCH') }}
            <button type="submit" class="btn btn-success">Aprobar</button>
        </form>
    </div>
@endsection
