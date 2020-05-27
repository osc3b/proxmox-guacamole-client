<?php

function startPrueba1(){
    $out = shell_exec("/usr/bin/ansible-playbook /var/www/html/playbooks/pruebaStart.yml 2>&1");
    return $out; //. "<br><br><b>Máquina iniciada (o no), entrar a la máquina Windows en: <a href='http://84.125.210.39:3333/guacamole'>84.125.210.39:3333/guacamole</a></b>";
}

function stopPrueba1(){
    $out = shell_exec("/usr/bin/ansible-playbook /var/www/html/playbooks/pruebaStop.yml 2>&1");
    return $out;
}

function statusPrueba1(){
    $out = shell_exec("/usr/bin/ansible-playbook /var/www/html/playbooks/pruebaStatus.yml | grep msg");
    list($status) = sscanf(ltrim($out),'"msg": "%s'); //Filtrar el resultado para solo guardar el status
    $status = substr($status, 0, -1); //Quita unas comillas dobles al final
    return $status;
}

?>