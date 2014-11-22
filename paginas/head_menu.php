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
                                <div id="usuarios">
                                <ul id="nav1">
                                <li>
                                <table>
                                	<tr>
                                    	<td><img src="http://jaa.host56.com/diseno/img/star_32.png" /></td><td>USUARIOS</td>
                                     </tr>
                                </table>
                                <ul class="submenu" style="width:150px !important;">
                                	<li><a href="http://jaa.host56.com/paginas/nuevo_usuario.php">AGREGAR USUARIO</a></li>
                                    <li><a href="http://jaa.host56.com/paginas/index.php">BUSCAR USUARIO</a></li>
                                </ul>
                                </li>
                                </ul>
                                </div>
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