<?php

function searchIP($mac){
    $out = shell_exec("sudo ./searchIP.sh | fgrep '$mac'");
    $ip = substr($out, strpos($out, "192.168.1."), 13); //Filtra solo la IP de la salida
    return trim($ip);
}

function createConnectionw10($username, $ip){
    include "./integrations/dbConfig.php";
    $sql = "SELECT connection_id FROM guacamole_connection WHERE connection_name LIKE '%- $username'";
    $query = $mysqli->query($sql);
    if ($query === FALSE) { //Error
        echo "Could not successfully run query ($sql) from DB: " . $mysqli->error;
        exit;
    }
    $connectionid = $query->fetch_row()[0];

    $sql = "UPDATE guacamole_connection_parameter SET parameter_value='$ip' WHERE connection_id = '$connectionid' AND parameter_name = 'hostname'";
    $query = $mysqli->query($sql); //Update the IP of the machine in Guacamole
    if ($query === FALSE) { //Error
        echo "Could not successfully run query ($sql) from DB: " . $mysqli->error;
        exit;
    }		
}


?>