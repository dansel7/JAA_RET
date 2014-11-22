<?php 
if(isset($_SESSION['user_jaa'])){
		?>
			<header>
            	<div id="left_menu">
                	<div id="logo" onclick="location.href='http://jaa.host56.com/paginas/index.php'">
                    	JAA
                    </div>
                                        <div id="menu">
                    	<!--MENU-->
                        	<div id="menu_left">
                            	<div id="procesos">
                                <ul id="nav1">
                                <li>
                                <table>
                                	<tr>
                                    	<td><img src="../diseno/img/folder_32.png" /></td><td>GRUPOS</td>
                                     </tr>
                                </table>
                                <ul class="submenu" style="width:125px !important;">
                                	<li><a href="grupos.php">VER GRUPOS</a></li>
                                	<li><a href="asignacion.php?g=1">ASIGNAR NIÑOS</a></li>
                                	<li><a href="asignacion.php?g=2">ASIGNAR NIÑAS</a></li>
                                	li><a href="verificacion.php?g=1">SACAR NIÑOS</a></li>
                                	<li><a href="verificacion.php?g=2">SACAR NIÑAS</a></li>
                                </ul>
                                </li>
                                </ul>
                                </div>
                                <div id="usuarios">
                                <ul id="nav1">
                                <li>
                                <table>
                                	<tr>
                                    	<td><img src="../diseno/img/users_business_32.png" /></td><td>USUARIOS</td>
                                     </tr>
                                </table>
                                <ul class="submenu" style="width:150px !important;">
                                	<li><a href="servidores.php">VER SERVIDORES</a></li>
                                </ul>
                                </li>
                                </ul>
                                </div>
                            </div>
                            <div id="menu_right">
                            <ul id="nav1">
                                <li>
                            	<table>
                                	<tr>
                                    	<td><img src="../diseno/img/star_32.png" /></td><td>RETIROS</td>
                                     </tr>
                                </table>
                             <ul class="submenu" style="width:129px !important;">
                                	<li><a href="retiros.php">VER RETIROS</a></li>
                                </ul>
                                </li>
                                </ul>
                            </div>
                        <!-------->
                    </div>
                </div>
                <div id="right_menu">
                	<div id="usuario">
                    	<ul id="nav1">
                                <li>
                    	<table style="width:100%">
                        	<tr>
                            	<td></td>
                                <td><span class="nombre_usuario"><?php echo $nombres ?></span><br /></td>
                                <td><img src="http://jaa.host56.com/diseno/img/down.png" /></td>
                            </tr>
                        </table>
                        <ul class="submenu" style="width:195px !important;">
                        <li><a href="">PERFIL</a></li>
                        <li><a href="http://jaa.host56.com/paginas/reporte_listado.php">REPORTES</a></li>
                        <li><a href="http://jaa.host56.com/paginas/cerrar_sesion.php" style="color:#C1272D">CERRAR SESION</a></li>
                        </ul>
                        </li>
                        </ul>
                    </div>
                    
                </div>
            </header>
		<?php
	}else{
	echo("<META HTTP-EQUIV='Refresh' CONTENT='0; URL=http://jaa.host56.com/index.php'>");//env�o al usuario a la pag. de inicio 
    exit();
}
?>
</html>