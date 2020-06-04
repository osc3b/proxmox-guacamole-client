<?php

/***************** LOGIN *******************/

session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){ //If not logged
    header("location: ./login_form/login.php");
    exit;
}

/********************************************/

include "./integrations/ansible.php";

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['startPrueba1'])){
    startVM("w10-simple-clone-" . $_SESSION["username"]);
}

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['stopPrueba1'])){
    stopVM("w10-simple-clone-" . $_SESSION["username"]);
}

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['clonePrueba1'])){
	cloneSimpleW10($_SESSION["username"]);
	sleep(2);
}

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['deletePrueba1'])){
    deleteVM("w10-simple-clone-" . $_SESSION["username"]);
}

printf("
<!DOCTYPE html>
<html>
	<head>
		<meta charset='UTF-8'>
		<title>Servers</title>
		<link rel='stylesheet' type='text/css' href='./style.css'>
	<head>
	<body>
");

$status = statusVM(); //Comprobar estado de la maquina

if($status == "absent")
	$status = "Not Created";

printf("
<form action='machine_prueba.php' method='post'>
	<span class='vmstatus'>VM Status: %s &nbsp&nbsp</span>
	<input type='submit' name='startPrueba1' value='Start'", $status);
	
if($status != "stopped") //Desactivar el boton en caso de que la maquina ya este encendida
	printf(" disabled"); 

printf("/>");

printf("
<input type='submit' name='stopPrueba1' value='Stop'");
	
if($status != "running") //Desactivar el boton en caso de que la maquina ya este apagada
	printf(" disabled"); 

printf("/>
");

printf("
<input type='submit' name='clonePrueba1' value='Create'");

if($status != "Not Created") //Desactivar el boton en caso de que la maquina ya este creada
	printf(" disabled"); 

printf("
/>");

printf("
<input type='submit' name='deletePrueba1' value='Delete'");

if($status == "Not Created") //Desactivar el boton en caso de que la maquina ya este creada
	printf(" disabled"); 

printf("
/>
</form>");

printf("
</body>
</html>
");

?>