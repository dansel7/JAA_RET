<?php session_start();
if(isset($_SESSION['user_jaa'])){
		$id_usuario=$_SESSION['user_jaa'];
		include("conexion.php");
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
$('element_to_pop_up').bPopup({
            content:'image', //'ajax', 'iframe' or 'image'
            contentContainer:'.content',
            loadUrl:'http://jaa.host56.com/paginas/camara/<?php echo $id_hermano;?>.jpg'
        });
</script>
</head>
<body>
<div id="contenedor_header">
<?php include("head_menu.php"); ?>
</div>
<div id="cuerpo">
	<div id="contenedor1">
		<div id="nav">
    		Listado de usuarios
    	</div>
        <div id="fecha">        	
        </div>
	</div>
    <div id="dash">
    <table id="lista_usuarios" align="center" cellpadding="10" cellspacing="0">
    	<tr class="tr_cabeza">
        	<td>USUARIO</td>
            <td>EDAD</td>
            <td>TELEFONO</td>
            <td>CELULAR</td>
            <td>TALLA</td>
            <td colspan="3" align="center">OPCIONES</td>            
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <?php
        include('conexion.php');
        $filtro="a";
        if(!isset($_GET['filtro'])){
			$filtro = $_GET['filtro'];
		}else{
			$filtro = $_GET['filtro'];
		}
        $consulta="SELECT * FROM hermanos WHERE nombres LIKE '$filtro%' ORDER BY edad ASC";
		$res=mysql_query($consulta);
		$nombreh="";
		$casos_totales=0;
		$id_hermano=0;
		while($row=mysql_fetch_array($res)){
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
					<tr class='tr_cuerpo'";?>onclick="location.href='<?php //echo $paso; ?>'"<?php echo ">
						<td>$nombreh</td>
						<td style='text-align: center;'>$edad</td>
						<td style='text-align: center;'>$telefono</td>
						<td style='text-align: center;'>$celular</td>
						<td style='text-align: center;'>$talla_camisa</td>
						<td style='text-align: center;'><a href='modificar_usuario.php?id=$id_hermano'><img src='../diseno/img/next.png' /></a></td>
						";
						$existe=0;
						//buscar hermano en tabla inscripcion
						$consulta_inscripcion = "SELECT id_hermano FROM inscripcion WHERE id_hermano=$id_hermano";
						$res_inscripcion=mysql_query($consulta_inscripcion);
						while($row_inscripcion=mysql_fetch_array($res_inscripcion)){
							$existe=$row_inscripcion['id_hermano'];
						}
						
						echo "<td style='text-align: center;' ><a href=\"#\" id=\"pop\" ><img src='../diseno/img/img.png' /></a></td>";	
						if($existe>0){
						echo "<td ><a href='impresion_usuario.php?id=$id_hermano' target='_blank'><img src='../diseno/img/pdf.png' /></a></td>";
						}
						echo "<td></td>
					</tr>
				";
				//ELIMINAR USUARIO
				//<td style='text-align: center;'><a href='eliminar_usuario.php?id=$id_hermano&iniciales=$iniciales'><img src='../diseno/img/close_16.png' /></a></td>
							}
	?>
	    </table>
   	</div>
    <div id="foot_body">
    	<div id="esquina"></div>
    </div>
</div>
<?php include("footer.php"); ?>
</body>
</html>
<?php 
mysql_close();
}else{
	//echo("<META HTTP-EQUIV='Refresh' CONTENT='0; URL=http://jaa.host56.com/index.php'>");//env?o al usuario a la pag. de inicio 
	    exit();
}
?>
