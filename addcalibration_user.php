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
<!--
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
-->
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
    <div class="left" id="tab"> <a id="naming" href="dashboard.php" target="_self" > Dashboard </a> <a id="naming" href="table.php" target="_self"> - Tool Listing </a> 
    </div>
    
    <?php
    //to connect to the database
    require('db.php');
    
    $date1 = $date2 = $date3= $id='';
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['submit'])) {
        
        $id=$_REQUEST['id'];  
        $datereceived = date('Y-m-d', strtotime($_REQUEST['datereceived']));
        $datecompleted = date('Y-m-d', strtotime($_REQUEST['datecompleted']));
        $nextdue = date('Y-m-d', strtotime($_REQUEST['nextdue']));
        $fileName = rand(1000,1000000).$_FILES['image']['name'];
        $filepath = "upload/".$fileName;
//    CHECKING DATA    echo 'Hello '.$filepath.'!';
        
    if($_FILES["image"]["error"] == 0){
        if(move_uploaded_file($_FILES["image"]["tmp_name"],"upload/".$fileName))
        {
        
        $query    = "INSERT into `calibration` (toolid,datereceived, datecompleted, nextdue, cert)
                     VALUES ('$id', '$datereceived', '$datecompleted', '$nextdue' , '$filepath')";
        $result   = mysqli_query($con, $query);
        if ($result) {
            echo "<div class='form'>
                  <p>Calibration Data Added successfully.</p><br/>
                  <p class='link'>Click here to <a href='table_user.php?id=<?php $type = $_GET['id']; echo $type;?>'><i>View List</i></a></p>
                  </div>";
                  exit();
        } else {
            echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  </div>";
        }
        
}

else{echo 'File not uploaded';}

}            
    
    else{
        
        $query    = "INSERT into `calibration` (toolid,datereceived, datecompleted, nextdue)
                     VALUES ('$id', '$datereceived', '$datecompleted', '$nextdue')";
        $result   = mysqli_query($con, $query);
        if ($result) {
            echo "<div class='form'>
                  <h3>Calibration Data Added successfully without certificate.</h3><br/>
                  <p class='link'>Click here to <a href='table.php'>View List</a></p>
                  </div>";
                  exit();
        } else {
            echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  </div>";
        }
        
        
        
    }
    }
        
?>
    
    <?php
// define variables and set to empty values

//$date1 = $date2 = $date3="";


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>    
    
<form method="post" class="form" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  
    <div>
            <h1 class="login-title">Add Calibration</h1>
        
        </div>
    
    Date Received : <input class="login-input" type="date" name="datereceived" value="<?php echo $date1;?>" placeholder="Date Received*" autofocus="true">
  
  <br><br>
    
     Date completed : <input class="login-input" type="date" name="datecompleted" value="<?php echo $date2;?>" placeholder="Date Completed" autofocus="true">
  <br><br>
    
    Next Due : <input class="login-input" type="date" name="nextdue" value="<?php echo $date3;?>" placeholder="Next Due" autofocus="true">
  
  <br><br>
    Calibration Certificate
    <input class="login-input" name="image" type="file" id="file">
    <br><br>
    
    
    <input type="hidden" id="id" name="id" value="<?php $id = $_GET['id']; echo $id;?>">
 


  <input type="submit" name="submit" value="Submit" class="login-button">  
</form>       
    
</body>
</html>

