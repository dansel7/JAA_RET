<?php

header("Content-Type: text/html;charset=utf-8");
include("conexion.php");

mysql_query("SET NAMES 'utf8'");

header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=faltantes_JAA2013.xls");
header("Pragma: no-cache");
header("Expires: 0");

$consulta_hermano="SELECT hermanos.id_hermano,hermanos.nombres,tallas.nombre as talla,hermanos.apellidos,hermanos.f_nac,hermanos.edad,hermanos.genero,hermanos.telefono,hermanos.celular,hermanos.correo,hermanos.direccion, hermanos.bautizado,hermanos.ccdl,modulos_ccdl.nombre as modulo,hermanos.jaa,hermanos.gj,hermanos.ed,hermanos.fv,hermanos.esp_aler,hermanos.medicamento,hermanos.contacto1,hermanos.telefono1,hermanos.celular1,hermanos.parentesco1,hermanos.correo1,hermanos.contacto2,hermanos.telefono2,hermanos.celular2,hermanos.parentesco2,hermanos.correo2,hermanos.ged,hermanos.ministerio FROM hermanos
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
 <th>Grupo</th>
 <th>Nombre completo</th>
 <th>Fecha de nacimiento</th>
 <th>Edad</th>
 <th>Genero</th>
 <th>Telefono</th>
 <th>Celular</th>
 <th>Email</th>
 <th>Alergias</th>
 <th>Medicamento</th>
 <th>Direccion</th>
 <th>Ministerios</th>
 <th>Bautizado</th>
 <th>CCDL</th>
 <th>Modulo</th>
 <th>Grupo Juvenil</th>
 <th>Contacto1</th>
 <th>Parentesco</th>
 <th>Telefono</th>
 <th>Celular</th>
 <th>Email</th>
 <th>Contacto2</th>
 <th>Parentesco</th>
 <th>Telefono</th>
 <th>Celular</th>
 <th>Email</th>
 <th>Talla camisa</th>
  </tr>";
  
while($row=mysql_fetch_array($res_hermano)){
$id_hermano=$row['id_hermano'];
$faltante=0;
$consulta_faltante= "SELECT id_hermano FROM inscripcion WHERE id_hermano=$id_hermano";
$res_faltante=mysql_query($consulta_faltante);
while($row_faltante=mysql_fetch_array($res_faltante)){
	$faltante=$row_faltante['id_hermano'];
}
if($faltante==0){	            
				$nombre=ucwords(utf8_decode($row['nombres']));
				$apellido=ucwords(utf8_decode($row['apellidos']));
				$nombres=$nombre." ".$apellido;
				//$nombres=ucwords($nombres);
				//$nombres=html_entity_decode($nombres);
				$f_nac=$row['f_nac'];
				$edad=$row['edad'];
				if($row['genero']=="m"){
					$genero="Masculino";
				}else{
					$genero="Femenino";
				}
				$telefono=$row['telefono'];
				$celular=$row['celular'];
				$email=$row['correo'];
				$direccion=ucfirst(utf8_decode($row['direccion']));
				$bautizado=ucfirst($row['bautizado']);
				$ccdl=ucfirst($row['ccdl']);
				$modulo=ucfirst(html_entity_decode($row['modulo']));
				$lista="";
				if($row['jaa']=="si"){
					$lista="JAA   ";
				}
				if($row['gj']=="si"){
					$lista=$lista."Grupo Juvenil   ";
				}
				if($row['ed']=="si"){
					$lista=$lista."Escuela Dominical   ";
				}
				if($row['fv']=="si"){
					$lista=$lista."Formando vidas   ";
				}				
				$ministerios=$lista;
				$esp_aler=ucfirst(utf8_decode($row['esp_aler']));
				$medicamento=ucfirst(utf8_decode($row['medicamento']));
				$contacto1=$row['contacto1'];
				$contacto1=ucwords($contacto1);
				$contacto1=utf8_decode($contacto1);
				$contacto2=$row['contacto2'];
				$contacto2=ucwords($contacto2);
				$contacto2=utf8_decode($contacto2);
				$telefono1=$row['telefono1'];
				$celular1=$row['celular1'];
				$correo1=$row['correo1'];
				$telefono2=$row['telefono2'];
				$celular2=$row['celular2'];
				$correo2=$row['correo2'];
				$parentesco1=ucfirst($row['parentesco1']);
				$parentesco2=ucfirst(utf8_decode($row['parentesco2']));
				$talla=$row['talla'];
				$gj=$row['ged'];
echo "<tr>
 <td>$id_hermano</td>
 <td>$nombres</td>
 <td>$f_nac</td>
 <td>$edad</td>
 <td>$genero</td>
 <td>$telefono</td>
 <td>$celular</td>
 <td>$email</td>
 <td>$esp_aler</td>
 <td>$medicamento</td>
 <td>$direccion</td>
 <td>$ministerios</td>
 <td>$bautizado</td>
 <td>$ccdl</td>
 <td>$modulo</td>
 <td>$gj</td>
 <td>$contacto1</td>
 <td>$parentesco1</td>
 <td>$telefono1</td>
 <td>$celular1</td>
 <td>$correo1</td>
 <td>$contacto2</td>
 <td>$parentesco2</td>
 <td>$telefono2</td>
 <td>$celular2</td>
 <td>$correo2</td>
 <td>$talla</td>
 </tr>";
}else{
echo "<tr>
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
 <td></td>
 </tr>";
}
	
}
echo "</table>";
?>
