<!DOCTYPE html>
<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
?>
<?php
require('db.php');
// Code for update data
$partnumber=$serialnumber=$assestnumber=$caldate=$description="";
if(isset($_POST['update']))
		{
		    $partnumber=$_POST['partnumber'];
			$serialnumber=$_POST['serialnumber'];
		    $assestnumber=$_POST['assestnumber'];
		    $caldate=$_POST['caldate'];
            $description=$_POST['description'];
		    $uid=$_GET['id'];
		$ad="update tools set partnumber=?,serialnumber=?,assestnumber=?,caldate=?,description=? where id=?";
        $stmt= $con->prepare($ad);
        $stmt->bind_param('sssssi',$partnumber,$serialnumber,$assestnumber,$caldate,$description,$uid);
          $stmt->execute();
         // $newId = $stmtins->insert_id;
          $stmt->close();	   
          echo "<script>alert('Data updated Successfully');</script>" ;
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
    
    
 <h1> <br> Update Tool Info </h1>  

    <div class="container2">
<?php 
   
    $id=$_GET['id'];
	$ret = "select * from tools where id=?";
	$stmt2 = $con->prepare($ret);
	$stmt2->bind_param('i',$id);
	$stmt2->execute();
	 $res=$stmt2->get_result();
	 $cnt=1;
	   while($row=$res->fetch_object())
	  {
	?>

<form name="stmt" method="post">



Partnumber :<input class="login-input" type="text" text-align name="partnumber" value="<?php echo $row->partnumber;?>" required="required" />
<br><br>
Serial number :&ensp;<input class="login-input" type="text" name="serialnumber" value="<?php echo $row->serialnumber;?>" required="required" />
<br><br>
Assest number : <input class="login-input" type="text" name="assestnumber" value="<?php echo $row->assestnumber; ?>" required="required" />
<br><br>
cal date :  &emsp;&emsp;<input class="login-input" type="date" name="caldate" value="<?php echo $row->caldate; ?>" required="required"/>
<br><br>
Description :  <textarea class="login-input" name="description" cols="30" rows="4" required="required"><?php echo $row->description; ?></textarea>
<br><br>

<input class="login-button" type="submit" name="update" value="Submit" />

    
</form>
<?php } ?>
   
    </div>
    
</body>
</html>