<?php
header("Content-type: application/vnd.ms-excel; name='excel'; charset=utf-8");
header('Content-Disposition: attachment; filename=detalle_solicitud'. $prestamo->nombreCompleto .'.xls');
header('Pragma: no-cache');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Cache-Control: private', false);

?>


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
