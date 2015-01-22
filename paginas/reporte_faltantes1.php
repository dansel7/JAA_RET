<?php

header("Content-Type: text/html;charset=utf-8");
include("../class/conexion.php");

mysql_query("SET NAMES 'utf8'");

header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=inscritos_JAA2013.xls");
header("Pragma: no-cache");
header("Expires: 0");

$consulta_hermano="SELECT id_hermano FROM inscripcion WHERE pago='si'";
			
$res_hermano=mysql_query($consulta_hermano);
$ninas=0;
$ninos=0;
$consulta_generof = "SELECT count(*) as ninas FROM hermanos WHERE pago='si' AND genero='f'";
$res_f=mysql_query($consulta_generof);
while($row_f=mysql_fetch_array($res_f)){
	$ninas=$row_f['ninas'];
}
$consulta_generom = "SELECT count(*) as ninos FROM hermanos WHERE pago='si' AND genero='m'";
$res_m=mysql_query($consulta_generom);
while($row_m=mysql_fetch_array($res_m)){
	$ninos=$row_m['ninos'];
}

echo "<table cellspacing=\"0\" cellpadding=\"0\">";
echo "<tr>";
echo "<td>Total Femenino: </td><td>$ninas</td>";
echo "</tr>";
echo "<tr>";
echo "<td>Total Masculino: </td><td>$ninos</td>";
echo "</tr>";
echo "</table>";
echo " <table cellspacing=\"0\" cellpadding=\"0\" border=\"1\">
 <tr>
 <th>ID</th>
 <th>Nombre completo</th>
  </tr>";

while($row=mysql_fetch_array($res_hermano)){
$id_hermano=$row['id_hermano'];
echo "<tr>
 <td>$id_hermano</td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
<td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
<td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
<td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 </tr>";
}
echo "</table>";
?>
