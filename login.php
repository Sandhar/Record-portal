<!DOCTYPE html>
<html>
<head>
    
    <meta charset="utf-8"/>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
    <div class='header'>
    <div>
        <img class="left" src="bulma.png" width="300px" height="70px"; margin-left:10px; >
        </div>
        <div class="center">
        <h4> Service Record </h4>
        </div>
        
 
    </div>   
<?php
    require('db.php');
    session_start();
    // When form submitted, check and create user session.
    if (isset($_POST['username'])) {
        $username = stripslashes($_REQUEST['username']);    // removes backslashes
        $username = mysqli_real_escape_string($con, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        // Check user is exist in the database
        $query    = "SELECT * FROM `users` WHERE username='$username'
                     AND password='" . md5($password) . "'";
        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $logged_in_user = mysqli_fetch_assoc($result);
            
            if ($logged_in_user['type'] == 'ADMIN') {

				$_SESSION['username'] = $username;
				$_SESSION['success']  = "You are now logged in";
				header('location: dashboard.php');		  
			}else{
				$_SESSION['username'] = $username;
				$_SESSION['success']  = "You are now logged in";

				header('location: dashboard_user.php');
			}         
//            $_SESSION['username'] = $username;
//            // Redirect to user dashboard page
//            header("Location: dashboard.php");
        } else {
            echo "<div class='form'>
                  <h3>Incorrect Username/password.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                  </div>";
        }   
    } else {
?>
    <form class="form" method="post" name="login">
        <div>
            <h1 class="login-title">Login</h1>
        
        </div>
        
        <input type="text" class="login-input" name="username" placeholder="Username" autofocus="true"/>
        <input type="password" class="login-input" name="password" placeholder="Password"/>
        <input type="submit" value="Login" name="submit" class="login-button"/>
  </form>
<?php
    }
?>
</body>
</html>
