<?php

include "./integrations/ansible.php";

session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){ //If not logged
    header("location: ./login_form/login.php");
    exit;
}

?>

<!DOCTYPE html>
<html>
<title>My Dashboard</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="./style.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
</style>
<body class="w3-light-grey">

<!-- Top container -->
<div class="w3-bar w3-top w3-black w3-large" style="z-index:4">
  <span class="w3-bar-item w3-left">
    Welcome, <?php echo $_SESSION["username"]; ?> - <a href="../login_form/logout.php">Logout</a>
  </span>
  <span class="w3-bar-item w3-right">VirtualMachines</span>
</div>

<!-- CONTENT -->
<div class="w3-main" style="margin-left:200px;margin-top:43px;margin-right:200px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> My Dashboard</b></h5>
  </header>

  <div class="w3-row-padding w3-margin-bottom">
    <div class="w3-quarter">
      <div class="w3-container w3-red w3-padding-16">
        <div class="w3-left"><i class="fa fa-comment w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>24</h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Machines ON</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-blue w3-padding-16">
        <div class="w3-left"><i class="fa fa-eye w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>76</h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Free Slots</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-teal w3-padding-16">
        <div class="w3-left"><i class="fa fa-share-alt w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>1</h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Your Available Slots</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-orange w3-text-white w3-padding-16">
        <div class="w3-left"><i class="fa fa-users w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>50</h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Users</h4>
      </div>
    </div>
  </div>

  <div class="w3-panel">
  <h5><i class="fa fa-laptop"></i> My machines</h5>
    <div class="w3-row-padding" style="margin:0 -16px">
      <div class="w3-container">
        <table class="w3-table w3-striped w3-white">
          <tr>
            <td><i class="fa fa-user w3-text-blue w3-large"></i>&nbsp;&nbsp; Windows 10 - RDP </td>
            <td><iframe src="./machine_prueba.php" height=60 width=100% style="border:none;"></iframe></td>
            <td><i>10 mins</i></td>
            <td><a href="http://0.0.0.0:3333/guacamole/" target="_blank">View</a></td>
          </tr>
          <tr>
            <td><i class="fa fa-user w3-text-red w3-large"></i>&nbsp;&nbsp; Debian 10 - VNC </td>
            <td><iframe src="" height=60 width=100% style="border:none;"></iframe></td>
            <td><i>Off</i></td>
            <td><a href="http://0.0.0.0:3333/guacamole/" target="_blank">View</a></td>
          </tr>
          <tr>
            <td><i class="fa fa-user w3-text-green w3-large"></i>&nbsp;&nbsp; Debian 10 - SSH </td>
            <td><iframe src="" height=60 width=100% style="border:none;"></iframe></td>
            <td><i>Off</i></td>
            <td><a href="http://0.0.0.0:3333/guacamole/" target="_blank">View</a></td>
          </tr>
          <tr>
            <td><i class="fa fa-user w3-text-yellow w3-large"></i>&nbsp;&nbsp; ... </td>
            <td><iframe src="" height=60 width=100% style="border:none;"></iframe></td>
            <td><i>Off</i></td>
            <td><a href="http://0.0.0.0:3333/guacamole/" target="_blank">View</a></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
  <hr>
  <div class="w3-container">
    <h5><i class="fa fa-bell"></i> Stats</h5>
    <p>Your Machines ON</p>
    <div class="w3-grey">
      <div class="w3-container w3-center w3-padding w3-green" style="width:25%">1/4</div>
    </div>

    <p>Your Machines Slots</p>
    <div class="w3-grey">
      <div class="w3-container w3-center w3-padding w3-orange" style="width:50%">2/4</div>
    </div>

    <p>Global Machines ON</p>
    <div class="w3-grey">
      <div class="w3-container w3-center w3-padding w3-red" style="width:75%">75%</div>
    </div>
  </div>
  <hr>

  <div class="w3-container">
  <br>

  <!-- Footer -->
  <footer class="w3-container w3-padding-16 w3-dark-grey">
    <h4>Made by Oscar Boronat.</h4>
    <p>Code available in GitHub: <a href="https://github.com/osc3b/proxmox-guacamole-client">https://github.com/osc3b/proxmox-guacamole-client</a></p>
    <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
  </footer>

  <!-- End page content -->
</div>

<script>
// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';
    overlayBg.style.display = "none";
  } else {
    mySidebar.style.display = 'block';
    overlayBg.style.display = "block";
  }
}

// Close the sidebar with the close button
function w3_close() {
  mySidebar.style.display = "none";
  overlayBg.style.display = "none";
}
</script>

</body>
</html>