<?php

session_start(); // Initialize the session
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ./login_form/login.php");
    exit;
}
?>