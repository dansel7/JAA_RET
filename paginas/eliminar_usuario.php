<?php
 $id_eliminar = $_GET['id'];
 $iniciales = $_GET['iniciales'];
 include('conexion.php');
 $consulta_eliminar="DELETE FROM hermanos WHERE id_hermano=$id_eliminar";
 if(mysql_query($consulta_eliminar)){
	echo("<META HTTP-EQUIV='Refresh' CONTENT='0; URL=listado_usuarios.php?iniciales=$iniciales'>");
}

?>