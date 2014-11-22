<?php session_start();
header("Content-Type: text/html;charset=utf-8");
if($_GET)
{
	$g=$_GET['g'];
}
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
			
if(isset($_REQUEST['cambiar_grupo'])){
	$grupo=$_POST['grupo'];
	$nchecks=15;
	for($i=1;$i<=$nchecks;$i++){
				$nombrech="herma$i";
       			if(!isset($_POST[$nombrech])){ 		
        			 //$modulo[$i] = "";	//NO se selecciono					
				}else{
					$id_hermano=$_POST[$nombrech];
					 //$modulo[$i] = 'Checked="true"';	//SI se selecciono	
					 $consulta_up= "UPDATE inscripcion SET id_grupo=$grupo WHERE id_hermano=$id_hermano";
					 if(mysql_query($consulta_up)){
						echo("<META HTTP-EQUIV='Refresh' CONTENT='0; URL=verificacion.php?g=$g'>");
					}				 
				}
			}
}
if(isset($_REQUEST['asignar_grupo'])){
	$grupo=$_POST['grupo'];
	$nchecks=15;
	for($i=1;$i<=$nchecks;$i++){
				$nombrech="herma$i";
       			if(!isset($_POST[$nombrech])){ 		
        			 //$modulo[$i] = "";	//NO se selecciono					
				}else{
					$id_hermano=$_POST[$nombrech];
					 //$modulo[$i] = 'Checked="true"';	//SI se selecciono	
					 $consulta_up= "UPDATE inscripcion SET id_grupo=$grupo WHERE id_hermano=$id_hermano";
					 if(mysql_query($consulta_up)){
							echo("<META HTTP-EQUIV='Refresh' CONTENT='0; URL=asignacion.php?g=$g'>");
					}				 
				}
			}
}
if(isset($_REQUEST['sacar_grupo'])){
	$nchecks=15;
	for($i=1;$i<=$nchecks;$i++){
				$nombrech="herma$i";
       			if(!isset($_POST[$nombrech])){ 		
        			 //$modulo[$i] = "";	//NO se selecciono					
				}else{
					$id_hermano=$_POST[$nombrech];
					 //$modulo[$i] = 'Checked="true"';	//SI se selecciono	
					 $consulta_up= "UPDATE inscripcion SET id_grupo='1' WHERE id_hermano=$id_hermano";
					 if(mysql_query($consulta_up)){
							echo("<META HTTP-EQUIV='Refresh' CONTENT='0; URL=verificacion.php?g=$g'>");
					}				 
				}
			}
}
}//fin de if
else{
	
}
?>