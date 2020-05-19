<?php include "dbConfig.php";

$msg = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST["name"];
	
	$sql = "SELECT password_salt FROM guacamole_user WHERE entity_id IN (SELECT entity_id FROM guacamole_entity WHERE name = '$name')";
	$query = $mysqli->query($sql); //Busca el salt del usuario
	if ($query->num_rows == 0) { //Si el usuario introducido no existe
		$msg = "Username and password do not match";
	}else{
		$salt = $query->fetch_row()[0];
	
		$password = $_POST["password"];
		$sql = "SELECT UNHEX(SHA2(CONCAT('$password', HEX('$salt')), 256))"; //Codifica la contraseña: Salt + SHA-256
		$query = $mysqli->query($sql);
		$password = $query->fetch_row()[0];

		if ($name == '' || $password == '') {
			$msg = "You must enter all fields";
		} else {
			$sql = "SELECT * FROM guacamole_user WHERE password_hash = '$password' AND entity_id IN (SELECT entity_id FROM guacamole_entity WHERE name = '$name')";
			$query = $mysqli->query($sql); //Comprueba si coinciden el usuario y contraseña

			if ($query === FALSE) { //Error
				echo "Could not successfully run query ($sql) from DB: " . $mysqli->error;
				exit;
			}

			if ($query->num_rows > 0) { //Contraseña y usuario coinciden
				
				$mysqli->close();
				header('Location: SIGUIENTE'); //Envia a la siguiente web
				exit;
			}
			$msg = "Username and password do not match";
		}
	}
	$mysqli->close();
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html" />
	<title>Login</title>
	<meta name="description" content="Login page"/>
	<meta name="keywords" content="login"/>
	<meta charset="UTF-8">
	<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
	<h1>Login</h1>
	<form name="frmregister"action="<?= $_SERVER['PHP_SELF'] ?>" method="post" >
		<table class="form" border="0">
			<tr>
			<td></td>
				<td style="color:red;">
				<?php echo $msg; ?></td>
			</tr> 
			<tr>
				<th><label for="name"><strong>Username:</strong></label></th>
				<td><input class="inp-text" name="name" id="name" type="text" size="30" /></td>
			</tr>
			<tr>
				<th><label for="name"><strong>Password:</strong></label></th>
				<td><input class="inp-text" name="password" id="password" type="password" size="30" /></td>
			</tr>
			<tr>
			<td></td>
				<td class="submit-button-right">
				<input class="send_btn" type="submit" value="Submit" alt="Submit" title="Submit" />
				
				<input class="send_btn" type="reset" value="Reset" alt="Reset" title="Reset" /></td>
			</tr>
		</table>
	</form>
</body>
</html>
