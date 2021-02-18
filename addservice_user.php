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
    $id="";
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['submit'])) {
        
        $id=$_REQUEST['id'];
        $datereceived = date('Y-m-d', strtotime($_REQUEST['datereceived']));
        $datecompleted = date('Y-m-d', strtotime($_REQUEST['datecompleted']));
        $jobnumber = stripslashes($_REQUEST['jobnumber']);
        $jobnumber = mysqli_real_escape_string($con, $jobnumber);
        $issue = stripslashes($_REQUEST['issue']);
        $issue = mysqli_real_escape_string($con, $issue);
        $fault = stripslashes($_REQUEST['fault']);
        $fault = mysqli_real_escape_string($con, $fault);
        $resolution = stripslashes($_REQUEST['resolution']);
        $resolution = mysqli_real_escape_string($con, $resolution);
        $fileName1 = $_FILES['image1']['name'].rand(1000,1000000);
        $filepath1 = "upload/".$fileName1;
        
        for($i=0; $i<count($_FILES['image2']['name']); $i++) { 

        //Get the temp file path 
        $tmpFilePath = $_FILES['image2']['tmp_name'][$i]; 

        //Make sure we have a filepath 
        if($tmpFilePath != ""){ 

            //save the filename 
            $shortname = $_FILES['image2']['name'][$i];

            //save the url and the file 
            $filePath = "upload/" .$_FILES['image2']['name'][$i]; 

            //Upload the file into the temp dir             
            if(move_uploaded_file($tmpFilePath, $filePath)) { $files[] = $shortname; 


            } 
        } 
    } 
        
 if(is_array($files) && move_uploaded_file($_FILES["image1"]["tmp_name"],"upload/".$fileName1)){ 
     
     
        $completeFileName = implode(',',$files);
        $query    = "INSERT into `service` (toolid,datereceived, datecompleted, jobnumber, issue, fault, resolution, cert, img)
                     VALUES ('$id', '$datereceived', '$datecompleted', '$jobnumber', '$issue', '$fault', '$resolution', '$filepath1', '$completeFileName')";
        $result   = mysqli_query($con, $query);
        if ($result) {
            echo "<div class='form'>
                  <p>Service Data Added successfully.</p><br/>
                  <p class='link'>Click here to <a href='table.php'><i>View List</i></a></p>
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
?>
    
    <?php

$date1=$date2 = $comment1 = $comment2 = $comment3 = $jobnumber ="";

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>    
    
<form method="post" class="form" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  
    <div>
            <h1 class="login-title">Add Service</h1>
        
        
        </div>
    <input class="login-input" type="text" name="jobnumber" value="<?php echo $jobnumber;?>" placeholder="Job number" autofocus="true">
    <br><br>
    
    Date Received : <input class="login-input" type="date" name="datereceived" value="<?php echo $date1;?>" placeholder="Date Received" autofocus="true">
    <br><br>
    
    Date completed : <input class="login-input" type="date" name="datecompleted" value="<?php echo $date2;?>" placeholder="Date Completed" autofocus="true">
    <br><br>    
    
    <textarea class="login-input" name="issue" rows="5" cols="40" placeholder="Issue Reported" autofocus="true"><?php echo $comment1;?></textarea>
    <br><br>
    
    <textarea class="login-input" name="fault" rows="5" cols="40" placeholder="Fault" autofocus="true"><?php echo $comment2;?></textarea>
    <br><br>
    
    <textarea class="login-input" name="resolution" rows="5" cols="40" placeholder="Resolution" autofocus="true"><?php echo $comment3;?></textarea>
    <br><br>
    
    Calibration Report
    <input class="login-input" name="image1" type="file" id="file1">
    <br><br>
    Upload Pictures
    <div class="login-input1">
    <input  name="image2[]" type="file" id="file2">
    <br>
    <input  name="image2[]" type="file" id="file2">
    <br>
    <input  name="image2[]" type="file" id="file2">
    <br>
    <input  name="image2[]" type="file" id="file2">
    </div>
    <br><br>
    
    
    
    <input type="hidden" id="id" name="id" value="<?php $id = $_GET['id']; echo $id;?>">
    
  <input type="submit" name="submit" value="Submit" class="login-button">  
</form>       
   
</body>
</html>
