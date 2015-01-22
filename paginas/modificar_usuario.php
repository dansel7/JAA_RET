<?php session_start();
header("Content-Type: text/html;charset=utf-8");
if(isset($_SESSION['user_jaa'])){
		$id_usuario=$_SESSION['user_jaa'];
		include("../class/conexion.php");
		mysql_query("SET NAMES 'utf8'");
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
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
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
$(document).ready(function() {
        $("#mensaje").dialog({
        modal:true,
        width:550,
        minWidth:400,
        maxWidth:650,
        show:"slide",
        hide:"scale",
        close: function(event, ui) { location.href = location.href },
        buttons: {
                Ok: function() {
                    $( this ).dialog( "close" );
                }
            }
    });})
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
    		Modificar registro de usuario
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
    <form action="modificar_usuario.php?id=<?php echo $_GET['id'];?>" method="post">
    <?php
		$id_hermano=$_GET['id'];	
		//Verificando si usuario existe en BD
		$consulta_hermano="SELECT id_hermano FROM hermanos WHERE id_hermano='$id_hermano'";
		$res_hermano=mysql_query($consulta_hermano);
		$centinela=0;
		while($row=mysql_fetch_array($res_hermano)){
			$centinela=$row['id_hermano'];
		}
		if($centinela==0){ //Si no existe, regresa a listado
			
		}else{
			$consulta_datos = "SELECT * FROM hermanos WHERE id_hermano=".$id_hermano;
			$res_datos = mysql_query($consulta_datos);
			while($row_datos=mysql_fetch_array($res_datos)){	
				$nombres = $row_datos['nombres'];
				$apellidos = $row_datos['apellidos'];
				$direccion = $row_datos['direccion'];
				$correo = $row_datos['correo'];
				$dui = $row_datos['dui'];
				$telefono = $row_datos['telefono'];
				$celular = $row_datos['celular'];
				$f_nac = $row_datos['f_nac'];
				$ged = $row_datos['ged'];
				$esp_ope = $row_datos['esp_ope'];
				$esp_aler = $row_datos['esp_aler'];
				$medicamento = $row_datos['medicamento'];
				$contacto1 = $row_datos['contacto1'];
				$contacto2 = $row_datos['contacto2'];
				$parentesco1 = $row_datos['parentesco1'];
				$parentesco2 = $row_datos['parentesco2'];
				$telefono1 = $row_datos['telefono1'];
				$telefono2 = $row_datos['telefono2'];
				$celular1 = $row_datos['celular1'];
				$celular2 = $row_datos['celular2'];
				$correo1 = $row_datos['correo1'];
				$correo2 = $row_datos['correo2'];
				$talla = $row_datos['talla'];
				$modulo = $row_datos['modulo'];
				$otromi = $row_datos['ministerio'];
				$nom_grupo_fv= $row_datos['nom_grupo_fv'];
				$pago = $row_datos['pago']; 

				if($row_datos['gj']=="si"){
					$minis[1] = 'checked="true"'; 
				}else{
					$minis[1] = ''; 
				}
				if($row_datos['fv']=="si"){
					$minis[2] = 'checked="true"'; 
				}else{
					$minis[2] = ''; 
				}
				if($row_datos['jaa']=="si"){
					$minis[3] = 'checked="true"'; 
				}else{
					$minis[3] = ''; 
				}
				if($row_datos['ed']=="si"){
					$minis[4] = 'checked="true"'; 
				}else{
					$minis[4] = ''; 
				}

				if($row_datos['genero']=="m"){ 
					$sexo_mdato = 'checked="checked"'; 
					$sexo_fdato = " "; 
				}elseif($row_datos['genero']=="f"){ 
					$sexo_fdato = 'checked="checked"'; 
					$sexo_mdato = " "; 
				}else{ 
					$sexo_mdato = " "; 
					$sexo_fdato = " ";					
				}
				if($row_datos['enf']=="si"){
					$enf_si = 'checked="checked"'; 
					$enf_no = ' '; 	
				}else{
					$enf_no = 'checked="checked"'; 
					$enf_si = ' '; 	
				}
				if($row_datos['ope']=="si"){
					$ope_si = 'checked="checked"'; 
					$ope_no = ' '; 	
				}else{
					$ope_no = 'checked="checked"'; 
					$ope_si = ' '; 	
				}
				if($row_datos['aler']=="si"){
					$aler_si = 'checked="checked"'; 
					$aler_no = ' '; 	
				}else{
					$aler_no = 'checked="checked"'; 
					$aler_si = ' '; 	
				}
				if($row_datos['ccdl']=="si"){
					$ccdl_si = 'checked="checked"'; 
					$ccdl_no = ' '; 	
				}else{
					$ccdl_no = 'checked="checked"'; 
					$ccdl_si = ' '; 	
				}
				if($row_datos['bautizado']=="si"){
					$ba_si = 'checked="checked"'; 
					$ba_no = ' '; 	
				}else{
					$ba_no = 'checked="checked"'; 
					$ba_si = ' '; 	
				}
			}
		}
	?>
    	<fieldset class="60per" style="-webkit-border-radius: 10px;"><legend style="color:#909090;font-weight: bold;">Informaci&oacute;n General</legend>
		<table style="margin:auto;width:100%">
        	<tr>
            	<td>Nombres:</td>
                <td>Apellidos:</td>
                <td>G&eacute;nero:</td>
            </tr>
            <tr>
                <td><input type="text" name="nombres" id="nombres" value="<?php echo $nombres; ?>" class="textbox_white" required="required" placeholder="Ingrese aqui nombres" autofocus="autofocus" onkeypress="return validar_letras(event)" /></td>
                <td><input type="text" name="apellidos" id="apellidos" value="<?php echo $apellidos; ?>" class="textbox_white" required="required" placeholder="Ingrese aqui apellidos" autofocus="autofocus" onkeypress="return validar_letras(event)" /></td>
                <td><div id="sexo" >
                <input type="radio" id="sexo1" name="sexo" value="m" <?php echo $sexo_mdato; ?> /><label for="sexo1">Hombre</label>
                <input type="radio" id="sexo2" name="sexo" value="f" <?php echo $sexo_fdato; ?> /><label for="sexo2">Mujer</label>
                </div>
            </td>
            </tr>
            <tr><td><br /></td></tr>
            <tr>
            <td>Direccion:</td>
            <td>Correo electr&oacute;nico:</td> 
            <td>DUI:</td>
            </tr>
            <tr>
                <td>
		<textarea name="direccion" id="direccion" cols="60" rows="10" class="textbox_white" required="required" placeholder="Ingrese aqui direcci&oacute;n" style="font-size:12px;font-family:Arial;"><?php echo $direccion; ?></textarea>
		</td>                             
               <td><input type="email" name="correo_electronico" size="25" value="<?php echo $correo; ?>" id="correo_electronico" class="textbox_white" required="required" placeholder="name@example.com" /></td>  
               <td><input type="text" name="dui" id= "dui" class="textbox_white" value="<?php echo $dui; ?>" placeholder="Ingrese aqui solo numeros" onkeypress="return validar_numeros(event)" /></td>
            </tr>
            <tr><td colspan="3"><br /></td></tr>
            <tr>
            	<td>Telefono:</td>
                <td>Celular:</td> 
		<td>Fecha de nacimiento:</td>      
            </tr>
            <tr>
                <td><input type="text" name="tel" id= "tel" value="<?php echo $telefono; ?>" class="textbox_white" required="required" placeholder="Ingrese aqui solo numeros" onkeypress="return validar_numeros(event)" /></td>
                <td><input type="text" name="cel" id= "cel" value="<?php echo $celular; ?>" class="textbox_white" required="required" placeholder="Ingrese aqui solo numeros" onkeypress="return validar_numeros(event)" /></td>       				
                <td><input type="date" name="f_nacimiento" id="f_nacimiento" value="<?php echo $f_nac; ?>" class="textbox_white" required="required" placeholder="Ingrese aqui fecha de nacimiento" /></td> 
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
						<input type="radio" id="si_enf" name="enf" value="si" <?php echo $enf_si; ?> /><label for="si_enf">Si</label>
                		<input type="radio" id="no_enf" name="enf" value="no" <?php echo $enf_no; ?> /><label for="no_enf">No</label>
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
					<input type="radio" id="si_oper" name="oper" value="si" <?php echo $ope_si; ?> onclick="mostrar_esp_operacion(this)" /><label for="si_oper">Si</label>
                	<input type="radio" id="no_oper" name="oper" value="no" <?php echo $ope_no; ?> onclick="mostrar_esp_operacion(this)" /><label for="no_oper">No</label>
				</div>      	
                </td>
                <td>
                <div id="esp_operacion" style="visibility:hidden;">
					Especifique: <input type="text" name="operes" id="operes" class="textbox_white" value="<?php echo $esp_ope; ?>" placeholder="Especifique aqui" />
                </div>
				</td>   
            </tr>
            
            <tr>
            	<td>
            	¿Es usted alergico(a)?</td>
                <td>
                <div id="alergia" >
					<input type="radio" id="si_aler" name="aler" <?php echo $aler_si; ?> value="si" onclick="mostrar_esp_alergia(this)" /><label for="si_aler">Si</label>
                	<input type="radio" id="no_aler" name="aler" <?php echo $aler_no; ?> value="no"  onclick="mostrar_esp_alergia(this)" /><label for="no_aler">No</label>
				</div>                	
                </td>
                <td>
                <div id="esp_alergia" style="visibility:hidden;">
                	Especifique: <input type="text" name="aleres" id="aleres" class="textbox_white" value="<?php echo $esp_aler; ?>" placeholder="Especifique aqui" />   &nbsp;
                     Medicamento: <input type="text" name="aleres_med" id="aleres_med" value="<?php echo $medicamento; ?>" class="textbox_white" value="" placeholder="Medicamento" />        
                </div>
                </td>
            </tr>
        </table>
        </fieldset>
        <fieldset class="60per" style="-webkit-border-radius: 10px; "><legend style="color:#909090;font-weight: bold;">Informaci&oacute;n de otros</legend>
        <table style="margin:auto;width:100%">
            <tr><td>GED a la que asiste:</td>
            <td><input type="text" name="ged" id="ged" class="textbox_white" value="<?php echo $ged; ?>" placeholder="Nombre de o encargado de GED" size="30" />   </td>            </tr>
            <tr>
            	<td>
            	¿Ha estado o est&aacute; en CCDL?</td><td>
                <div id="divccdl" >
					<input type="radio" id="si_ccdl" name="ccdl" value="si" <?php echo $ccdl_si;?> onclick="mostrar_esp_ccdl(this)" /><label for="si_ccdl">Si</label>
                	<input type="radio" id="no_ccdl" name="ccdl" value="no" <?php echo $ccdl_no;?>  onclick="mostrar_esp_ccdl(this)" /><label for="no_ccdl">No</label>
				</div>
                <td>                	
                <div id="esp_ccdl" style="visibility:hidden;">Modulo:
                    <select name="modulo" id="modulo" class="textbox_white" >
                <?php
                	if($modulo==0){
						echo "<option value=\"0\">-Seleccione un modulo-</option>";
					}else{
						$consulta_modulo = "SELECT nombre FROM modulos_ccdl WHERE id_modulo=".$modulo;
						$res_modulo=mysql_query($consulta_modulo);
						while($row_modulo=mysql_fetch_array($res_modulo)){		
			    			echo "<option value=\"".$modulo."\">".$row_modulo['nombre']."</option>";
						}
					}				
					$consulta_modulos = "SELECT id_modulo, nombre FROM modulos_ccdl WHERE id_modulo<>$modulo";
					$res_modulos=mysql_query($consulta_modulos);	
					while($row_modulos=mysql_fetch_array($res_modulos)){		
			    		echo "<option value=\"".$row_modulos['id_modulo']."\">".$row_modulos['nombre']."</option>";
					}
				?>
            		</select>
                    </div>
				</td>
            </tr>
            <tr>
            <td>Bautizado(a):</td>
                <td>
                	<input type="radio" id="si_ba" name="ba" value="si" <?php echo $ba_si;?> /><label for="si_ba">Si</label>
                	<input type="radio" id="no_ba" name="ba" value="no" <?php echo $ba_no;?> /><label for="no_ba">No</label>
                </td>
            </tr>
            <tr>
            <td>Ministerio:<br><br>&nbsp;</td>
                <td>
                    <?php /*
					$consulta_mi = "SELECT id_ministerio, nombre FROM ministerios WHERE id_ministerio=4 OR id_ministerio=5 OR id_ministerio=3 OR id_ministerio=1";
					$res_mi=mysql_query($consulta_mi);	
                	$i=0;
                	$contador=0;
					while($row_mi=mysql_fetch_array($res_mi)){
						$i++;		
			    		echo $row_mi['nombre']."<input name=\"minis$i\" type=\"checkbox\" id=\"minis$i\" value='si'".$minis[$i]." >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			    		$contador++;
			    		if($contador==5){
							echo "<br />";
							$contador=0;
						}
					}
                     */
				?>
                     GJ<input name="minis1" type="checkbox" id="minis1"  <?php echo $minis[1];?> value='si' >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   Formando Vidas<input onclick="mostrar_esp_fv(this)"   <?php echo $minis[2];?>name="minis2" type="checkbox" id="minis2" value='si' >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    
                   JAA<input name="minis3" type="checkbox" id="minis3"   <?php echo $minis[3];?>value='si' >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   Escuela Dominical<input name="minis4" type="checkbox" <?php echo $minis[4];?>id="minis4" value='si' >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="text" name="nom_grupo_fv" id="nom_grupo_fv" style="visibility:hidden;width:0" class="textbox_white" value="<?php echo $nom_grupo_fv;?>" placeholder="Especifique Grupo FV" />
                </td>
                <td>Otro: <input type="text" name="otromi" id="otromi" class="textbox_white" value="<?php echo $otromi;?>" placeholder="Ministerio" size="25" /><br><br>&nbsp;</td>
            </tr>
            <tr>
            <td>Talla de camisa:</td>
                <td>
                	<select name="talla" id="talla" class="textbox_white" >
                    <?php
					if($talla==0){
						echo "<option value=\"0\">-Seleccione una talla-</option>";
					}else{
						$consulta_talla = "SELECT nombre FROM tallas WHERE id_talla=$talla";
						$res_talla=mysql_query($consulta_talla);
						while($row_talla=mysql_fetch_array($res_talla)){		
			    			echo "<option value=\"".$talla."\">".$row_talla['nombre']."</option>";
						}
					}				
					$consulta_tallas = "SELECT id_talla, nombre FROM tallas WHERE id_talla<>$talla";
					$res_tallas=mysql_query($consulta_tallas);	
					while($row_tallas=mysql_fetch_array($res_tallas)){		
			    		echo "<option value=\"".$row_tallas['id_talla']."\">".$row_tallas['nombre']."</option>";
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
                <td><input type="text" name="contacto1" id="contacto1" value="<?php echo html_entity_decode($contacto1); ?>" class="textbox_white"  placeholder="Ingrese aqui nombres" onkeypress="return validar_letras(event)" /></td>
                <td>Parentesco:</td>
                <td><input type="text" name="parentesco1" id="parentesco1" value="<?php echo html_entity_decode($parentesco1); ?>" class="textbox_white" placeholder="Ingrese aqui parentesco o afinidad de contacto"  /></td>
                <td>Correo Electronico:</td>
                <td><input type="email" name="correo1" id="correo1" value="<?php echo $correo1; ?>" class="textbox_white"  placeholder="name@example.com" /></td>
            </tr>
            <tr>                <td>Telefono:</td>
                <td><input type="text" name="telefono1" id= "telefono1" value="<?php echo $telefono1;?>" class="textbox_white"  placeholder="Ingrese aqui solo numeros" onkeypress="return validar_numeros(event)" /></td>
                <td>Celular:</td>
                <td><input type="text" name="celular1" id="celular1" value="<?php echo $celular1; ?>" class="textbox_white" placeholder="Ingrese aqui solo numeros" onkeypress="return validar_numeros(event)"  /></td>
            </tr>
        </table>
        <br />
        <table style="margin:auto;width:100%">
            <tr>
            	<td>Nombre completo de contacto:</td>
                <td><input type="text" name="contacto2" id="contacto2" value="<?php echo html_entity_decode($contacto2); ?>" class="textbox_white"  placeholder="Ingrese aqui nombres" onkeypress="return validar_letras(event)" /></td>
                <td>Parentesco:</td>
                <td><input type="text" name="parentesco2" id="parentesco2" value="<?php echo html_entity_decode($parentesco2); ?>" class="textbox_white" placeholder="Ingrese aqui parentesco o afinidad de contacto"  /></td>
                <td>Correo Electronico:</td>
                <td><input type="email" name="correo2" id="correo2" value="<?php echo $correo2; ?>" class="textbox_white"  placeholder="name@example.com" /></td>
            </tr>
            <tr>                <td>Telefono:</td>
                <td><input type="text" name="telefono2" id= "telefono2" value="<?php echo $telefono2; ?>" class="textbox_white"  placeholder="Ingrese aqui solo numeros" onkeypress="return validar_numeros(event)" /></td>
                <td>Celular:</td>
                <td><input type="text" name="celular2" id="celular2" value="<?php echo $celular2; ?>" class="textbox_white" placeholder="Ingrese aqui solo numeros" onkeypress="return validar_numeros(event)"  /></td>
            </tr>
        </table>
        </fieldset>
        <table style="margin:auto;width:100%">
        <tr>
        <td colspan="3" align="center" style="width:33.33%"><br>
            <?php if($pago=="no"){
            ?>
                <input type="submit" class="boton_especial" value="Registrar Pago" name="reg_pago" />
            <?php
            } 
            ?>
        </td>
        </tr>
        <tr>
        <td align="center" style="width:33.33%"><br>
           <input type="submit" class="boton_general" value="Tomar foto" name="foto" id="foto" />
        </td>
        <td align="center" style="width:33.33%"><br>
            <input type="submit" class="boton_general" value="Actualizar Datos" name="guardar" id="guardar" />
        </td>
        <td align="center" style="width:33.33%"><br>
             <input type="submit" class="boton_general" value="Imprimir Ficha de Inscripcion" name="imprimir" />
        </td>
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
if(isset($_REQUEST['guardar'])){
		
	//$nombres=$_POST['nombres'];
	//$nombres=strtolower($nombres);
	$nombres=$_POST['nombres'];
	//$apellidos=$_POST['apellidos'];
	//$apellidos=strtolower($apellidos);
	$apellidos=$_POST['apellidos'];	
	$direccion=$_POST['direccion'];
	//$direccion=strtolower($direccion);
	//$direccion=$direccion;
	$correo_usuario=$_POST['correo_electronico'];
	
	$genero=$_POST['sexo'];
	$dui=$_POST['dui'];
	
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
	
	$pago = (isset($_POST['pago'])) ? $_POST['pago'] : "no";
		
	$contacto1 = $_POST['contacto1'];
	$parentesco1 = $_POST['parentesco1'];
	$telefono1 = $_POST['telefono1'];
	$celular1 = $_POST['celular1'];
	$correo1 = $_POST['correo1'];
	$contacto2 = $_POST['contacto2'];
	$parentesco2 = $_POST['parentesco2'];
	$telefono2 = $_POST['telefono2'];
	$celular2 = $_POST['celular2'];
	$correo2 = $_POST['correo2'];

	//Calculando edad
	$consulta_edad = "SELECT DATE(\"".$f_nac."\") as FechaNacimiento,CURDATE() as FechaActual,TIMESTAMPDIFF(YEAR, \"".$f_nac."\", NOW()) as Edad";
	$res_edad=mysql_query($consulta_edad);
	while($row_edad=mysql_fetch_array($res_edad)){
			$edad=$row_edad['Edad'];
		}		
	$id_usuario=$_SESSION['user_jaa'];
	$id_hermano = $_GET['id'];
	$consulta_update="UPDATE hermanos SET nombres=\"".mysql_real_escape_string($nombres)."\", apellidos=\"".mysql_real_escape_string($apellidos)."\",genero=\"".mysql_real_escape_string($genero)."\",direccion=\"".mysql_real_escape_string($direccion)."\",correo=\"".mysql_real_escape_string($correo_usuario)."\",dui=\"".mysql_real_escape_string($dui)."\",telefono=\"".mysql_real_escape_string($tel)."\",celular=\"".mysql_real_escape_string($cel)."\",f_nac=\"".mysql_real_escape_string($f_nac)."\",p_nac=\"68\",enf=\"".mysql_real_escape_string($enf)."\",ope=\"".mysql_real_escape_string($ope)."\",esp_ope=\"".mysql_real_escape_string($esp_ope)."\",aler=\"".mysql_real_escape_string($aler)."\",esp_aler=\"".mysql_real_escape_string($esp_aler)."\",ged=\"".mysql_real_escape_string($ged)."\",ccdl=\"".mysql_real_escape_string($ccdl)."\",bautizado=\"".mysql_real_escape_string($bautizado)."\",modulo=\"".mysql_real_escape_string($modulo)."\",talla=\"".mysql_real_escape_string($talla)."\",edad=\"".mysql_real_escape_string($edad)."\",id_usuario=\"".mysql_real_escape_string($id_usuario)."\",medicamento=\"".mysql_real_escape_string($aler_med)."\",contacto1=\"".mysql_real_escape_string($contacto1)."\",parentesco1=\"".mysql_real_escape_string($parentesco1)."\",telefono1=\"".mysql_real_escape_string($telefono1)."\",celular1=\"".mysql_real_escape_string($celular1)."\",correo1=\"".mysql_real_escape_string($correo1)."\",contacto2=\"".mysql_real_escape_string($contacto2)."\",parentesco2=\"".mysql_real_escape_string($parentesco2)."\",telefono2=\"".mysql_real_escape_string($telefono2)."\",celular2=\"".mysql_real_escape_string($celular2)."\",correo2=\"".mysql_real_escape_string($correo2)."\",ministerio=\"".mysql_real_escape_string($ministerio)."\",gj=\"".mysql_real_escape_string($gj)."\",fv=\"".mysql_real_escape_string($fv)."\",ed=\"".mysql_real_escape_string($ed)."\",jaa=\"".mysql_real_escape_string($jaa)."\",nom_grupo_fv=\"".mysql_real_escape_string($nom_grupo_fv)."\",retiro='1-2013' WHERE id_hermano=$id_hermano";
	
	if(mysql_query($consulta_update)){
		echo "<script>  alert('Se han guardado los cambios.'); </script>";
		echo("<META HTTP-EQUIV='Refresh' CONTENT='0; URL=modificar_usuario.php?id=$id_hermano'>");
		}     
        }
        
        
if(isset($_REQUEST['reg_pago'])){
    $id_usuario=$_SESSION['user_jaa'];
	$id_hermano = $_GET['id'];
	//Hacer un Update del Campo pago
		$consulta_update="UPDATE hermanos SET pago=\"si\" WHERE id_hermano=$id_hermano";
                mysql_query($consulta_update);  
        //Comprobar que no este ya en la tabla de inscripciones
		$consulta_existencia="SELECT id_hermano FROM inscripcion WHERE id_hermano='".$id_hermano."'";
		$res_ex=mysql_query($consulta_existencia);
		$existe=0;
		while($row_existe=mysql_fetch_array($res_ex)){
			$existe=$row_existe['id_hermano'];
		}			
		if($existe==0){
		//Si no existe inscripcion nueva
		$consulta_registro = "INSERT INTO inscripcion (id_hermano,id_usuario,fecha,pago) VALUES(\"".mysql_real_escape_string($id_hermano)."\", \"".mysql_real_escape_string($id_usuario)."\", now(), \"si\")";
		echo "<script>  alert('Usuario inscrito exitosamente.'); </script>";
		
                if(mysql_query($consulta_registro)){
		   echo " <script>window.open('impresion_recibo.php?id=$id_hermano','','height=400,width=400'); </script>";
                    echo("<META HTTP-EQUIV='Refresh' CONTENT='0; URL=modificar_usuario.php?id=$id_hermano'>");    
                }
		}else{
			echo "<script>  alert('Usuario previamente registrado.'); </script>";
                        
			echo " <script>window.open('impresion_recibo.php?id=$id_hermano','','height=400,width=400'); </script>";
		}	

}

if(isset($_REQUEST['imprimir'])){
$id_hermano = $_GET['id'];
	//Consultar pago en tabla hermanos
		$pago="";
		$consulta_pago="SELECT pago FROM hermanos WHERE id_hermano=".$id_hermano;
		$res_pago=mysql_query($consulta_pago);
		while($row_pago=mysql_fetch_array($res_pago)){
			$pago=$row_pago['pago'];
		}
                echo $pago;
	if($pago=="no"){
		echo "<script>  alert('No se ha efectuado el pago.'); </script>";
		echo("<META HTTP-EQUIV='Refresh' CONTENT='0; URL=modificar_usuario.php?id=$id_hermano'>");
	}else if($pago=="si"){
        echo " <script>window.open('impresion_usuario.php?id=$id_hermano','','height=400,width=400'); </script>";
        }
}

if(isset($_REQUEST['foto'])){
	$id_hermano = $_GET['id'];
	echo("<META HTTP-EQUIV='Refresh' CONTENT='0; URL=camara/index.php?id=$id_hermano'>");
}
mysql_close();
}
else{
	echo("<META HTTP-EQUIV='Refresh' CONTENT='0; URL=http://localhost/jaa_retiros/index.php'>");//env�o al usuario a la pag. de inicio 
	    exit();
}


?>
<script>mostrar_esp_fv(document.getElementById("minis2"));</script>