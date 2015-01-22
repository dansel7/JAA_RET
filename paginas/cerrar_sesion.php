<?php
	session_start();
	
	session_destroy(); // destruyo la sesi�n 
    header('Location: ../index.php');
    exit();
?>

?>