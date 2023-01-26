<?php
$fecha=date('d_m_Y');
header('Pragma: no-cache');
header('Expires: 0');
header('Content-Transfer-Encoding: none');
header('Content-type: application/vnd.ms-excel;charset=utf-8');// 
header("Content-Disposition: attachment; filename=Reporte_$fecha.xls");


echo '<table class="table">';
echo "<tr>";
echo "<td><b>Fecha de Solicitud</b> &nbsp; &nbsp;  $prestamo->fecha_solicitud  </td>";
echo "<td><b>Fecha de Practica</b> &nbsp;&nbsp; $prestamo->fecha_practica </td>";
echo "</tr>";
echo "<tr>";
echo "<td><b>Nombre Completo</b> &nbsp;&nbsp;  $prestamo->nombreCompleto </td>";
echo "<td><b>Carne</b> &nbsp;&nbsp; $prestamo->carne </td>";
echo "</tr>";
echo "<tr>";
echo "<td><b>Jornada</b> &nbsp;&nbsp; $prestamo->jornada </td>";
echo "<td><b>Carrera</b> &nbsp;&nbsp; $prestamo->carrera</td>";

echo "</tr>";
echo "<tr>";
echo "<td><b>Programa</b> &nbsp;&nbsp;  $prestamo->programa </td>";
echo "<td>";
echo "<b>Grado </b>&nbsp; $prestamo->grado  &nbsp; - &nbsp;";
echo "<b>Seccion</b> &nbsp;  $prestamo->seccion ";
echo "</td>";
echo "</tr>";
echo '<table class="table">';
echo "<thead>";
echo "<tr>";
echo "<th >Cantidad</th>";
echo "<th >Herramienta</th>";
echo "<th >Descripcion</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";
foreach ($detalles as $key => $detalle) {
echo "<tr>";
echo "<td> $detalle->cantidad </td>";
echo "<td>$detalle->herramienta </td>";
echo "<td> $detalle->descripcion </td>";
echo "</tr>";
}
echo "</tbody>";
echo "</table>";
echo "</table>";