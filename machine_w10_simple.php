<?php

/***************** LOGIN *******************/

session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){ //If not logged
    header("location: ./login_form/login.php");
    exit;
}

/********************************************/

include "./integrations/ansible.php";
include "./integrations/guacamole.php";

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

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['startPrueba1'])){ //START
    if(startVM("w10-simple-clone-" . $_SESSION["username"])){
		$_SESSION["ons"]++;
		sleep(15);
		$ip = NULL;
		while(!$ip)
			$ip = searchIP($_SESSION["w10mac"]); //Search for the IP associated to the mac
		//echo "IP:" . $ip;
		createConnectionw10($_SESSION["username"], $ip); //Create the Guacamole connection in the database
	}else{
		printf("<script>alert('Error starting the machine: The Server was busy. Try again later.');</script>");
	}
}

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['stopPrueba1'])){ //STOP
    if(stopVM("w10-simple-clone-" . $_SESSION["username"])){
		$_SESSION["ons"]--;
	}else{
		printf("<script>alert('Error stopping the machine: The Server was busy. Try again later.');</script>");
	}
}

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['clonePrueba1'])){ //CREATE
	$info = cloneSimpleW10($_SESSION["username"]);
	if(count($info) == 2){ //The machine have been created successfully
		sleep(4);
		if(!isset($_SESSION['timeStartedW10'])){
			//Store the timestamp of when the countdown began.
			$_SESSION['timeStartedW10'] = time();
			$_SESSION["slots"]--;
			$_SESSION["w10mac"] = $info["mac"];
		}
		printf("<script>window.top.location = window.top.location.href;</script>"); //Reload the main page
	}else{
		printf("<script>alert('Error creating the machine: The Server was busy. Try again later.');</script>");
	}
}

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['deletePrueba1'])){ //STOP
	deleteVM("w10-simple-clone-" . $_SESSION["username"]);
	if(isset($_SESSION['timeStartedW10'])){
		unset($_SESSION['timeStartedW10']);
		$_SESSION["slots"]++;
	}
	printf("<script>window.top.location = window.top.location.href;</script>"); //Reload the main page
}

$status = statusVM("w10-simple-clone-" . $_SESSION["username"]); //Comprobar estado de la maquina

if($status == "absent")
	$status = "Not Created";

if($status == "stopped")
	$status = "Off";

if($status == "running")
	$status = "Running";

printf("
<form action='machine_w10_simple.php' method='post' id='formw10'>
	<span class='vmstatus'>VM Status: %s &nbsp&nbsp</span>
	<input type='submit' name='startPrueba1' value='Start'", $status);
	
if($status != "Off") //Desactivar el boton en caso de que la maquina ya este encendida
	printf(" disabled"); 

printf("/>");

printf("
<input type='submit' name='stopPrueba1' value='Stop'");
	
if($status != "Running") //Desactivar el boton en caso de que la maquina ya este apagada
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

if($status == "Not Created" || $status == "Running") //Desactivar el boton en caso de que la maquina ya este creada
	printf(" disabled"); 

printf("
/>
</form>");

printf("
</body>
</html>
");

?>