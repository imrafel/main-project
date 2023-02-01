<table>
    <tr>

        <td><b>VALE DE PRESTAMO HERRAMIENTA, EQUIPO, ETC</b></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>

        <td width='20'><b>Nombre Completo</b></td>
        <td width='20' style="border: 1px solid black; border-top: none; border-left: none; border-right: none" >
            {{$prestamo->nombreCompleto}}
        </td>
        <td width='20'><b>Carne</b> </td>
        <td style="text-align: left" >{{ $prestamo->carne }}</td>
    </tr>
    <tr>

        <td width='20' ><b>Fecha de Solicitud</b></td>
        <td width='20'  style="border: 1px solid black; border-top: none; border-left: none; border-right: none" >
            {{$prestamo->fecha_solicitud}}
        </td>
        <td width='20' ><b>Fecha de Practica</b></td>
        <td width='20'  style="border: 1px solid black; border-top: none; border-left: none; border-right: none" >
            {{$prestamo->fecha_practica}}
        </td>
    </tr>
    <tr>

        <td width='20' ><b>Jornada</b></td>
        <td width='20'  style="border: 1px solid black; border-top: none; border-left: none; border-right: none" >
            {{$prestamo->jornada}}
        </td>
        <td width='20' ><b>Carrera</b></td>
        <td width='20' style="border: 1px solid black; border-top: none; border-left: none; border-right: none" >
            {{$prestamo->carrera}}
        </td>
    </tr>
    <tr>

        <td width='20'><b>Programa</b></td>
        <td width='20' style="border: 1px solid black; border-top: none; border-left: none; border-right: none" > 
            {{$prestamo->programa}} 
        </td>
        <td width='20'><b>Grado y Seccion</b></td>
        <td width='20' style="border: 1px solid black; border-top: none; border-left: none; border-right: none" >
            {{$prestamo->grado}}&nbsp;{{$prestamo->seccion}}
        </td>
    </tr>
</table>
<table>
    <thead>
        <tr>

            <th width='20' style="border: 5px solid black;" >Cantidad</th>
            <th width='20' style="border: 5px solid black;" >Herramienta</th>
            <th width='20' style="border: 5px solid black;" >Descripcion</th>
            <th width='20' style="border: 5px solid black;" >Entregado</th>
            <th width='35' style="border: 5px solid black;" >Observaciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($detalles as $key => $detalle)
        <tr>

            <td>
                {{$detalle->cantidad}}
            </td>
            <td>
                {{$detalle->herramienta}}
            </td>
            <td>
                {{$detalle->descripcion}}
            </td>
            <td>
                {{$detalle->entregado}}
            </td>
            <td>
                {{$detalle->observacion}}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<table>
    <tr>

        <td colspan="5" >La reposicion de herramienta por dano o perdida se efectuara a mas tardar ocho dias despues del incidente</td>
    </tr>
    <tr>

        <td colspan="5" >Compromiso de pago de faltante:</td>
    </tr>
    <tr></tr>
    <tr>

        <td>Nombre</td>
        <td></td>
        <td></td>
        <td>Firma</td>
    </tr>
</table>