<!DOCTYPE html>
<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
?>
<?php
require('db.php');
// Code for update data
$usernote="";
if(isset($_POST['update']))
		{
		    
            $usernote=$_POST['usernote'];
		    $uid=$_GET['id'];
    
		$ad="update tools set usernote=? where id=?";
        $stmt= $con->prepare($ad);
        $stmt->bind_param('si',$usernote,$uid);
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
    <div class="left" id="tab"> <a id="naming" href="dashboard_user.php" target="_self" > Dashboard </a> <a id="naming" href="table_user.php?id=<?php $type = $_GET['cust']; echo $type;?>" target="_self"> - Tool Listing </a> 
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

Partnumber :<input class="login-input" type="text" text-align name="partnumber" value="<?php echo $row->partnumber;?>" readonly />
<br><br>

Add Note :  <textarea class="login-input" name="usernote" cols="30" rows="4" ><?php echo $row->usernote; ?></textarea>
<br><br>

<input class="login-button" type="submit" name="update" value="Submit" />

    
</form>
<?php } ?>
   
    </div>
    
</body>
</html>