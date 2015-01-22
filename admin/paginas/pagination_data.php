<?php
include("../../class/conexion.php");
$per_page = 15; 
$genero=" ";
if($_GET)
{
$page=$_GET['page'];
$g=$_GET['g'];
	if($g==1){
		$genero="AND hermanos.genero='m'";
	}else{
		$genero="AND hermanos.genero='f'";
	}
}
//get table contents
$start = ($page-1)*$per_page;
?>
	<form action="asignando_inscritos.php?g=<?php echo $g?>" id="formulario" method="post">
    <table id="lista_inscritos" align="center" cellpadding="10" cellspacing="0">
    	<tr class="tr_cabeza">
    	    <td></td>
        	<td>USUARIO</td>
            <td>EDAD</td>
            <td>TELEFONO</td>
            <td>CELULAR</td>
            <td>TALLA</td>
            <td colspan="2" align="center">OPCIONES</td>            
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <?php
        
        $consulta = "SELECT hermanos.id_hermano, hermanos.nombres, hermanos.apellidos, hermanos.edad, hermanos.telefono, hermanos.celular, hermanos.talla FROM hermanos INNER JOIN inscripcion ON inscripcion.id_hermano=hermanos.id_hermano WHERE inscripcion.id_grupo=1 ".$genero." AND inscripcion.pago='si' ORDER BY edad ASC LIMIT $start,$per_page";
		$res=mysql_query($consulta);
		$nombreh="";
		$casos_totales=0;
		$id_hermano=0;
		$cont=0;
		while($row=mysql_fetch_array($res)){
		$cont++;
				$nombreh=$row['nombres']." ".$row['apellidos'];
				$nombreh=ucfirst(utf8_decode($nombreh));
				$id_hermano=$row['id_hermano'];
				$edad=$row['edad'];
				$telefono=$row['telefono'];
				$celular=$row['celular'];
				$consulta_talla="SELECT nombre FROM tallas WHERE id_talla=".$row['talla'];
				$res_talla=mysql_query($consulta_talla);
				while($row_talla=mysql_fetch_array($res_talla)){
					$talla_camisa=$row_talla['nombre'];
				}
				echo "
					<tr class='tr_cuerpo'>
						<td>
						<div class=\"control-group\">
                  		<div class=\"controls\">
                			<input type='checkbox' name='herma$cont' id='herma$cont' value='$id_hermano' />
                  		</div>
                		</div>
						</td>
						<td>$nombreh</td>
						<td style='text-align: center;'>$edad</td>
						<td style='text-align: center;'>$telefono</td>
						<td style='text-align: center;'>$celular</td>
						<td style='text-align: center;'>$talla_camisa</td>						
						";
						$existe=0;
						//buscar hermano en tabla inscripcion
						$consulta_inscripcion = "SELECT id_hermano FROM inscripcion WHERE id_hermano=$id_hermano";
						$res_inscripcion=mysql_query($consulta_inscripcion);
						while($row_inscripcion=mysql_fetch_array($res_inscripcion)){
							$existe=$row_inscripcion['id_hermano'];
						}
						if($existe>0){
						echo "<td ><a href='ver_inscrito.php?id=$id_hermano' target='_blank'><img src='../diseno/img/pdf.png' /></a></td>";
						}
						echo "<td></td>
					</tr>
				";
							}
	?>
	    </table>
	    <table align="center" cellpadding="10" cellspacing="0">
	<tr>
	<td>
	<label class="control-label" for="grupo">Agregar seleccionados a grupo: </label>
        <select name="grupo" id="grupo">
           <?php 
                $consulta_grupo = "SELECT id_grupo,nombre FROM grupo WHERE abierto=2";  
                $res_grupo=mysql_query($consulta_grupo);  
                while($row_grupo=mysql_fetch_array($res_grupo)){    
                echo "<option value=\"".$row_grupo['id_grupo']."\">".$row_grupo['nombre']."</option>";
              }
           ?>
       </select>
	</td>
	<td>
	<button class="btn btn-success btn-block" type="submit" name="asignar_grupo">Agregar a grupo</button>
	</td>
	</table>
	</form>
<br>