<?php


include("../class/conexion.php");

mysql_query("SET NAMES 'utf8'");

header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=Reporte_Pagos.xls");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Expires: 0");

$consulta_hermano="SELECT hermanos.id_hermano,hermanos.nombres,hermanos.apellidos,hermanos.valorPago FROM hermanos
	INNER JOIN modulos_ccdl
	ON modulos_ccdl.id_modulo=hermanos.modulo
	INNER JOIN tallas
	ON tallas.id_talla=hermanos.talla
	WHERE hermanos.pago='si' ORDER BY hermanos.genero ASC";
			
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
 <th> </th>
 <th>Nombre Completo</th>
 <th>Monto Cancelado</th>
 <th> </th>
  </tr>";
  
while($row=mysql_fetch_array($res_hermano)){
				$id_hermano=$row['id_hermano'];
				$nombre=ucwords(utf8_decode($row['nombres']));
				$apellido=ucwords(utf8_decode($row['apellidos']));
				$nombres=$nombre." ".$apellido;
				$valorPago=number_format(round($row['valorPago'], 2),2);	
echo "<tr>
 <td>&nbsp;&nbsp;</td>
 <td>$nombres</td>
 <td>$&nbsp;$valorPago</td>
 <td>&nbsp;&nbsp;</td>
 </tr>";
	}
echo "</table>";
?>
