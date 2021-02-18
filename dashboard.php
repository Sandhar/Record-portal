<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard - Client area</title>
    <link rel="stylesheet" href="style.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
</head>
<div class='header'>
    <div>
        <img class="left" src="bulma.png" width="300px" height="70px"; margin-left:10px; >
        </div>
        <div class="center">
        <h4> Service Record </h4>
        </div>
        <button class="topright1 logout-button" > <a style="color: #0062148a;" href="logout.php"> Logout <img src='logout.jpeg' alt="Logout" height="21" width="30"> </a> </button>
        <div class="topright" id="naming" ><?php echo ucfirst($_SESSION['username']); ?></div>
    </div>    
    <div class="left" id="tab"> <a id="naming" href="dashboard.php" target="_self" > Dashboard </a> </div>
    
    
    <div class="form">
        
        
        <button class="login-button"  onclick="calladdtool()">Add Tool</button><br><br>
        <button class="login-button" onclick="toolsListing()">Tool Listing</button><br><br>
        <button class="login-button" onclick="usertable()">Usertable</button><br><br>
<!--        class and location need to be changed above-->

<script>
function calladdtool() {
  location.replace("http://localhost/myphpproject/calibration/addtool.php")
}
    
function toolsListing() {
  location.replace("http://localhost/myphpproject/calibration/table.php")
}

function usertable() {
  location.replace("http://localhost/myphpproject/calibration/usertable.php")
}
    
function Logout() {
  location.replace("http://localhost/myphpproject/calibration/logout.php")
}


    
</script>
        
        
    </div>
</body>
</html>
