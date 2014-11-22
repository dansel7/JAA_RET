<?php session_start();
header("Content-Type: text/html;charset=utf-8");
if(isset($_SESSION['user_jaa'])){
		$id_usuario=$_SESSION['user_jaa'];
		include("paginas/conexion.php");
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
</script>
<body>
<div id="contenedor_header">
<?php include("paginas/head_menu.php"); ?>
</div>
<div id="cuerpo">
	<div id="contenedor1">
		<div id="nav">
    		Registro de usuario
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
				
				if($row_datos['pago']=="si"){
					$pago = 'checked="true"'; 
				}else{
					$pago = ''; 
				}

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
    	<fieldset class="60per" style="-webkit-border-radius: 10px;"><legend style="color:#909090;font-weight: bold;">Fotografia de Inscrito</legend>
    	<table style="margin:auto;width:100%" border="0">
    	<tr>
		<td align="center">
		<img src="../paginas/camara/<?php echo $id_hermano;?>.jpg" >
		</td>		
		</tr>
    	</table>
    	</fieldset>
		<fieldset class="60per" style="-webkit-border-radius: 10px;"><legend style="color:#909090;font-weight: bold;">Informaci&oacute;n General</legend>
		<table style="margin:auto;width:100%">
        	<tr>
            	<td>Nombres:</td>
                <td>Apellidos:</td>
                <td>G&eacute;nero:</td>
                <td>Fecha de nacimiento:</td>
            </tr>
            <tr>
                <td><input type="text" name="nombres" id="nombres" value="<?php echo $nombres; ?>" class="textbox_white"  onkeypress="return validar_letras(event)" /></td>
                <td><input type="text" name="apellidos" id="apellidos" value="<?php echo $apellidos; ?>" class="textbox_white"   onkeypress="return validar_letras(event)" /></td>
                <td><div id="sexo" >
                <input type="radio" id="sexo1" name="sexo" value="m" <?php echo $sexo_mdato; ?> /><label for="sexo1">Hombre</label>
                <input type="radio" id="sexo2" name="sexo" value="f" <?php echo $sexo_fdato; ?> /><label for="sexo2">Mujer</label>
                </div>
            </td>
            <td><input type="date" name="f_nacimiento" id="f_nacimiento" value="<?php echo $f_nac; ?>" class="textbox_white"  /></td> 
            </tr>
            <tr><td><br /></td></tr>
            <tr>
            <td colspan="2">Direccion:</td>            
            </tr>
            <tr>
                <td colspan="2">
				<textarea name="direccion" id="direccion" cols="100" rows="10" class="textbox_white" style="font-size:12px;font-family:Arial;"><?php echo $direccion; ?></textarea>
				</td>                             
            </tr>
            <tr><td colspan="3"><br /></td></tr>
            <tr>
            	<td>Telefono:</td>
                <td>Celular:</td> 
				<td>Correo electr&oacute;nico:</td>       
            </tr>
            <tr>
                <td><input type="text" name="tel" id= "tel" value="<?php echo $telefono; ?>" class="textbox_white" required="required"  onkeypress="return validar_numeros(event)" /></td>
                <td><input type="text" name="cel" id= "cel" value="<?php echo $celular; ?>" class="textbox_white" required="required" onkeypress="return validar_numeros(event)" /></td>       				<td><input type="email" name="correo_electronico" size="25" value="<?php echo $correo; ?>" id="correo_electronico" class="textbox_white" required="required" placeholder="name@example.com" /></td>  
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
            <td>Ministerio:</td>
                <td>
                    <?php
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
				?>
                </td>
                <td>Otro: <input type="text" name="otromi" id="otromi" class="textbox_white" value="<?php echo $otromi;?>" placeholder="Ministerio" size="25" /></td>
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
                <td><input type="text" name="contacto1" id="contacto1" value="<?php echo html_entity_decode($contacto1); ?>" class="textbox_white"  onkeypress="return validar_letras(event)" /></td>
                <td>Parentesco:</td>
                <td><input type="text" name="parentesco1" id="parentesco1" value="<?php echo html_entity_decode($parentesco1); ?>" class="textbox_white" /></td>
                <td>Correo Electronico:</td>
                <td><input type="email" name="correo1" id="correo1" value="<?php echo $correo1; ?>" class="textbox_white"  placeholder="name@example.com" /></td>
            </tr>
            <tr>                <td>Telefono:</td>
                <td><input type="text" name="telefono1" id= "telefono1" value="<?php echo $telefono1;?>" class="textbox_white"   onkeypress="return validar_numeros(event)" /></td>
                <td>Celular:</td>
                <td><input type="text" name="celular1" id="celular1" value="<?php echo $celular1; ?>" class="textbox_white" onkeypress="return validar_numeros(event)"  /></td>
            </tr>
        </table>
        <br />
        <table style="margin:auto;width:100%">
            <tr>
            	<td>Nombre completo de contacto:</td>
                <td><input type="text" name="contacto2" id="contacto2" value="<?php echo html_entity_decode($contacto2); ?>" class="textbox_white"  onkeypress="return validar_letras(event)" /></td>
                <td>Parentesco:</td>
                <td><input type="text" name="parentesco2" id="parentesco2" value="<?php echo html_entity_decode($parentesco2); ?>" class="textbox_white" /></td>
                <td>Correo Electronico:</td>
                <td><input type="email" name="correo2" id="correo2" value="<?php echo $correo2; ?>" class="textbox_white"  placeholder="name@example.com" /></td>
            </tr>
            <tr>                <td>Telefono:</td>
                <td><input type="text" name="telefono2" id= "telefono2" value="<?php echo $telefono2; ?>" class="textbox_white"  onkeypress="return validar_numeros(event)" /></td>
                <td>Celular:</td>
                <td><input type="text" name="celular2" id="celular2" value="<?php echo $celular2; ?>" class="textbox_white"  onkeypress="return validar_numeros(event)"  /></td>
            </tr>
        </table>
        </fieldset>
	</form>
   	</div>
    <div id="foot_body">
    	<div id="esquina"></div>
    </div>
</div>
<?php include("../paginas/footer.php"); ?>
</body>
</html>
<?php
mysql_close();
}
else{
	echo("<META HTTP-EQUIV='Refresh' CONTENT='0; URL=http://jaa.host56.com/index.php'>");//env�o al usuario a la pag. de inicio 
	    exit();
}
?>