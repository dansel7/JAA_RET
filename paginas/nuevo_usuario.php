<?php session_start();
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
<link href="../diseno/css/estilo.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="../diseno/css/jquery-ui-1.8.23.custom.css" rel="stylesheet" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
<script type="text/javascript" src="../js/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="../js/jquery-ui-1.8.23.custom.min.js"></script>
<script type="text/javascript" src="../js/jquery.tipsy.js"></script>
<link href="../diseno/css/tipsy.css" rel="stylesheet" type="text/css" />
<link href="../diseno/css/tipsy-docs.css" rel="stylesheet" type="text/css" />
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
//Validando entrada de letras: no se admiten numeros
function validar_letras(e) { 
    tecla = (document.all) ? e.keyCode : e.which; 
    if (tecla==8) return true; 
    	patron =/[0-9]/; 
		te = String.fromCharCode(tecla); 
		return !patron.test(te); 
}
//Validando entrada de numeros: no se admiten letras
function validar_numeros(e) { 
    tecla = (document.all) ? e.keyCode : e.which; 
    if (tecla==8) return true; 
    	patron =/[0-9]/; 
		te = String.fromCharCode(tecla); 
		return patron.test(te); 
}
	function mostrar_esp_operacion(objeto){
	var obj = objeto.value;
	if(obj=="si"){
		//Muestra cuadro de especificacion para operacion.
		document.getElementById("esp_operacion").style.visibility = "visible"; 
	}else if(obj=="no"){
		//Oculta cuadro de especificacion para operacion
		document.getElementById("esp_operacion").style.visibility = "hidden"; 
	}
	}
function mostrar_esp_alergia(objeto){
	var obj = objeto.value;
	if(obj=="si"){
		//Muestra cuadro de especificacion para operacion.
		document.getElementById("esp_alergia").style.visibility = "visible"; 
	}else if(obj=="no"){
		//Oculta cuadro de especificacion para operacion
		document.getElementById("esp_alergia").style.visibility = "hidden"; 
	}
	else{
		document.getElementById("esp_alergia").style.visibility = "hidden"; 
	}
}
function mostrar_esp_ccdl(objeto){
	var obj = objeto.value;
	if(obj=="si"){
		//Muestra cuadro de especificacion para operacion.
		document.getElementById("esp_ccdl").style.visibility = "visible"; 
	}else if(obj=="no"){
		//Oculta cuadro de especificacion para operacion
		document.getElementById("esp_ccdl").style.visibility = "hidden"; 
	}
	else{
		document.getElementById("esp_ccdl").style.visibility = "hidden"; 
	}
}

function mostrar_esp_fv(objeto){
	var obj = objeto.checked;

	if(obj){
		//Muestra cuadro de especificacion para operacion.
		document.getElementById("nom_grupo_fv").style.visibility = "visible"; 
                document.getElementById("nom_grupo_fv").style.width="135px"; 
	}
	else{
		document.getElementById("nom_grupo_fv").style.visibility = "hidden"; 
                document.getElementById("nom_grupo_fv").style.width = 0; 
                document.getElementById("nom_grupo_fv").value=""; 
	}
}
</script>
<body>
<div id="contenedor_header">
<?php include("head_menu.php"); ?>
</div>
<div id="cuerpo">
	<div id="contenedor1">
		<div id="nav">
    		Registrar nuevo usuario
    	</div>
        <div id="fecha">
        	<?php
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
    <div id="dash">
    <form action="nuevo_usuario.php" method="post">
    	<fieldset class="60per" style="-webkit-border-radius: 10px;"><legend style="color:#909090;font-weight: bold;">Informaci&oacute;n General</legend>
		<table style="margin:auto;width:100%">
        	<tr>
            	<td>Nombres:</td>
                <td>Apellidos:</td>
                <td>G&eacute;nero:</td>
            </tr>
            <tr>
                <td><input type="text" name="nombres" id="nombres" class="textbox_white" required="required" placeholder="Ingrese aqui nombres" autofocus="autofocus" onkeypress="return validar_letras(event)" /></td>
                <td><input type="text" name="apellidos" id="apellidos" class="textbox_white" required="required" placeholder="Ingrese aqui apellidos" autofocus="autofocus" onkeypress="return validar_letras(event)" /></td>
                <td><div id="sexo" >
                <input type="radio" id="sexo1" name="sexo" value="m" checked="checked" /><label for="sexo1">Hombre</label>
                <input type="radio" id="sexo2" name="sexo" value="f" /><label for="sexo2">Mujer</label>
                </div>
            </td>
            </tr>
            <tr><td colspan="3"><br /></td></tr>
            <tr>
            <td>Direccion:</td>
            <td colspan="2">Correo electr&oacute;nico:</td>
            
            </tr>
            <tr>
                <td>
				<textarea name="direccion" id="direccion" cols="60" rows="10" class="textbox_white" required="required" placeholder="Ingrese aqui direcci&oacute;n" style="font-size:12px;font-family:Arial;"></textarea>
				</td>
                <td><input type="email" name="correo_electronico" size="22" value="" id="correo_electronico" class="textbox_white" required="required" placeholder="name@example.com" /></td>
                
            </tr>
            <tr><td colspan="3"><br /></td></tr>
            <tr>
            	<td>Telefono:</td>
                <td>Celular:</td>
                <td>Fecha de nacimiento:</td>
            </tr>
            <tr>
                <td><input type="text" name="tel" id= "tel" class="textbox_white" required="required" placeholder="Ingrese aqui solo numeros" onkeypress="return validar_numeros(event)" /></td>
                <td><input type="text" name="cel" id= "cel" class="textbox_white" required="required" placeholder="Ingrese aqui solo numeros" onkeypress="return validar_numeros(event)" /></td>
               <td><input type="date" name="f_nacimiento" id="f_nacimiento" class="textbox_white" required="required" placeholder="Ingrese aqui fecha de nacimiento" /></td> 
            </tr>
            <tr><td colspan="3"><br /></td></tr>
        </table>
        </fieldset>
        <fieldset class="60per" style="-webkit-border-radius: 10px; "><legend style="color:#909090;font-weight: bold;">Condiciones fisicas</legend>
       <table cellpadding="3">
        <tr>
				<td>
					¿Padece de alguna enfermedad que requiere tratamiento continuo?
                    </td>
                    <td colspan="2">
                    <div id="enfermedad">
						<input type="radio" id="si_enf" name="enf" value="si" /><label for="si_enf">Si</label>
                		<input type="radio" id="no_enf" name="enf" value="no" checked="checked" /><label for="no_enf">No</label>
					</div>
				</td><td></td>
			</tr>
        </table>
         <table cellpadding="3">
        	<tr>
			    <td>      		
            	¿Ha sido operado(a) alguna vez?</td>
                <td>
                <div id="operacion" >
					<input type="radio" id="si_oper" name="oper" value="si" onclick="mostrar_esp_operacion(this)" /><label for="si_oper">Si</label>
                	<input type="radio" id="no_oper" name="oper" value="no" checked="checked" onclick="mostrar_esp_operacion(this)" /><label for="no_oper">No</label>
				</div>      	
                </td>
                <td>
                <div id="esp_operacion" style="visibility:hidden;">
					Especifique: <input type="text" name="operes" id="operes" class="textbox_white" value="" placeholder="Especifique aqui" />
                </div>
				</td>   
            </tr>
            
            <tr>
            	<td>
            	¿Es usted alergico(a)?</td>
                <td>
                <div id="alergia" >
					<input type="radio" id="si_aler" name="aler" value="si" onclick="mostrar_esp_alergia(this)" /><label for="si_aler">Si</label>
                	<input type="radio" id="no_aler" name="aler" value="no" checked="checked"  onclick="mostrar_esp_alergia(this)" /><label for="no_aler">No</label>
				</div>                	
                </td>
                <td>
                <div id="esp_alergia" style="visibility:hidden;">
                	Especifique: <input type="text" name="aleres" id="aleres" class="textbox_white" value="" placeholder="Especifique aqui" /> &nbsp;&nbsp;
                    Medicamento: <input type="text" name="aleres_med" id="aleres_med" class="textbox_white" value="" placeholder="Medicamento" />      
                </div>
                </td>
            </tr>
        </table>
        </fieldset>
        <fieldset class="60per" style="-webkit-border-radius: 10px; "><legend style="color:#909090;font-weight: bold;">Informaci&oacute;n de otros</legend>
        <table style="margin:auto;width:100%">
            <tr><td>GED a la que asiste:</td>
            <td><input type="text" name="ged" id="ged" class="textbox_white" value="" placeholder="Nombre de o encargado de GED" size="30" />   </td>            </tr>
            <tr>
            	<td>
            	¿Ha estado o est&aacute; en CCDL?</td><td>
                <div id="divccdl" >
					<input type="radio" id="si_ccdl" name="ccdl" value="si" onclick="mostrar_esp_ccdl(this)" /><label for="si_ccdl">Si</label>
                	<input type="radio" id="no_ccdl" name="ccdl" value="no" checked="checked" onclick="mostrar_esp_ccdl(this)" /><label for="no_ccdl">No</label>
				</div>
                <td>                	
                <div id="esp_ccdl" style="visibility:hidden;">Modulo:
                    <select name="modulo" id="modulo" class="textbox_white" >
                	<option value="0">-Seleccione un modulo-</option>
                <?php
					$consulta_modulos = "SELECT id_modulo, nombre FROM modulos_ccdl";
					$res_modulo=mysql_query($consulta_modulos);	
					while($row_m=mysql_fetch_array($res_modulo)){		
			    		echo "<option value=\"".$row_m['id_modulo']."\">".$row_m['nombre']."</option>";
					}
				?>
            		</select>
                    </div>
				</td>
            </tr>
            <tr>
            <td>Bautizado(a):</td>
                <td>
                	<input type="radio" id="si_ba" name="ba" value="si" /><label for="si_ba">Si</label>
                	<input type="radio" id="no_ba" name="ba" value="no" checked="checked" /><label for="no_ba">No</label>
                </td>
            </tr>
            <tr>
                <td>Ministerio:<br><br>&nbsp;</td>
                <td>
                    <?php
                    /*
					$consulta_mi = "SELECT id_ministerio, nombre FROM ministerios WHERE id_ministerio=4 OR id_ministerio=5 OR id_ministerio=3 OR id_ministerio=1";
					$res_mi=mysql_query($consulta_mi);	
                	$i=0;
                	$contador=0;
					while($row_mi=mysql_fetch_array($res_mi)){
						$i++;		
			    		echo $row_mi['nombre']."<input name=\"minis$i\" type=\"checkbox\" id=\"minis$i\" value='si' >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			    		$contador++;
			    		if($contador==5){
							echo "<br />";
							$contador=0;
						}
					}
                     */                    
				?>
                    
                   GJ<input name="minis1" type="checkbox" id="minis1" value='si' >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   Formando Vidas<input onclick="mostrar_esp_fv(this)" name="minis2" type="checkbox" id="minis2" value='si' >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    
                   JAA<input name="minis3" type="checkbox" id="minis3" value='si' >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   Escuela Dominical<input name="minis4" type="checkbox" id="minis4" value='si' >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="text" name="nom_grupo_fv" id="nom_grupo_fv" style="visibility:hidden;width:0" class="textbox_white" value="" placeholder="Especifique Grupo FV" />
                </td>
            <td>Otro: <input type="text" name="otromi" id="otromi" class="textbox_white" value="" placeholder="Ministerio" size="25" /><br><br>&nbsp;
                </td>
            </tr>
            <tr>
            <td>Talla de camisa:</td>
                <td>
                	<select name="talla" id="talla" class="textbox_white" >
                	<option value="0">-Seleccione una talla-</option>
                    <?php
					$consulta_talla = "SELECT id_talla, nombre FROM tallas";
					$res_talla=mysql_query($consulta_talla);	
					while($row_talla=mysql_fetch_array($res_talla)){		
			    		echo "<option value=\"".$row_talla['id_talla']."\">".$row_talla['nombre']."</option>";
					}
				?>
                    </select>
                </td>
            </tr>
        </table>
        </fieldset>
        <fieldset class="60per" style="-webkit-border-radius: 10px; "><legend style="color:#909090;font-weight: bold;">Informaci&oacute;n de contacto</legend>
        <table style="margin:auto;width:100%">
            <tr>
            	<td>Nombre completo de contacto:</td>
                <td><input type="text" name="contacto1" id="contacto1" class="textbox_white"  placeholder="Ingrese aqui nombres" onkeypress="return validar_letras(event)" /></td>
                <td>Parentesco:</td>
                <td><input type="text" name="parentesco1" id="parentesco1" class="textbox_white" placeholder="Ingrese aqui parentesco o afinidad de contacto"  /></td>
                <td>Correo Electronico:</td>
                <td><input type="email" name="correo1" id="correo1" class="textbox_white"  placeholder="name@example.com" /></td>
            </tr>
            <tr>                <td>Telefono:</td>
                <td><input type="text" name="telefono1" id= "telefono1" class="textbox_white"  placeholder="Ingrese aqui solo numeros" onkeypress="return validar_numeros(event)" /></td>
                <td>Celular:</td>
                <td><input type="text" name="celular1" id="celular1" class="textbox_white" placeholder="Ingrese aqui solo numeros" onkeypress="return validar_numeros(event)"  /></td>
            </tr>
        </table>
        <br />
        <table style="margin:auto;width:100%">
            <tr>
            	<td>Nombre completo de contacto:</td>
                <td><input type="text" name="contacto2" id="contacto2" class="textbox_white"  placeholder="Ingrese aqui nombres" onkeypress="return validar_letras(event)" /></td>
                <td>Parentesco:</td>
                <td><input type="text" name="parentesco2" id="parentesco2" class="textbox_white" placeholder="Ingrese aqui parentesco o afinidad de contacto"  /></td>
                <td>Correo Electronico:</td>
                <td><input type="email" name="correo2" id="correo2" class="textbox_white"  placeholder="name@example.com" /></td>
            </tr>
            <tr>                <td>Telefono:</td>
                <td><input type="text" name="telefono2" id= "telefono2" class="textbox_white"  placeholder="Ingrese aqui solo numeros" onkeypress="return validar_numeros(event)" /></td>
                <td>Celular:</td>
                <td><input type="text" name="celular2" id="celular2" class="textbox_white" placeholder="Ingrese aqui solo numeros" onkeypress="return validar_numeros(event)"  /></td>
            </tr>
        </table>
        </fieldset>
        <table style="margin:auto;width:100%">
            <tr>
            	<td align="center"><br><b><center> Haga Clic para Continuar el Registro:</center></b>
                <input type="submit" class="boton_general" value="Agregar usuario" name="agregar" /></td>
            </tr>
        </table>
	</form>
   	</div>
    <div id="foot_body">
    	<div id="esquina"></div>
    </div>
</div>
<?php include("footer.php"); ?>
</body>
</html>
<?php
if(isset($_REQUEST['agregar'])){	
	$nombres=$_POST['nombres'];
	$nombres=strtolower($nombres);
	$nombres=htmlspecialchars($nombres);
	$apellidos=$_POST['apellidos'];
	$apellidos=strtolower($apellidos);
	$apellidos=htmlspecialchars($apellidos);	
	$direccion=$_POST['direccion'];
	$direccion=strtolower($direccion);
	$direccion=htmlspecialchars($direccion);
	$correo_usuario=$_POST['correo_electronico'];
	$genero=$_POST['sexo'];
	
	$tel=$_POST['tel'];
	$cel=$_POST['cel'];
	$f_nac=$_POST['f_nacimiento'];
	$ministerio=$_POST['otromi'];
	
	$enf = (isset($_POST['enf'])) ? $_POST['enf'] : "";	
	$ope = (isset($_POST['oper'])) ? $_POST['oper'] : "";
	$esp_ope = htmlspecialchars($_POST['operes']);
	
	$aler = (isset($_POST['aler'])) ? $_POST['aler'] : "";
	$esp_aler = htmlspecialchars($_POST['aleres']);
	$aler_med = htmlspecialchars($_POST['aleres_med']);
	
	$ged = htmlspecialchars($_POST['ged']);
	$ccdl = $_POST['ccdl'];
	$modulo = $_POST['modulo'];
	$bautizado = $_POST['ba'];
	$talla = $_POST['talla'];
	
	$gj = (isset($_POST['minis1'])) ? $_POST['minis1'] : "no";
	$fv = (isset($_POST['minis2'])) ? $_POST['minis2'] : "no";
        $nom_grupo_fv=(isset($_POST['nom_grupo_fv'])) ? $_POST['nom_grupo_fv'] : "";
	$jaa = (isset($_POST['minis3'])) ? $_POST['minis3'] : "no";
	$ed = (isset($_POST['minis4'])) ? $_POST['minis4'] : "no";
		
	$contacto1 = htmlspecialchars($_POST['contacto1']);
	$parentesco1 = htmlspecialchars($_POST['parentesco1']);
	$telefono1 = $_POST['telefono1'];
	$celular1 = $_POST['celular1'];
	$correo1 = $_POST['correo1'];
	$contacto2 = htmlspecialchars($_POST['contacto2']);
	$parentesco2 = htmlspecialchars($_POST['parentesco2']);
	$telefono2 = $_POST['telefono2'];
	$celular2 = $_POST['celular2'];
	$correo2 = $_POST['correo2'];;
	//Calculando edad
	$consulta_edad = "SELECT DATE(\"".$f_nac."\") as FechaNacimiento,
CURDATE() as FechaActual,
TIMESTAMPDIFF(YEAR, \"".$f_nac."\", NOW()) as Edad";
	$res_edad=mysql_query($consulta_edad);
	while($row_edad=mysql_fetch_array($res_edad)){
			$edad=$row_edad['Edad'];
		}
		
	$id_usuario=$_SESSION['user_jaa'];

			$consulta_new="INSERT INTO hermanos(id_hermano,nombres,apellidos,genero,direccion,correo,telefono,celular,f_nac,p_nac,enf,ope,esp_ope,aler,esp_aler,ged,ccdl,bautizado,modulo,talla,edad,id_usuario,medicamento,contacto1,parentesco1,telefono1,celular1,correo1,contacto2,parentesco2,telefono2,celular2,correo2,ministerio,gj,fv,ed,jaa,nom_grupo_fv) VALUES(0,\"".mysql_real_escape_string($nombres)."\",\"".mysql_real_escape_string($apellidos)."\",\"".mysql_real_escape_string($genero)."\",\"".mysql_real_escape_string($direccion)."\",\"".mysql_real_escape_string($correo_usuario)."\",\"".mysql_real_escape_string($tel)."\",\"".mysql_real_escape_string($cel)."\",\"".mysql_real_escape_string($f_nac)."\",\"68\",\"".mysql_real_escape_string($enf)."\",\"".mysql_real_escape_string($ope)."\",\"".mysql_real_escape_string($esp_ope)."\",\"".mysql_real_escape_string($aler)."\",\"".mysql_real_escape_string($esp_aler)."\",\"".mysql_real_escape_string($ged)."\",\"".mysql_real_escape_string($ccdl)."\",\"".mysql_real_escape_string($bautizado)."\",\"".mysql_real_escape_string($modulo)."\",\"".mysql_real_escape_string($talla)."\",\"".mysql_real_escape_string($edad)."\",\"".mysql_real_escape_string($id_usuario)."\",\"".mysql_real_escape_string($aler_med)."\",\"".mysql_real_escape_string($contacto1)."\",\"".mysql_real_escape_string($parentesco1)."\",\"".mysql_real_escape_string($telefono1)."\",\"".mysql_real_escape_string($celular1)."\",\"".mysql_real_escape_string($correo1)."\",\"".mysql_real_escape_string($contacto2)."\",\"".mysql_real_escape_string($parentesco2)."\",\"".mysql_real_escape_string($telefono2)."\",\"".mysql_real_escape_string($celular2)."\",\"".mysql_real_escape_string($correo2)."\",\"".mysql_real_escape_string($ministerio)."\",\"".mysql_real_escape_string($gj)."\",\"".mysql_real_escape_string($fv)."\",\"".mysql_real_escape_string($ed)."\",\"".mysql_real_escape_string($jaa)."\",\"".mysql_real_escape_string($nom_grupo_fv)."\")";

	if(mysql_query($consulta_new)){
		echo "<script>  alert('Usuario agregado exitosamente.'); </script>";
		$consulta_existencia="SELECT id_hermano FROM hermanos WHERE nombres='".$nombres."' AND correo='".$correo_usuario."' AND id_usuario=$id_usuario";
		$res_ex=mysql_query($consulta_existencia);
		$id_hermano=0;
		while($row=mysql_fetch_array($res_ex)){
			$id_hermano=$row['id_hermano'];
		}
		echo("<META HTTP-EQUIV='Refresh' CONTENT='0; URL=modificar_usuario.php?id=$id_hermano'>");
		}
}

mysql_close();
}
else{
	echo("<META HTTP-EQUIV='Refresh' CONTENT='0; URL=http://localhost/jaa_retiros/index.php'>");//env�o al usuario a la pag. de inicio 
	    exit();
}
?>