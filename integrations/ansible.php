<?php

function startVM($vm){
    $out = shell_exec("/usr/bin/ansible-playbook /var/www/html/playbooks/startVM.yml --extra-vars " . 
        "'{\"vmname\":\"$vm\"}'" . " 2>&1");
    return $out; //. "<br><br><b>Máquina iniciada (o no), entrar a la máquina Windows en: <a href='http://84.125.210.39:3333/guacamole'>84.125.210.39:3333/guacamole</a></b>";
}

function stopVM($vm){
    $out = shell_exec("/usr/bin/ansible-playbook /var/www/html/playbooks/stopVM.yml --extra-vars " . 
        "'{\"vmname\":\"$vm\"}'" . " 2>&1");
    return $out;
}

function statusVM($vm){
    $out = shell_exec("/usr/bin/ansible-playbook /var/www/html/playbooks/statusVM.yml --extra-vars " . 
    "'{\"vmname\":\"$vm\"}'" . " 2>&1" . " | grep msg");
    list($status) = sscanf(ltrim($out),'"msg": "%s'); //Filtrar el resultado para solo guardar el status
    $status = substr($status, 0, -1); //Quita unas comillas dobles al final
    return $status;
}

function cloneSimpleW10($username){
    $vmid = rand(200,99999);
    $out = shell_exec("/usr/bin/ansible-playbook /var/www/html/playbooks/w10SimpleClone.yml --extra-vars " . 
        "'{\"username\":\"$username\",\"newvmid\":\"$vmid\"}'" . " 2>&1");
    //echo $out . "<br>";
    $msg = strstr($out, "\"msg\"");
    $msg = strstr($msg, '}', true); //Solo las variables que me interesan
    if($msg){
        $msg = substr($msg, 9, -3); //Quita el principio, dos espacios y el corchete
        $vars = explode(", ", $msg); //Guarda en un vector los datos de la VM
    }
    if(trim($vars[0]) == "false"){ //Si el comando se ha ejecutado correctamente
        $info["vmid"] = substr(trim($vars[1]), 1, -1);
        $info["mac"] = substr(trim($vars[2]), 1, -1);
        if($info["vmid"] != $vmid) //Si la VMID difiere
            return "IDERROR";
        else 
            return $info;
    }
    //echo $info["vmid"] . " MAC: " . $info["mac"];
    return "ERROR";
}

function deleteVM($vm){
    $out = shell_exec("/usr/bin/ansible-playbook /var/www/html/playbooks/deleteVM.yml --extra-vars " . 
        "'{\"vmname\":\"$vm\"}'" . " 2>&1");
    return $out;
}

?>