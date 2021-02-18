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
<body>
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
    
    <!-- Page Navigation  -->
    <div class="left" id="tab"> <a id="naming" href="dashboard.php" target="_self" > Dashboard </a> 
    </div>
    
    <div class="form">
        
        
       
        <button class="login-button" onclick="ToolsListing()">Tool Listing</button><br><br>
        <button class="login-button"  onclick="userinfo()">User Info</button><br><br>
        
<!--        class and location need to be changed above-->

<?php 
   
    require('db.php');
    $username=$_SESSION['username'];
	$ret = "select * from users where username=?";
	$stmt2 = $con->prepare($ret);
	$stmt2->bind_param('s',$username);
	$stmt2->execute();
    $res=$stmt2->get_result();
    $logged_in_user = mysqli_fetch_assoc($res);
    
	

?>        
        
        
<script>
function userinfo() {
  location.replace("http://localhost/myphpproject/calibration/update_userinfo_user.php?id=<?php echo $logged_in_user['id'];?>")
}
    
function ToolsListing() {
  location.replace("http://localhost/myphpproject/calibration/table_user.php?id=<?php echo $logged_in_user['type'];?>")
}

function Logout() {
  location.replace("http://localhost/myphpproject/calibration/logout.php")
}

    
</script>
        
        
    </div>
</body>
</html>
