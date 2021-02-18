<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Forget Password</title>
    <link rel="stylesheet" href="style.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <div class='header'>
    <div>
        <img class="left" src="bulma.png" width="200px" height="55px"; margin-left:10px; >
        </div>
        <div class="center">
        <p>Service Record</p>
        </div>
    </div> 
<?php
include('db.php');
if(isset($_POST["email"]) && (!empty($_POST["email"]))){
$email = $_POST["email"];
echo $email;
if (!$email) {
  	$error .="<p>Invalid email address please type a valid email address!</p>";
	}
else{
	$sel_query = "SELECT * FROM `users` WHERE email='".$email."'";
	$results = mysqli_query($con,$sel_query);
	$row = mysqli_num_rows($results);
    echo $email;
	if ($row==""){
		echo "<p>No user is registered with this email address!</p>";
		}
    else{
        
          header('Location: http://localhost/myphpproject/calibration/reset-password.php');
    }
	}
//if($error!=""){
//        
//        header('Location: http://localhost/myphpproject/calibration/reset-password.php');
//        
//    }
        
}  else {
?>
    <form class="form" action="" method="post">
        <h1 class="login-title">ForgetPassword</h1>
        <label><strong>Enter Your Email Address:</strong></label><br /><br />
        <input type="email" name="email" placeholder="username@email.com" />
        <br /><br />
        <input type="submit" value="Reset Password"/>
        
    </form>
<?php
    }
?>
</body>
</html>
