<?php

include "./integrations/ansible.php";

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['startPrueba1'])){
    startPrueba1();
}

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['stopPrueba1'])){
    stopPrueba1();
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

$status = statusPrueba1(); //Comprobar estado de la maquina

printf("
<h2>VM Status: %s</h2>
<form action='servers.php' method='post'>
	<input type='submit' name='startPrueba1' value='Start'", $status);
	
if($status != "stopped") //Desactivar el boton en caso de que la maquina ya este encendida
	printf(" disabled"); 

printf("/>");

printf("
<input type='submit' name='stopPrueba1' value='Stop'");
	
if($status != "running") //Desactivar el boton en caso de que la maquina ya este apagada
	printf(" disabled"); 
printf("/>
</form>
");

printf("
</body>
</html>
");

?>