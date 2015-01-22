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
        telefono: {
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
        telefono: {
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
         var answer = confirm("Esta seguro que desea eliminar este a servidor?")
        if (answer){
         window.location.href="servidores.php?eliminar_servidor=true&id_servidor="+id;
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
		$consulta1="SELECT * FROM usuarios WHERE id_usuario=$id";
		$res=mysql_query($consulta1);
		while($row=mysql_fetch_array($res)){
		        $id_lider=$id;
				$nombres=$row['nombres'];
				$apellidos=$row['apellidos'];
				$correo=$row['correo'];
				$password=$row['password'];				
				$telefono=$row['telefono'];
				$f_nac=$row['f_nac'];
		}
		$consulta2="SELECT * FROM lideres WHERE id_lider=$id";
		$res2=mysql_query($consulta2);
		while($row2=mysql_fetch_array($res2)){
		        $grupo=$row2['id_grupo'];
		        $activo=$row2['activo'];
		}
		if($activo=="2"){
			$si_a=" Checked ";
			$no_a=" ";
		}else{
			$si_a=" ";
			$no_a=" Checked ";
		}
	?>
              <form action="servidores.php" id="formulario" method="post" class="form-horizontal">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">�</button>
                <h3 id="myModalLabel">Modificando Usuario</h3>
              </div>
              <div class="modal-body">                
                <div class="control-group">                                
                  <label class="control-label" for="nombres">Nombres del usuario: </label>
                  <div class="controls">
                    <input type="text" id="nombres" name="nombres" class="textbox_white" value="<?php echo $nombres;?>" />
                  </div>
                  <br>
                  <label class="control-label" for="apellidos">Apellidos del usuario: </label>
                  <div class="controls">
                    <input type="text" id="apellidos" name="apellidos" class="textbox_white" value="<?php echo $apellidos;?>" />
                  </div>
                  <br>
                  <label class="control-label" for="telefono">Telefono: </label>
                  <div class="controls">
                    <input type="text" id="telefono" name="telefono" class="textbox_white" value="<?php echo $telefono;?>" />
                  </div>
                  <br>
                  <label class="control-label" for="f_nac">Fecha de nacimiento: </label>
                  <div class="controls">
                    <input type="date" id="f_nac" name="f_nac" class="textbox_white" value="<?php echo $f_nac;?>" />
                  </div>
                  <br>
                  <label class="control-label" for="correo">Correo del usuario: </label>
                  <div class="controls">
                    <input type="email" id="correo" name="correo" class="textbox_white" value="<?php echo $correo;?>" />
                  </div>
                  <label class="control-label" for="password">Password: </label>
                  <div class="controls">
                    <input type="password" id="password" name="password" class="textbox_white" value="<?php echo $password;?>" />
                    <input type="hidden" id="id" name="id" class="textbox_white" value="<?php echo $id_lider;?>" />
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" for="grupo">Grupo para retiro:</label>
                  <div class="controls">
                	<select name="grupo" id="grupo">
                      <?php 
                        $consulta_grupo = "SELECT id_grupo,nombre FROM grupo WHERE id_grupo=$grupo";  
                        $res_grupo=mysql_query($consulta_grupo);  
                        while($row_grupo=mysql_fetch_array($res_grupo)){    
                            echo "<option value=\"".$row_grupo['id_grupo']."\">".$row_grupo['nombre']."</option>";
                        }
                        $consulta_grupo2 = "SELECT id_grupo,nombre FROM grupo WHERE id_grupo<>$grupo";  
                        $res_grupo2=mysql_query($consulta_grupo2);  
                        while($row_grupo2=mysql_fetch_array($res_grupo2)){    
                            echo "<option value=\"".$row_grupo2['id_grupo']."\">".$row_grupo2['nombre']."</option>";
                        }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" for="abierto">Abierto para retiro?</label>
                  <div class="controls">
                	No &nbsp;<input type="radio" id="1" name="abierto" value="1" <?php echo $no_a;?>  />&nbsp;&nbsp;
                	Si &nbsp;<input type="radio" id="2" name="abierto" value="2" <?php echo $si_a;?> /> 
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
                <button class="btn btn-primary" type="submit" name="modificar_lider">Guardar cambios</button>
              </div>
              </form>
	<?php 
	 }  //fin de modificar
	 else{
	?>
	<div class="span4">
    <div id="dash">
              <div id="myModal3" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <form action="servidores.php" id="formulario" method="post" class="form-horizontal">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">�</button>
                <h3 id="myModalLabel">Agregando un Nuevo Usuario</h3>
              </div>
              <div class="modal-body">                
                <div class="control-group">                                
                  <label class="control-label" for="nombres">Nombres del usuario: </label>
                  <div class="controls">
                    <input type="text" id="nombres" name="nombres" class="textbox_white" />
                  </div>
                  <br>
                  <label class="control-label" for="apellidos">Apellidos del usuario: </label>
                  <div class="controls">
                    <input type="text" id="apellidos" name="apellidos" class="textbox_white" />
                  </div>
                  <br>
                  <label class="control-label" for="telefono">Telefono: </label>
                  <div class="controls">
                    <input type="text" id="telefono" name="telefono" class="textbox_white" />
                  </div>
                  <br>
                  <label class="control-label" for="f_nac">Fecha de nacimiento: </label>
                  <div class="controls">
                    <input type="date" id="f_nac" name="f_nac" class="textbox_white" />
                  </div>
                  <br>
                  <label class="control-label" for="correo">Correo del usuario: </label>
                  <div class="controls">
                    <input type="email" id="correo" name="correo" class="textbox_white" />
                  </div>
                  <label class="control-label" for="password">Password: </label>
                  <div class="controls">
                    <input type="password" id="password" name="password" class="textbox_white" />
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" for="grupo">Grupo para retiro:</label>
                  <div class="controls">
                	<select name="grupo" id="grupo">
                      <?php 
                        $consulta_grupo = "SELECT id_grupo,nombre FROM grupo WHERE abierto=2";  
                        $res_grupo=mysql_query($consulta_grupo);  
                        while($row_grupo=mysql_fetch_array($res_grupo)){    
                            echo "<option value=\"".$row_grupo['id_grupo']."\">".$row_grupo['nombre']."</option>";
                        }
                      ?>
                    </select>
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
                <button class="btn btn-primary" type="submit" name="agregar_lider">Guardar</button>
              </div>
              </form>
          </div>
          </div>
<div class="span8">
 <div>
    <a href="#myModal3" class="btn btn-success btn-block" role="button" data-toggle="modal">Agregar Servidor</a>
    <br>
    <br>
    <table id="lista_grupos" align="center" cellpadding="10" cellspacing="0">
    	<tr class="tr_cabeza">
    	    <td>ACTIVO</td>	
            <td>NOMBRE DE SERVIDOR</td>
            <td>EDAD</td>
            <td>TELEFONO</td>
            <td>GRUPO ASIGNADO</td>
            <td>TOTAL</td>
            <td colspan="2" align="center">OPCIONES</td>            
            <td></td>
            <td></td>
        </tr>
        <?php        
        $consulta="SELECT usuarios.id_usuario, usuarios.nombres, usuarios.apellidos, usuarios.correo, usuarios.password, lideres.activo, grupo.nombre as grupo, grupo.id_grupo, usuarios.telefono, usuarios.edad FROM lideres INNER JOIN usuarios ON usuarios.id_usuario=lideres.id_lider INNER JOIN grupo ON grupo.id_grupo=lideres.id_grupo ORDER BY grupo.nombre ASC";
		$res=mysql_query($consulta);
		$nombreh="";
		$casos_totales=0;
		$id_grupo=0;
		while($row=mysql_fetch_array($res)){
		        $id_servidor=$row['id_usuario'];
				$nombreh=$row['nombres']." ".$row['apellidos'];
				$nombreh=ucfirst(utf8_decode($nombreh));
				$correo=$row['correo'];
				$password=$row['password'];
				$activo=$row['activo'];
				$grupo=$row['grupo'];
				$id_grupo=$row['id_grupo'];
				$edad=$row['edad'];
				$telefono=$row['telefono'];
				if($row['activo']=="2"){
					$abierto="<img src='../diseno/img/star_on.png' />";
				}else{
					$abierto="<img src='../diseno/img/star_off.png' />";
				}
				$actuales=0;
				$consulta_actuales="SELECT count(*) as actuales FROM inscripcion WHERE id_grupo=$id_grupo";
				$res_actuales=mysql_query($consulta_actuales);
				while($row_actuales=mysql_fetch_array($res_actuales)){
					$actuales=$row_actuales['actuales'];
				}
				echo "
					<tr class='tr_cuerpo'";?>onclick="location.href='<?php //echo $paso; ?>'"<?php echo ">	
						<td style='text-align: center;'>$abierto</td>						
						<td style='text-align: center;'>$nombreh</td>
						<td style='text-align: center;'>$edad</td>
						<td style='text-align: center;'>$telefono</td>
						<td style='text-align: center;'>$grupo</td>
						<td style='text-align: center;'>$actuales</td>
						<td style='text-align: center;'><a href='servidores.php?mod=true&id=$id_servidor'><img src='../diseno/img/next.png' /></a></td>
				
				<td style='text-align: center;'><a href=\"javascript:confirmacion($id_servidor)\"><img src='../diseno/img/close_16.png' /></a></td></tr> ";
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
if(isset($_REQUEST['agregar_lider'])){
 $nombres=$_POST['nombres'];
 $apellidos = $_POST['apellidos'];
 $telefono = $_POST['telefono'];
 $f_nac = $_POST['f_nac'];
 $correo=$_POST['correo'];
 $password=$_POST['password'];
 $abierto=$_POST['abierto'];
 $id_grupo=$_POST['grupo'];
 
 //Calculando edad
	$consulta_edad = "SELECT DATE(\"".$f_nac."\") as FechaNacimiento,
CURDATE() as FechaActual,
TIMESTAMPDIFF(YEAR, \"".$f_nac."\", NOW()) as Edad";
	$res_edad=mysql_query($consulta_edad);
	while($row_edad=mysql_fetch_array($res_edad)){
			$edad=$row_edad['Edad'];
		}		
		
 $consulta_new="INSERT INTO usuarios(id_usuario,nombres,apellidos,correo,password,estado,ultimo_ingreso,telefono,f_nac,edad) VALUES(0,\"".mysql_real_escape_string($nombres)."\",\"".mysql_real_escape_string($apellidos)."\",\"".mysql_real_escape_string($correo)."\",\"".mysql_real_escape_string($password)."\",3, NOW(),\"".mysql_real_escape_string($telefono)."\", \"".mysql_real_escape_string($f_nac)."\",$edad)";

 if(mysql_query($consulta_new)){
    $consulta_id="SELECT id_usuario FROM usuarios WHERE correo='$correo' AND nombres=\"".mysql_real_escape_string($nombres)."\"";
    $res_id=mysql_query($consulta_id);
	while($row_id=mysql_fetch_array($res_id)){
		$id_lider=$row_id['id_usuario'];
	}
 	$consulta_new2="INSERT INTO lideres(id_lider,id_grupo,activo) VALUES($id_lider,$id_grupo,$abierto)";
 	echo $consulta_new2;
 	if(mysql_query($consulta_new2)){
		echo "<script>  alert('Servidor agregado exitosamente.'); </script>";
		echo("<META HTTP-EQUIV='Refresh' CONTENT='0; URL=servidores.php'>");
	}
 }
 
}
if(isset($_REQUEST['modificar_lider'])){
 $nombres=$_POST['nombres'];
 $apellidos = $_POST['apellidos'];
 $telefono = $_POST['telefono'];
 $f_nac = $_POST['f_nac'];
 $correo=$_POST['correo'];
 $password=$_POST['password'];
 $abierto=$_POST['abierto'];
 $id_grupo=$_POST['grupo'];
 $id_lider=$_POST['id'];
 
 //Calculando edad
	$consulta_edad = "SELECT DATE(\"".$f_nac."\") as FechaNacimiento,
CURDATE() as FechaActual,
TIMESTAMPDIFF(YEAR, \"".$f_nac."\", NOW()) as Edad";
	$res_edad=mysql_query($consulta_edad);
	while($row_edad=mysql_fetch_array($res_edad)){
			$edad=$row_edad['Edad'];
		}
		
 $consulta_up="UPDATE usuarios SET nombres=\"".mysql_real_escape_string($nombres)."\",apellidos=\"".mysql_real_escape_string($apellidos)."\",f_nac=\"".mysql_real_escape_string($f_nac)."\", telefono=\"".mysql_real_escape_string($telefono)."\", correo=\"".mysql_real_escape_string($correo)."\", password=\"".mysql_real_escape_string($password)."\", edad=$edad WHERE id_usuario=$id_lider";
 
 if(mysql_query($consulta_up)){
 	$consulta_up2="UPDATE lideres SET id_grupo=$id_grupo, activo=$abierto WHERE id_lider=$id_lider";
 	if(mysql_query($consulta_up2)){
		echo "<script>  alert('Se han guardado los cambios.'); </script>";		
		echo("<META HTTP-EQUIV='Refresh' CONTENT='0; URL=servidores.php'>");
	}
} 		
}
if(isset($_REQUEST['eliminar_servidor'])){
  $id_servidor = $_GET['id_servidor'];
  $consulta_eliminar = "DELETE FROM lideres WHERE id_lider=$id_servidor";
  if(mysql_query($consulta_eliminar)){
  	  $consulta_eliminar2 = "DELETE FROM usuarios WHERE id_usuario=$id_servidor";
  	  if(mysql_query($consulta_eliminar2)){
      	echo "<script> alert('Servidor ha sido eliminado exitosamente.'); </script>";
      	echo("<META HTTP-EQUIV='Refresh' CONTENT='0; URL=servidores.php'>");
      }
    }  
}
?>
<?php 
mysql_close();
}
?>