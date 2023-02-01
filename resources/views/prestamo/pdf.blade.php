<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ public_path('css/app.css') }}" rel="stylesheet" type="text/css" >
</head>
<body>
       
    <div class="container">
        <div>
        </div>
        <br>
        <h4>BODEGA KINAL</h4>
        <h5>VALE DE PRESTAMO DE HERRAMIENTA, EQUIPO, ETC.
        </h5>
        <br>
        <div>
            <table >
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
                <table>
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Herramienta</th>
                            <th scope="col">Completo</th>
                            <th scope="col">Observaciones</th>
                        </tr>
                    </thead>
                        <tbody>
                            @foreach ($detalles as $key => $detalle)
                            <tr>
                                <td>{{ $detalle->articulo_id }}
                                </td>
                                <td>{{ $detalle->cantidad }}
                                </td>
                                <td>{{ $detalle->herramienta }}
                                </td>
                                <td>
                                    {{ $detalle->entregado}}
                                </td>
                                <td>
                                    {{ $detalle->observacion }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                </table>
            </table>
        </div>
    </div>
</body>
</html>