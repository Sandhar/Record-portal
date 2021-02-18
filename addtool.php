<!DOCTYPE html>
<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard - Client area</title>
    <link rel="stylesheet" href="style.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
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
    <div class="left" id="tab"> <a id="naming" href="dashboard.php" target="_self" > Dashboard </a> <a id="naming" href="addtool.php" target="_self"> - Addtool </a> </div>

    <?php
    //to connect to the database
    require('db.php');
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['submit'])) {
        // removes backslashes
        $Pno = stripslashes($_REQUEST['Pno']);
        //escapes special characters in a string
        $Pno = mysqli_real_escape_string($con, $Pno);
        $serialno    = stripslashes($_REQUEST['serialno']);
        $serialno = mysqli_real_escape_string($con, $serialno);
        $assest = stripslashes($_REQUEST['assest']);
        $assest = mysqli_real_escape_string($con, $assest);
        $cust = stripslashes($_REQUEST['cust']);
        $cust = mysqli_real_escape_string($con, $cust);
        $lastcal = date('Y-m-d', strtotime($_REQUEST['lastcal']));
        //$lastcal = date("Y-m-d");
        $description = stripslashes($_REQUEST['description']);
        $description = mysqli_real_escape_string($con, $description);
        $query    = "INSERT into `tools` (customer, partnumber, serialnumber, assestnumber, caldate, description)
                     VALUES ('$cust','$Pno', '$serialno', '$assest', '$lastcal','$description')";
        $result   = mysqli_query($con, $query);
        if ($result) {
            echo "<div class='form'>
                  <p><b>Tool Added successfully.</p><br/>
                  <p class='link'>Click here to <a href='table.php'><i>View List</i></a></p>
                  <p class='link'>Click here to <a href='addtool.php'><i>Add Tool</i></a> again.</p>
                  </div>";
                  exit();
        } else {
            echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='addtool.php'>add tool</a> again.</p>
                  </div>";
        }
    }
?>
    
    <?php
// define variables and set to empty values
$nameErr = $emailErr = $websiteErr = "";
$name = $email = $gender = $comment = $website = $cust="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Part Number is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Serial number is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }
    
  if (empty($_POST["website"])) {
    $website = "";
  } else {
    $website = test_input($_POST["website"]);
    // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
      $websiteErr = "Invalid URL";
    }
  }

  if (empty($_POST["comment"])) {
    $comment = "";
  } else {
    $comment = test_input($_POST["comment"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>    
    
<form method="post" class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  
    <div>
            <h1 class="login-title">Add Details</h1>
        <p><span class="error">* required field</span></p>
        
        </div>
    
    <input class="login-input" type="text" name="cust" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" value="<?php echo $cust;?>" placeholder="Customer" autofocus="true">
    <span class="error"><?php echo $nameErr;?></span>
    <br><br>
    
    
    <input class="login-input" type="text" name="Pno" value="<?php echo $name;?>" placeholder="Part Number*" autofocus="true">
    <span class="error"><?php echo $nameErr;?></span>
    <br><br>
    
  
    <input class="login-input" type="text" name="serialno" value="<?php echo $email;?>" placeholder="Serial Number*" autofocus="true">
    <span class="error"><?php echo $emailErr;?></span>
    <br><br>
  
    <input class="login-input" type="text" name="assest" value="<?php echo $website;?>" placeholder="Assest Number" autofocus="true">
    <span class="error"><?php echo $websiteErr;?></span>
    <br><br>
    
    Last cal date : <input class="login-input" type="date" name="lastcal" value="<?php echo $website;?>" placeholder="Last Calibration Date" autofocus="true">
    <span class="error"><?php echo $websiteErr;?></span>
    <br><br>
    
   
  
    <textarea class="login-input" name="description" rows="5" cols="40" placeholder="Description" autofocus="true"><?php echo $comment;?></textarea>
    <br><br>
    
    
    <br><br>
    <input type="submit" name="submit" value="Submit" class="login-button">  

</form>       
       
   
</body>
</html>
