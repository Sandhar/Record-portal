<!DOCTYPE html>
<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
?>
<?php
require('db.php');
// Code for update data
$username=$id=$password=$email="";
if(isset($_POST['update']))
		{
        
        $id = $_GET['id'];
        $email = stripslashes($_POST['email']);
        $password = stripslashes($_POST['password']);
        $password = md5($password);
        // data checked echo 'Hi '.$img.'!';
        $ad="update users set password=? where id=?";
        $stmt= $con->prepare($ad);
        $stmt->bind_param('si',$password,$id);
        $stmt->execute();
        // $newId = $stmtins->insert_id;
        $stmt->close();
        echo "<script>alert('Password Reset Successfully');</script>";    
    
}	
		    ?>
<html>
    <head>
    <meta charset="utf-8">
    <title>Edit Tool</title>
    <link rel="stylesheet" href="style.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
<body>
<div class='header'>
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
    <div class="left" id="tab"> <a id="naming" href="dashboard.php" target="_self" > Dashboard </a> <a id="naming" href="usertable.php" target="_self"> - User Table </a>  
    </div>
    
    <h1> <br> Reset Password </h1>
       

    <div class="container2"> 
      
<?php 
   
    
    $id = $_GET['id'];
	$ret = "select * from users where id=?";
	$stmt2 = $con->prepare($ret);
	$stmt2->bind_param('s',$id);
	$stmt2->execute();
	 $res=$stmt2->get_result();
	 //$cnt=1;
	   while($row=$res->fetch_object())
	  {
	?>

<form name="stmt" enctype="multipart/form-data" method="post">

Email :<input class="login-input" type="email" name="email" value="<?php echo $row->email; ?>" readonly/>
<br><br>
<input type="password" class="login-input" name="password" placeholder="Password">

<input class="login-button" type="submit" name="update" value="Update"/>
<br><br>
    
</form>
<?php } ?>
   </div>
      
    
    
</body>
</html>