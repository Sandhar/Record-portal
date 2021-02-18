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
        $username = stripslashes($_POST['username']);
        //escapes special characters in a string
        $email = stripslashes($_POST['email']);
        $type = stripslashes($_POST['customer']);
        // data checked echo 'Hi '.$img.'!';
        $ad="update users set username=?,email=?, type=? where id=?";
        $stmt= $con->prepare($ad);
        $stmt->bind_param('sssi',$username,$email,$type,$id);
        $stmt->execute();
        // $newId = $stmtins->insert_id;
        $stmt->close();
        echo "<script>alert('Data updated Successfully');</script>";    
    
}	
		    ?>
<style>
       .btn-primary {
    color: #fff;
    background-color: #008B8B!important;
    border-color: skyblue!important; 
}
.btn {
    display: inline-block;
    font-weight: 200;
    color: #212529;
    text-align: center;
    vertical-align: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-color: transparent;
    border: 1px solid transparent;
        border-top-color: transparent;
        border-right-color: transparent;
        border-bottom-color: transparent;
        border-left-color: transparent;
    padding: .175rem .55rem;
    font-size: 1rem;
    line-height: 1.0;
    border-radius: .15rem;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}
       </style>

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
    
    <h1> <br> Update User Info </h1>
     
    <h1>
     <button class="btn btn-primary" style="margin-left:300px;" > <a style="color: #fff"; href="reset-password.php?id=<?php $id = $_GET['id']; echo $id;?>"> Reset Password </a> </button> 
    </h1>

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
Username :<input class="login-input" type="text" name="username" value="<?php echo $row->username; ?>" required="required"/>
<br><br>
Email :<input class="login-input" type="email" name="email" value="<?php echo $row->email; ?>" required="required"/>
<br><br>
Customer :<input class="login-input" type="text" name="customer" value="<?php echo $row->type; ?>" required="required"/>
<br><br>


<input class="login-button" type="submit" name="update" value="Update"/>
<br><br>
    
</form>
<?php } ?>
   </div>
      
    
    
</body>
</html>