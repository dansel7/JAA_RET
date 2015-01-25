<?php
error_reporting(0);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<!--META-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>JAA - Inicio</title>

<!--STYLESHEETS-->
<link href="diseno/css/style.css" rel="stylesheet" type="text/css" />

<!--SCRIPTS-->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>
<!--Slider-in icons-->
<script type="text/javascript">
$(document).ready(function() {
	$(".username").focus(function() {
		$(".user-icon").css("left","-48px");
	});
	$(".username").blur(function() {
		$(".user-icon").css("left","0px");
	});
	
	$(".password").focus(function() {
		$(".pass-icon").css("left","-48px");
	});
	$(".password").blur(function() {
		$(".pass-icon").css("left","0px");
	});
});
</script>

</head>
<body>

<!--WRAPPER-->
<div id="wrapper">

	<!--SLIDE-IN ICONS-->
    <div class="user-icon"></div>
    <div class="pass-icon"></div>
    <!--END SLIDE-IN ICONS-->

<!--LOGIN FORM-->
<form name="form" class="login-form" action="index.php" method="post">

	<!--HEADER-->
    <div class="header" style="background-image:url(diseno/img/bg_502.jpg);background-size:320px 300px">
        <center><img src="diseno/img/logo.png" style="margin-top:-110px">
        <!--TITLE--><h1>Jovenes con Alas de Aguila </h1></center><!--END TITLE-->
    <!--DESCRIPTION--><span>Ingresa tu correo electronico y password previamente registrados. </span><!--END DESCRIPTION-->
    </div>
    <!--END HEADER-->
	
	<!--CONTENT-->
    <div class="content" style="background-image:url(diseno/img/bg_502.jpg);background-size:300px 1px">
	<!--USERNAME--><input type="text" name="email" tabindex="1" class="input username" placeholder="Nombre de usuario" required /><!--END USERNAME-->
    <!--PASSWORD--><input type="password" name="password" tabindex="2" class="input password" placeholder="Password" required /><!--END PASSWORD-->
    </div>
    <!--END CONTENT-->
    
    <!--FOOTER-->
    <div class="footer" style="background-image:url(diseno/img/bg_502.jpg);background-size:320px 1px">
        <center><!--LOGIN BUTTON--><input style="float: center" type="submit" name="entrar" id="entrar" value="Login" class="button" /><!--END LOGIN BUTTON-->    </center>
    </div>
    <!--END FOOTER-->

</form>
<!--END LOGIN FORM-->

</div>
<!--END WRAPPER-->

<!--GRADIENT--><div class="gradient"></div><!--END GRADIENT-->

</body>
</html>
<?php
if(isset($_REQUEST['entrar'])){
include("class/conexion.php");
	$correo = $_POST['email'];
	$contrasena = $_POST['password'];	
	$res_correo="no";
	$res_contrasena="no";
	$id_usuario=0; $estado="";
	$consulta="SELECT id_usuario,correo,password,estado FROM usuarios where correo=\"".$correo."\" AND password=\"".$contrasena."\" LIMIT 1";

	$res=mysql_query($consulta);

while($row=mysql_fetch_array($res)){
		$res_correo=$row['correo'];
		$res_contrasena=$row['password'];
		$id_usuario=$row['id_usuario'];
		$estado=$row['estado'];
	}
	
if($correo==$res_correo && $contrasena==$res_contrasena && $id_usuario!=0){
		session_start();
		$_SESSION['user_jaa'] = $id_usuario;
		$ruta="";
		if($estado=="1"){
			$ruta="<META HTTP-EQUIV='Refresh' CONTENT='0; URL=paginas/index.php'>";
			echo $ruta;
		}
		else if($estado=="2"){
			$ruta="<META HTTP-EQUIV='Refresh' CONTENT='0; URL=admin/index.php'>";
			echo $ruta;
		}
		else if($estado=="3"){
			$ruta="<META HTTP-EQUIV='Refresh' CONTENT='0; URL=servidor/index.php'>";
			echo $ruta;
		}
		else{
			echo "<script>alert('No tiene permiso para ingresar')</script>";
			echo("<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php'>");
		}
}else{
		echo "<script>alert('Usuario o contrasena incorrectos')</script>";
}	
}
?>