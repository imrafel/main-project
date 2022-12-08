@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-12">
            <a class="btn btn-danger" href="{{ url('/material') }}">Regresar</a>
        </div>
        <div>
        </div>
        <br>
        <h4>BODEGA KINAL</h4>
        <h5>VALE DE PRESTAMO DE HERRAMIENTA, EQUIPO, ETC.
        </h5>
        <br>
        <div>
            <table class="table">
                <tr>
                    <td><b>Nombre Completo</b> &nbsp;&nbsp; {{ $solicitud->nombreCompleto }}</td>
                    <td><b>Fecha de Solicitud</b> &nbsp; &nbsp; {{ $solicitud->fecha_solicitud }} </td>
                    <td><b>Fecha de Practica</b> &nbsp;&nbsp;{{ $solicitud->fecha_practica }}</td>
                </tr>
                <tr>
                </tr>
                <tr>
                    <td><b>Curso</b> &nbsp;&nbsp;{{ $solicitud->carrera }}</td> 
                    <td><b>Programa</b> &nbsp;&nbsp;{{ $solicitud->programa }}</td>
                    <td><b>Grado </b>&nbsp;{{ $solicitud->grado }}</td>
                </tr>
                <tr>
                    <td>
                        <b>Jornada</b> &nbsp; {{ $solicitud->jornada }}
                    </td>
                    <td colspan="2" >
                        <b>Practica o Proyecto </b>&nbsp;&nbsp; {{ $solicitud->tipo }}
                    </td>
                </tr>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Herramienta</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detalles as $key => $detalle)
                            <tr>
                                <td>{{ $detalle->cantidad }}</td>
                                <td>{{ $detalle->descripcion }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </table>
            <div class="form-check form-check-inline">
                @if ( $solicitud->gerencia == 1)
                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" checked  onclick="return false;">
                @else
                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" >
                @endif
                <label class="form-check-label" for="inlineCheckbox1">Gerencia</label>
            </div>
            <div class="form-check form-check-inline">
                @if ( $solicitud->bodega == 1)   
                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" checked  onclick="return false;">
                @else
                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" >
                @endif
                <label class="form-check-label" for="inlineCheckbox2">Bodega</label>
            </div>
            <div class="form-check form-check-inline">
                @if ( $solicitud->compra == 1)
                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" checked  onclick="return false;">
                @else
                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" >
                @endif
                <label class="form-check-label" for="inlineCheckbox3">Compra</label>
            </div>
        </div>
        <br>
        <form action="{{ url('/material/' . $solicitud->id ) }}" method="post" enctype="multipart/form-data" >
            @csrf
            {{ method_field('PATCH') }}
            <button type="submit" class="btn btn-success">Aprobar</button>
        </form>
    </div>
@endsection
