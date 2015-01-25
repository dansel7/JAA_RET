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
//para paginacion
$per_page = 15; 
$genero=" ";
if($_GET)
{
$g=$_GET['g'];
	if($g==1){
		$genero=" AND hermanos.genero='m' ";
	}else{
		$genero=" AND hermanos.genero='f' ";
	}
}
//getting number of rows and calculating no of pages
$sql = "SELECT inscripcion.pago, inscripcion.id_grupo, hermanos.id_hermano, hermanos.nombres, hermanos.apellidos, hermanos.edad, hermanos.telefono, hermanos.celular, hermanos.talla FROM hermanos INNER JOIN inscripcion ON inscripcion.id_hermano=hermanos.id_hermano WHERE inscripcion.id_grupo<>1 ".$genero." AND inscripcion.pago='si' ORDER BY id_grupo ASC";
$rsd = mysql_query($sql);
$count = mysql_num_rows($rsd);
$pages = ceil($count/$per_page)
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
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){		
	//Hide Loading Image
	function Hide_Load()
	{
		$("#loading").fadeOut('slow');
	};
   //Default Starting Page Results
	$("#pagination li:first").css({'color' : '#FF0084'}).css({'border' : 'none'});
	$("#content").load("paginas/pagination_data2.php?page=1&g=<?php echo $_GET['g']?>", Hide_Load());



	//Pagination Click
	$("#pagination li").click(function(){		
		//CSS Styles
		$("#pagination li")
		.css({'border' : 'solid #dddddd 1px'})
		.css({'color' : '#0063DC'});
		
		$(this)
		.css({'color' : '#FF0084'})
		.css({'border' : 'none'});

		//Loading Data
		var pageNum = this.id;
		
		$("#content").load("paginas/pagination_data2.php?page=" + pageNum, Hide_Load()+"&g=<?php echo $_GET['g']?>");
	});
	
	
});

function marcar(source) 
	{
		checkboxes=document.getElementsByTagName('input'); //obtenemos todos los controles del tipo Input
		for(i=0;i<checkboxes.length;i++) //recoremos todos los controles
		{
			if(checkboxes[i].type == "checkbox") //solo si es un checkbox entramos
			{
				checkboxes[i].checked=source.checked; //si es un checkbox le damos el valor del checkbox que lo llamó (Marcar/Desmarcar Todos)
			}
		}
	}
	</script>
<style>
#loading { 
width: 100%; 
position: absolute;
}

#pagination
{
text-align:center;
margin-left:120px;

}
</style>
<script type="text/javascript">
$(function(){
	$('#nav1 li').hover(
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
</head>
<body>
<div id="contenedor_header">
<?php include("paginas/head_menu.php"); ?>
</div>
<div id="cuerpo">
	<div id="contenedor1">
		<div id="nav">
    		VERIFICANDO INSCRITOS A GRUPOS
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
    <fieldset><legend><center>
     <input type="checkbox" onclick="marcar(this);" /> Marcar/Desmarcar Todos
                </center>
                </legend>
        </fieldset>
	<div id="content" ></div>
	<table width="800px" align="center">
	<tr><td>
			<ul id="pagination">
				<?php
				//Show page links
				for($i=1; $i<=$pages; $i++)
				{
					echo '<li style="float: left; cursor: pointer;" id="'.$i.'"> Pag'.$i.' &nbsp;</li>';
				}
				?>
	</ul>	
	</td></tr></table><br><br><br><br><br>
	</div>
<?php include("../paginas/footer.php"); ?>
</body>
</html>
<?php 
mysql_close();
}
?>