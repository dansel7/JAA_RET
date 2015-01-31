<?php 
session_start();
if(isset($_SESSION['user_jaa'])){
		$id_usuario=$_SESSION['user_jaa'];
		include("../class/conexion.php");
		$consulta="SELECT nombres,apellidos FROM usuarios WHERE id_usuario='$id_usuario'";
		$res=mysql_query($consulta);
		$nombres="";
		while($row=mysql_fetch_array($res)){
				$nombres=$row['nombres']." ".$row['apellidos'];
				$nombres=ucfirst($nombres);
		}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>JAA | Principal</title>
<!--[if lte IE 8]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<link href="../diseno/bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="../diseno/css/estilo2.css" rel="stylesheet" media="screen">
    
<link href="../diseno/css/estilo.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
<script type="text/javascript">
$(function(){
	$('#nav1>li').hover(
		function(){
		$('.submenu',this).stop(true,true).slideDown('fast');
		},
		function(){
		$('.submenu',this).slideUp('fast');
		}
	);
	$('.submenu li a').css( {backgroundPosition: "0px 0px"} ).hover(
		function(){
		$(this).stop().animate({backgroundPosition: "(0px -99px)"}, 250);
		},
		function(){
		$(this).stop().animate({backgroundPosition: "(0px 0px)"}, 250);
		}
	);			
});
</script>
<script>
$(document).ready(function(){  
  $('#formulario').validate({
      rules: {
        nombres: {
          required: true,
        },
        apellidos: {
          required: true,
        },
        correo: {
          required: true,
        },
        password: {
          required: true,
        },        
      },
      messages:{
        nombres: {
          required: "Campo requerido",
        },
        apellidos: {
          required: "Campo requerido",
        },
        correo: {
          required: "Campo requerido",
        },
        password: {
          required: "Campo requerido",
        },
      },
      highlight: function(label) {
        $(label).closest('.control-group').addClass('error');
      },
      success: function(label) {
    label
      .closest('.control-group').addClass('success');
  }
    });
});
function confirmacion(id) {
         var answer = confirm("Esta seguro que desea eliminar este retiro?, se eliminaran todos los grupos asociados e informacion de usuarios. De no estar seguro, favor deshabilite el retiro.")
        if (answer){
         window.location.href="retiros.php?eliminar_retiro=true&id_retiro="+id;
         }
         else{
        
        }
     }
</script>
<!--Carga mas rapida-->
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="../diseno/bootstrap/js/bootstrap.min.js"></script>
    <script src="../js/jquery.validate.js"></script>
</head>
<body>
<div id="contenedor_header">
<?php include("paginas/head_menu.php"); ?>
</div>
<div id="cuerpo">
	<div id="contenedor1">
		<div id="nav">
    		ADMINISTRACION DE RETIROS
    	</div>
        <div id="fecha">
        	<?php
				date_default_timezone_set('America/El_Salvador');
				$fecha_actual=date("Y-m-d");
				$dia_actual="";
				$fechats = strtotime($fecha_actual);
				switch (date('w', $fechats)){
				case 0: $dia_actual = "Domingo"; break; 
    			case 1: $dia_actual = "Lunes"; break; 
    			case 2: $dia_actual = "Martes"; break; 
    			case 3: $dia_actual = "Miercoles"; break; 
    			case 4: $dia_actual = "Jueves"; break; 
    			case 5: $dia_actual = "Viernes"; break; 
    			case 6: $dia_actual = "Sabado"; break;
				}
				$dia=0;$mes=0;$ano=0;
				list($ano,$mes,$dia)=explode("-",$fecha_actual);
				$mes_actual="";
				if($mes==1){$mes_actual="Enero";}
				if($mes==2){$mes_actual="Febrero";}
				if($mes==3){$mes_actual="Marzo";}
				if($mes==4){$mes_actual="Abril";}
				if($mes==5){$mes_actual="Mayo";}
				if($mes==6){$mes_actual="Junio";}
				if($mes==7){$mes_actual="Julio";}
				if($mes==8){$mes_actual="Agosto";}
				if($mes==9){$mes_actual="Septiembre";}
				if($mes==10){$mes_actual="Octubre";}
				if($mes==11){$mes_actual="Noviembre";}
				if($mes==12){$mes_actual="Diciembre";}
				echo "$dia_actual $dia de $mes_actual de $ano";
				
			?>
        </div>
	</div>
	<?php
		$mod = "";
		$id = 0;
	    if(isset($_GET['mod'])){
			$mod = $_GET['mod'];
			$id = $_GET['id'];
		}
		if($mod=="true"){
		$consulta1="SELECT * FROM retiros WHERE id_retiro=$id";
		$res=mysql_query($consulta1);
		while($row=mysql_fetch_array($res)){
		        $id_retiro=$id;
				$nombre=$row['nombre'];
				$fecha=$row['fecha'];
				$abierto=$row['abierto'];
				$descripcion=$row['descripcion'];				
		}
		if($abierto=="2"){
			$si_a=" Checked ";
			$no_a=" ";
		}else{
			$si_a=" ";
			$no_a=" Checked ";
		}
	?>
              <form action="retiros.php" id="formulario" method="post" class="form-horizontal">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">�</button>
                <h3 id="myModalLabel">Modificando Retiro</h3>
              </div>              
                <div class="modal-body">                
                <div class="control-group">                                
                  <label class="control-label" for="nombre">Nombre del retiro: </label>
                  <div class="controls">
                    <input type="text" id="nombre" name="nombre" class="textbox_white" value="<?php echo $nombre;?>" />
                  </div>
                  <br>
                  <label class="control-label" for="descripcion">Descripcion: </label>
                  <div class="controls">
                    <input type="text" id="descripcion" name="descripcion" class="textbox_white" value="<?php echo $descripcion;?>" />
                  </div>
                  <br>
                  <label class="control-label" for="fecha">Fecha del evento: </label>
                  <div class="controls">
                    <input type="text" id="fecha_evento" name="fecha_evento" value="<?php echo $fecha;?>" class="textbox_white"  />
                    <input type="hidden" id="id" name="id" value="<?php echo $id_retiro;?>"  />
                  </div>                  
                </div>                
                <div class="control-group">
                  <label class="control-label" for="abierto">Retiro Abierto?</label>
                  <div class="controls">
                	No &nbsp;<input type="radio" id="1" name="abierto" value="1" <?php echo $no_a;?> /> &nbsp;&nbsp;
                	Si &nbsp;<input type="radio" id="2" name="abierto" value="2" <?php echo $si_a;?>/> 
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
                <button class="btn btn-primary" type="submit" name="modificar_retiro">Guardar cambios</button>
              </div>
              </form>
	<?php 
	 }  //fin de modificar
	 else{
	?>
	<div class="span4">
    <div id="dash">
              <div id="myModal3" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <form action="retiros.php" id="formulario" method="post" class="form-horizontal">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">�</button>
                <h3 id="myModalLabel">Agregando un Nuevo Retiro</h3>
              </div>
              <div class="modal-body">                
                <div class="control-group">                                
                  <label class="control-label" for="nombre">Nombre del retiro: </label>
                  <div class="controls">
                    <input type="text" id="nombre" name="nombre" class="textbox_white" />
                  </div>
                  <br>
                  <label class="control-label" for="descripcion">Descripcion: </label>
                  <div class="controls">
                    <input type="text" id="descripcion" name="descripcion" class="textbox_white" />
                  </div>
                  <br>
                  <label class="control-label" for="fecha">Fecha del evento: </label>
                  <div class="controls">
                    <input type="text" id="fecha_evento" name="fecha_evento" class="textbox_white" size="10" />
                  </div>                  
                </div>                
                <div class="control-group">
                  <label class="control-label" for="abierto">Retiro Abierto?</label>
                  <div class="controls">
                	No &nbsp;<input type="radio" id="1" name="abierto" value="1" checked /> &nbsp;&nbsp;
                	Si &nbsp;<input type="radio" id="2" name="abierto" value="2" /> 
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
                <button class="btn btn-primary" type="submit" name="agregar_retiro">Guardar</button>
              </div>
              </form>
          </div>
          </div>
            
            
            
            
              <div id="myModal4" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <form action="retiros.php" id="formulario" method="post" class="form-horizontal">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">�</button>
                <center><h3 id="myModalLabel">Confirmaci&oacute;n</h3></center>
              </div>
              <div class="modal-body">                
                <div class="control-group">                                
                    <label><center>Desea Reinicializar los datos de pagos e inscripciones?<br> (Esta accion regresara a cero las personas registradas y no se podra revertir)</center></label>          
                </div>     
              </div>
              <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
                <button class="btn btn-primary" type="submit" name="reinicializar">Aceptar</button>
              </div>
              </form>
              </div>
            
            <div id="myModal5" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <form action="retiros.php" id="formulario" method="post" class="form-horizontal">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">�</button>
                <center><h3 id="myModalLabel">Confirmaci&oacute;n</h3></center>
              </div>
              <div class="modal-body">                
                <div class="control-group">                                
                    <label><center>Desea actualizar las edades? <br>(Esta accion actualiza la edad de todos los jovenes registrados en el sistema)</center></label>          
                </div>     
              </div>
              <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
                <button class="btn btn-primary" type="submit" name="actualizarEdad">Aceptar</button>
              </div>
              </form>
              </div>
            
             <div id="myModal6" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <form action="retiros.php" id="formulario" method="post" class="form-horizontal">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">�</button>
                <center><h3 id="myModalLabel">Confirmaci&oacute;n</h3></center>
              </div>
              <div class="modal-body">                
                <div class="control-group">                                
                    <label><center>Desea Reinicializar los datos de Servidores?<br> (Esta accion limpiar&aacute; los datos de servidores y no se podra revertir)</center></label>          
                </div>     
              </div>
              <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
                <button class="btn btn-primary" type="submit" name="ReiniServidores">Aceptar</button>
              </div>
              </form>
              </div>
            
<div class="span8">
 <div style="width:300px;margin:0 auto;">
  <a href="#myModal4" class="btn btn-success1 btn-block" role="button" data-toggle="modal">Reinicializar Inscripciones y Pagos</a>
  <a href="#myModal6" class="btn btn-success1 btn-block" role="button" data-toggle="modal">Reinicializar Datos de Servidores</a>
  <a href="#myModal5" class="btn btn-success1 btn-block" role="button" data-toggle="modal">Actualizar Edades</a>
  <a href="#myModal3" class="btn btn-success btn-block" role="button" data-toggle="modal">Agregar Retiro</a> 
 </div>
    <br>
    <br>
    <table id="lista_grupos" align="center" cellpadding="10" cellspacing="0">
    	<tr class="tr_cabeza">
    	    <td>ACTIVO</td>	
            <td>NOMBRE DE RETIRO</td>
            <td>DESCRIPCION</td>
            <td>FECHA</td>
            <td>GRUPOS</td>
            <td>TOTAL INSCRITOS</td>
            <td>SIN GRUPO</td>
            <td colspan="2" align="center">OPCIONES</td>            
            <td></td>
            <td></td>
        </tr>
        <?php
        //include('conexion.php');
        
        $consulta="SELECT * FROM retiros";
		$res=mysql_query($consulta);
		$nombreh="";
		$casos_totales=0;
		$id_grupo=0;
		while($row=mysql_fetch_array($res)){
		        $id_retiro=$row['id_retiro'];
				$nombreh=$row['nombre'];
				$nombreh=ucfirst(utf8_decode($nombreh));
				$descripcion=$row['descripcion'];
				$fecha=$row['fecha'];
				//para total de grupos
				$consulta_total_grupo="SELECT COUNT(*) as total FROM grupo WHERE id_retiro=$id_retiro";
				$res_total_grupo=mysql_query($consulta_total_grupo);
				while($row_total_grupo=mysql_fetch_array($res_total_grupo)){
					$total_grupo=$row_total_grupo['total'];
				}				
				//para total de inscritos
				$total_inscritos=0;
				$consulta_total_inscritos="SELECT COUNT(*) as total FROM inscripcion WHERE pago='si' AND id_retiro=".$id_retiro;
				$res_total_inscritos=mysql_query($consulta_total_inscritos);
				while($row_total_inscritos=mysql_fetch_array($res_total_inscritos)){
					$total_inscritos=$row_total_inscritos['total'];
				}	
				if($row['abierto']=="2"){
					$abierto="<img src='../diseno/img/star_on.png' />";
				}else{
					$abierto="<img src='../diseno/img/star_off.png' />";
				}
				// Los q no tienen grupo
				$libres=0;
				$consulta_actuales="SELECT count(*) as libres FROM inscripcion WHERE pago='si' AND id_retiro=$id_retiro AND id_grupo=1";
				$res_actuales=mysql_query($consulta_actuales);
				while($row_actuales=mysql_fetch_array($res_actuales)){
					$libres=$row_actuales['libres'];
				}
				echo "
					<tr class='tr_cuerpo'";?>onclick="location.href='<?php //echo $paso; ?>'"<?php echo ">	
						<td style='text-align: center;'>$abierto</td>						
						<td style='text-align: center;'>$nombreh</td>
						<td style='text-align: center;'>$descripcion</td>
						<td style='text-align: center;'>$fecha</td>
						<td style='text-align: center;'>$total_grupo</td>
						<td style='text-align: center;'>$total_inscritos</td>
						<td style='text-align: center;'>$libres</td>
						<td style='text-align: center;'><a href='retiros.php?mod=true&id=$id_retiro'><img src='../diseno/img/next.png' /></a></td>
				
				<td style='text-align: center;'><a href=\"javascript:confirmacion($id_retiro)\"><img src='../diseno/img/close_16.png' /></a></td></tr> ";
							}
	?>
	<tr><td></td></tr>
	<tr><td></td></tr>
	    </table>

</div>
   	</div>
<?php
  } //fin de nuevo y ver lista
?>
</div>
<?php include("../paginas/footer.php"); ?>
</body>
</html>
<?php
if(isset($_REQUEST['agregar_retiro'])){
 $nombre=$_POST['nombre'];
 $descripcion = $_POST['descripcion'];
 $fecha=$_POST['fecha_evento'];
 $abierto=$_POST['abierto'];
 
 $consulta_new="INSERT INTO retiros(id_retiro,nombre,fecha,abierto,descripcion) VALUES(0,\"".mysql_real_escape_string($nombre)."\",\"".mysql_real_escape_string($fecha)."\",\"".mysql_real_escape_string($abierto)."\",\"".mysql_real_escape_string($descripcion)."\")";

 if(mysql_query($consulta_new)){
		echo "<script>  alert('Retiro agregado exitosamente.'); </script>";
		echo("<META HTTP-EQUIV='Refresh' CONTENT='0; URL=retiros.php'>");
 }
}
if(isset($_REQUEST['modificar_retiro'])){
 $nombre=$_POST['nombre'];
 $descripcion = $_POST['descripcion'];
 $fecha=$_POST['fecha_evento'];
 $abierto=$_POST['abierto'];
 $id_retiro=$_POST['id'];
 
 $consulta_up="UPDATE retiros SET nombre=\"".mysql_real_escape_string($nombre)."\", descripcion=\"".mysql_real_escape_string($descripcion)."\", fecha=\"".mysql_real_escape_string($fecha)."\", abierto=\"".mysql_real_escape_string($abierto)."\" WHERE id_retiro=$id_retiro";
 
 if(mysql_query($consulta_up)){
		echo "<script>  alert('Se han guardado los cambios.'); </script>";		
		echo("<META HTTP-EQUIV='Refresh' CONTENT='0; URL=retiros.php'>");
} 		
}
if(isset($_REQUEST['eliminar_retiro'])){
  $id_retiro = $_GET['id_retiro'];
  $consulta_eliminar = "DELETE FROM retiro WHERE id_retiro=$id_retiro";
  if(mysql_query($consulta_eliminar)){
  	   	echo "<script> alert('Retiro ha sido eliminado exitosamente.'); </script>";
      	echo("<META HTTP-EQUIV='Refresh' CONTENT='0; URL=retiros.php'>");
    }  
}

if(isset($_REQUEST['reinicializar'])){
 $consulta_up="UPDATE hermanos SET pago=\"no\"";
 mysql_query($consulta_up);
 
 $consulta_up="TRUNCATE TABLE inscripcion";
 if(mysql_query($consulta_up)){
		echo "<script>  alert('Se han Reinicializado los datos Exitosamente.'); </script>";		
		echo("<META HTTP-EQUIV='Refresh' CONTENT='0; URL=retiros.php'>");
} 		
}

if(isset($_REQUEST['ReiniServidores'])){
 
 $consulta_up="TRUNCATE TABLE lideres";
 if(mysql_query($consulta_up)){
     $consulta_2="DELETE FROM usuarios where estado=3";
 if(mysql_query($consulta_2)){
		echo "<script>  alert('Se han Reinicializado los datos Exitosamente.'); </script>";		
		echo("<META HTTP-EQUIV='Refresh' CONTENT='0; URL=retiros.php'>");
 }		
 }
}


if(isset($_REQUEST['actualizarEdad'])){

 $consulta_up="update hermanos set edad=((YEAR(CURDATE())-YEAR(f_nac))+ IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(f_nac,'%m-%d'), 0, -1) )";
 mysql_query($consulta_up);
 
 if(mysql_query($consulta_up)){
		echo "<script>  alert('Se han actualizado todas las edades'); </script>";		
		echo("<META HTTP-EQUIV='Refresh' CONTENT='0; URL=retiros.php'>");
} 		
}
?>
<?php 
mysql_close();
}
?>