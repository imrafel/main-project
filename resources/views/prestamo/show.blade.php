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
    <h5>VALE DE PRESTAMO DE HERRAMIENTA, EQUIPO, ETC.
    </h5>
    <br>
    <div>
        <table class="table">
            <tr>
                <td><b>Fecha de Solicitud</b> &nbsp; &nbsp; {{ date('d-m-Y', strtotime($prestamo->fecha_solicitud)) }}
                </td>
                <td><b>Fecha de Practica</b> &nbsp;&nbsp;{{ date('d-m-Y', strtotime($prestamo->fecha_practica)) }}
                </td>
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
            <table class="table" me>
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Herramienta</th>
                        <th scope="col">Completo</th>
                        <th scope="col">Observaciones</th>
                    </tr>
                </thead>
                <form action="" method="POST">
                    @csrf
                    {{ method_field('DELETE') }}
                    <tbody>
                        @foreach ($detalles as $key => $detalle)
                        <tr>
                            <td><input type="text" value="{{ $detalle->articulo_id }}" class="form-control" name="id[]">
                            </td>
                            <td><input type="text" value="{{ $detalle->cantidad }}" class="form-control" name="cantidad[]">
                            </td>
                            <td><input type="text" value="{{ $detalle->herramienta }}" class="form-control" name="herramienta[]">
                            </td>
                            <td>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="entregado[{{ $key }}]" id="inlineRadio1" value="si" 
                                    {{ ($detalle->entregado=="si")? "checked" : "" }} >
                                    <label class="form-check-label" for="inlineRadio1">Si</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="entregado[{{ $key }}]" id="inlineRadio2" value="no"
                                    {{ ($detalle->entregado=="no")? "checked" : "" }} >
                                    <label class="form-check-label" for="inlineRadio2">No</label>
                                  </div>
                            </td>
                            <td>
                                <input type="text" name="observacion[]" value="{{ $detalle->observacion }}" class="form-control">
                            </td>
                        </tr>
                        @endforeach
                        <input type="submit" value="enviar">
                    </tbody>
                </form>

            </table>
        </table>
        <div class="form-check form-check-inline">
            @if ($prestamo->gerencia == 1)
            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" checked onclick="return false;">
            @else
            <input class="form-check-input" type="checkbox" id="inlineCheckbox1">
            @endif
            <label class="form-check-label" for="inlineCheckbox1">Gerencia</label>
        </div>
        <div class="form-check form-check-inline">
            @if ($prestamo->bodega == 1)
            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" checked onclick="return false;">
            @else
            <input class="form-check-input" type="checkbox" id="inlineCheckbox1">
            @endif
            <label class="form-check-label" for="inlineCheckbox2">Bodega</label>
        </div>
    </div>
    <br>
    @if (auth()->user()->role == 'admin' || auth()->user()->role == 'secre' || auth()->user()->role == 'bodega')
    <form action="{{ url('/prestamo/' . $prestamo->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        {{ method_field('PATCH') }}
        <button type="submit" class="btn btn-success">Aprobar</button>
    </form>
    @endif
    {{-- @if (auth()->user()->role == 'admin' || auth()->user()->role == 'secre' || auth()->user()->role == 'bodega')
    <form action="{{ url('/prestamo/' . $prestamo->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        {{ method_field('DELETE') }}
        @if ($prestamo->finalizado == 1)
        <a>Este vale ya ha sido devuelto</a>
        @else
        <button type="submit" class="btn btn-success">enviar</button>
        @endif
    </form>
    @endif --}}
</div>
@endsection


<script type="text/javascript">
    function enviarforms() {
        document.f1.submit();
        document.f2.submit();

    }
</script>