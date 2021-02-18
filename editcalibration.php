<!DOCTYPE html>
<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
?>
<?php
require('db.php');
// Code for update data
$datereceived=$datecompleted=$nextdue=$img="";
if(isset($_POST['update']))
		{
		
        
        $datereceived = date('Y-m-d', strtotime($_POST['datereceived']));
        $datecompleted = date('Y-m-d', strtotime($_POST['datecompleted']));
        $nextdue = date('Y-m-d', strtotime($_POST['nextdue']));
        $uid=$_GET['id'];
        $img = $_POST['img'];//old path if not updated
   // check if certificate  uploaded
    if($_FILES["image"]["error"] > 0){
        // data checked echo 'Hi '.$img.'!';
        $ad="update calibration set datereceived=?,datecompleted=?,nextdue=? where cid=?";
        $stmt= $con->prepare($ad);
        $stmt->bind_param('sssi',$datereceived,$datecompleted,$nextdue,$uid);
        $stmt->execute();
         // $newId = $stmtins->insert_id;
        $stmt->close();
        echo "<script>alert('Data updated Successfully');</script>";    
    }
    else
		{
       // data checked echo 'Hello '.$img.'!';
        $fileName = rand(1000,1000000).$_FILES['image']['name'];
        $filepath = "upload/".$fileName;
		$ad="update calibration set datereceived=?,datecompleted=?,nextdue=?,cert=? where cid=?";
        $stmt= $con->prepare($ad);
        $stmt->bind_param('ssssi',$datereceived,$datecompleted,$nextdue,$filepath,$uid);
        $stmt->execute();
         // $newId = $stmtins->insert_id;
          $stmt->close();	
    if(move_uploaded_file($_FILES["image"]["tmp_name"],"upload/".$fileName))
        {
          echo "<script>alert('Data updated Successfully');</script>" ;
        } 
    else {
            echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  </div>";
        }
        }

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
    
    
 <h1> <br> Edit Calibration Info </h1>  

    <div class="container2"> 
      
<?php 
   
    $id=$_GET['id'];
	$ret = "select * from calibration where cid=?";
	$stmt2 = $con->prepare($ret);
	$stmt2->bind_param('i',$id);
	$stmt2->execute();
	 $res=$stmt2->get_result();
	 $cnt=1;
	   while($row=$res->fetch_object())
	  {
	?>

<form name="stmt" enctype="multipart/form-data" method="post">
Date Received :<input class="login-input" type="date" name="datereceived" value="<?php echo $row->datereceived; ?>" required="required"/>
<br><br>
Date Completed :<input class="login-input" type="date" name="datecompleted" value="<?php echo $row->datecompleted; ?>" required="required"/>
<br><br>
Next Due Date:<input  class="login-input" type="date" name="nextdue" value="<?php echo $row->nextdue; ?>" required="required"/>
<br><br>

Update Certificate:<input class="login-input" name="image" type="file" id="file">
    <a class="login-input" href="<?php echo $row->cert;?>"> Download Certificate </a>
    <br><br><br> 
    <input type="hidden" id="img" name="img" value="<?php $img = $row->cert; echo $img;?>">

<input class="login-button" type="submit" name="update" value="Submit" />
<br><br>
    
</form>
<?php } ?>
   </div>
      
    
    
</body>
</html>