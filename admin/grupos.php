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
<link href="../diseno/bootstrap/css/bootstrap.colorpickersliders.css" rel="stylesheet" type="text/css" media="all"> 
    
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
    //Color Picker
    $("input#color").ColorPickerSliders({
    placement: 'bottom',
    color: 'red',
    swatches: ['white','red', 'green','lightgreen','skyblue', 'darkblue'],
    customswatches: false,
    order:{}
  });
    
	$('#formulario').validate({
      rules: {
        nombre: {
          required: true,
        },
        capacidad: {
          required: true,
        },
      },
      messages:{
        nombre: {
          required: "Campo requerido",
        },
          capacidad: {
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
         var answer = confirm("Esta seguro que desea eliminar este grupo?")
        if (answer){
         window.location.href="grupos.php?eliminar_grupo=true&id_grupo="+id;
         }
         else{
        
        }
     }
</script>
<!--Carga mas rapida-->
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="../diseno/bootstrap/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/tinycolor/0.11.1/tinycolor.min.js"></script>
    <script src="../diseno/bootstrap/js/bootstrap.colorpickersliders.js"></script>
    <script src="../js/jquery.validate.js"></script>
</head>
<body>
<div id="contenedor_header">
<?php include("paginas/head_menu.php"); ?>
</div>
<div id="cuerpo">
	<div id="contenedor1">
		<div id="nav">
    		MENU PRINCIPAL
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
		$consulta_mod="SELECT * FROM grupo WHERE id_grupo=$id";
		$res_mod=mysql_query($consulta_mod);
		while($row_mod=mysql_fetch_array($res_mod)){
			$nombre=$row_mod['nombre'];
			$capacidad=$row_mod['total'];
                        $color=$row_mod['color'];
			$abierto=$row_mod['abierto'];
			if($abierto=="2"){
				$si_a=" Checked ";
				$no_a=" ";				
			}else{
				$si_a=" ";
				$no_a="' Checked ";
			}
		}
	?>
              <form action="grupos.php" id="formulario" method="post" class="form-horizontal">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">�</button>
                <h3 id="myModalLabel">Modificando Grupo</h3>
              </div>
              <div class="modal-body">
                <div class="control-group">
                  <label class="control-label" for="retiro">Retiro:</label>
                  <div class="controls">
                    <select name="retiro" id="retiro">
                      <?php 
                        $consulta_retiro = "SELECT * FROM retiros WHERE abierto=2";  
                        $res_retiro=mysql_query($consulta_retiro);  
                        while($row_retiro=mysql_fetch_array($res_retiro)){    
                            echo "<option value=\"".$row_retiro['id_retiro']."\">".$row_retiro['nombre']."</option>";
                        }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="control-group">                                
                  <label class="control-label" for="nombre">Nombre del grupo: </label>
                  <div class="controls">
                    <input type="text" id="nombre" name="nombre" class="textbox_white" value="<?php echo $nombre;?>" />
                  </div>
                  <br>
                      <label class="control-label" for="nombre">Color del grupo: </label>
                  <div class="controls">
                    <input type="text" id="color" name="color" value="<?php echo $color;?>" class="demo-popup" style="cursor: pointer" data-color-format="hex" />
                  </div
                  <br><br>
                  <label class="control-label" for="capacidad">Capacidad: </label>
                  <div class="controls">
                    <input type="number" min="5" max="20" id="capacidad" name="capacidad" value="<?php echo $capacidad;?>" class="textbox_white" placeholder="5" />
                    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" for="abierto">Abierto para retiro?</label>
                  <div class="controls">
                	No &nbsp;<input type="radio" id="1" name="abierto" value="1" <?php echo $no_a;?> /> &nbsp;&nbsp;
                	Si &nbsp;<input type="radio" id="2" name="abierto" value="2" <?php echo $si_a;?> /> 
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
                <button class="btn btn-primary" type="submit" name="modificar_grupo">Guardar cambios</button>
              </div>
              </form>
	<?php 
	 }  //fin de modificar
	 else{
	?>
	<div class="span4">
    <div id="dash">
              <div id="myModal3" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <form action="grupos.php" id="formulario" method="post" class="form-horizontal">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">�</button>
                <h3 id="myModalLabel">Agregando un Nuevo Grupo</h3>
              </div>
              <div class="modal-body">
                <div class="control-group">
                  <label class="control-label" for="retiro">Retiro:</label>
                  <div class="controls">
                    <select name="retiro" id="retiro">
                      <?php 
                        $consulta_retiro = "SELECT * FROM retiros WHERE abierto=2";  
                        $res_retiro=mysql_query($consulta_retiro);  
                        while($row_retiro=mysql_fetch_array($res_retiro)){    
                            echo "<option value=\"".$row_retiro['id_retiro']."\">".$row_retiro['nombre']."</option>";
                        }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="control-group">                                
                  <label class="control-label" for="nombre">Nombre del grupo: </label>
                  <div class="controls">
                    <input type="text" id="nombre" name="nombre" class="textbox_white" />
                  </div>
                  <br>
                  <label class="control-label" for="nombre">Color del grupo: </label>
                  <div class="controls">
                    <input type="text" id="color" name="color" class="demo-popup" style="cursor: pointer" data-color-format="hex" />
                  </div>
                  <br>
                  <label class="control-label" for="capacidad">Capacidad: </label>
                  <div class="controls">
                    <input type="number" min="5" max="20" id="capacidad" name="capacidad" class="textbox_white" placeholder="5" />
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" for="abierto">Abierto para retiro?</label>
                  <div class="controls">
                	No &nbsp;<input type="radio" id="1" name="abierto" value="1"  /> &nbsp;&nbsp;
                	Si &nbsp;<input type="radio" id="2" name="abierto" value="2" checked /> 
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
                <button class="btn btn-primary" type="submit" name="agregar_grupo">Guardar</button>
              </div>
              </form>
          </div>
          </div>
<div class="span8">
 <div>
    <a href="#myModal3" class="btn btn-success btn-block" role="button" data-toggle="modal">Agregar Grupo</a>
    <br>
    <br>
    <table id="lista_grupos" align="center" cellpadding="10" cellspacing="0">
    	<tr class="tr_cabeza">
        	<td>ABIERTO</td>
            <td>RETIRO</td>
            <td>NOMBRE DE GRUPO</td>
            <td>CAPACIDAD</td>
            <td>ACTUAL</td>
            <td>COLOR</td>
            <td colspan="3" align="center">OPCIONES</td>            
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <?php
        //include('conexion.php');
        
        $consulta="SELECT grupo.id_grupo,grupo.nombre,grupo.id_retiro,grupo.total,grupo.abierto,grupo.color FROM grupo INNER JOIN retiros ON grupo.id_retiro=retiros.id_retiro WHERE retiros.abierto=2";
		$res=mysql_query($consulta);
		$nombreh="";
		$casos_totales=0;
		$id_grupo=0;
		while($row=mysql_fetch_array($res)){
				$nombreh=$row['nombre'];
				$nombreh=ucfirst(utf8_decode($nombreh));
				$id_grupo=$row['id_grupo'];
                                $colorh=$row['color'];
                                
				if($row['abierto']=="2"){
					$abierto="<img src='../diseno/img/star_on.png' />";
				}else{
					$abierto="<img src='../diseno/img/star_off.png' />";
				}
				$retiro="";
				$consulta_retiro="SELECT nombre FROM retiros WHERE id_retiro=".$row['id_retiro'];
				$res_retiro=mysql_query($consulta_retiro);
				while($row_retiro=mysql_fetch_array($res_retiro)){
					$retiro=$row_retiro['nombre'];
				}
				$capacidad=$row['total'];
				$actuales=0;
				$consulta_actuales="SELECT count(id_hermano) as actuales FROM inscripcion WHERE id_grupo=".$row['id_grupo'];
				$res_actuales=mysql_query($consulta_actuales);
				while($row_actuales=mysql_fetch_array($res_actuales)){
					$actuales=$row_actuales['actuales'];
				}
				echo "
					<tr class='tr_cuerpo'";?>onclick="location.href='<?php //echo $paso; ?>'"<?php echo ">	
						<td style='text-align: center;'>$abierto</td>
						<td style='text-align: center;'>$retiro</td>
						<td style='text-align: center;'>$nombreh</td>
						<td style='text-align: center;'>$capacidad</td>
						<td style='text-align: center;'>$actuales</td>
                                                <td style='text-align: center;background-color:$colorh'>&nbsp;&nbsp;</td>
						<td style='text-align: center;'><a href='grupos.php?mod=true&id=$id_grupo'><img src='../diseno/img/next.png' /></a></td>
				
				<td style='text-align: center;'><a href=\"javascript:confirmacion($id_grupo)\"><img src='../diseno/img/close_16.png' /></a></td></tr> ";
							}
	?>
	<tr><td></td></tr>
	<tr><td></td></tr>
	    </table>
</div>
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
if(isset($_REQUEST['agregar_grupo'])){
 $retiro=$_POST['retiro'];
 $nombre=$_POST['nombre'];
 $capacidad = $_POST['capacidad'];
 $abierto=$_POST['abierto'];
 $color=$_POST['color'];
 $consulta_new="INSERT INTO grupo(id_grupo,id_retiro,nombre,total,abierto,color) VALUES(0,$retiro,\"".mysql_real_escape_string($nombre)."\",$capacidad,$abierto,\"".$color."\")";

 if(mysql_query($consulta_new)){
		echo "<script>  alert('Grupo agregado exitosamente.'); </script>";
		echo("<META HTTP-EQUIV='Refresh' CONTENT='0; URL=grupos.php'>");
 }
 
}
if(isset($_REQUEST['modificar_grupo'])){
 $retiro=$_POST['retiro'];
 $nombre=$_POST['nombre'];
 $capacidad = $_POST['capacidad'];
 $abierto=$_POST['abierto'];
 $color=$_POST['color'];
 $id=$_POST['id'];
 
 $consulta_up="UPDATE grupo SET nombre=\"".mysql_real_escape_string($nombre)."\", id_retiro=$retiro, total=$capacidad, abierto=$abierto,color=\"".mysql_real_escape_string($color)."\" WHERE id_grupo=$id";
 
 if(mysql_query($consulta_up)){
		echo "<script>  alert('Se han guardado los cambios.'); </script>";
		echo("<META HTTP-EQUIV='Refresh' CONTENT='0; URL=grupos.php'>");
		} 		
}
if(isset($_REQUEST['eliminar_grupo'])){
  $id_grupo = $_GET['id_grupo'];
  $consulta_eliminar = "DELETE FROM grupo WHERE id_grupo=$id_grupo";
  if(mysql_query($consulta_eliminar)){
      echo "<script> alert('Grupo ha sido eliminado exitosamente.'); </script>";
      echo("<META HTTP-EQUIV='Refresh' CONTENT='0; URL=grupos.php'>");
    }  
}
?>
<?php 
mysql_close();
}
?>