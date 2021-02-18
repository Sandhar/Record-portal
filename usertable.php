<?php 
  //include auth_session.php file on all user panel pages
include("auth_session.php");
?>
<?php
require('db.php');

if(isset($_GET['del']))
{
	$id=intval($_GET['del']);
	$adn1="delete from users where id=?";
	$stmt1= $con->prepare($adn1);
	$stmt1->bind_param(i,$id);
	$rs1=$stmt1->execute();
	if(rs1==true)
	{
       echo "<script>alert('USer has been successfully Deleted');</script>";
       echo "<script>window.open('usertable.php','_self')</script>";  
        
	}
}
 
?>
<?php

require('db.php');
  
// SQL query to select data from database 
$sql = "SELECT * FROM users"; 
$result = $con->query($sql); 
$con->close();  
?> 
<!DOCTYPE html> 
<html lang="en"> 
  
<head> 
     <meta charset="utf-8">
    <link rel="stylesheet" href="style.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Table</title>
    
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
    <div class="left" id="tab"> <a id="naming" href="dashboard.php" target="_self" > Dashboard </a> <a id="naming" href="usertable.php" target="_self">  - User Table </a> 
    </div>

    
<!-- Add user button-->
 <h1> <br> User Table </h1>
<h2>
<link rel="stylesheet" type="text/css" href="button.css">
<div class="row">

  <div class="col">
  </div>
  <div class="col">
  <div class="btn-toolbar float-right">
    <button class="btn btn-primary" style="margin: 12px;" > <a style="color: #fff"; href="registration.php"> +ADD User </a> </button>  
  </div>
  </div>
</div>
</h2>       
        <!-- TABLE CONSTRUCTION--> 
        <table id="tableMain"> 
            <tr> 
                <th><b>User Name</b></th>
                <th><b>Email</b></th>
                <th><b>Customer Name</b></th>
                <td><b>Action</b></td>
            </tr> 
            <!-- PHP CODE TO FETCH DATA FROM ROWS--> 
            <?php   // LOOP TILL END OF DATA  
                while($rows=$result->fetch_assoc()) 
                { 
             ?>
            
            <tr > 
                <!--FETCHING DATA FROM EACH  
                    ROW OF EVERY COLUMN--> 
                <td ><?php echo $rows['username'];?></td> 
                <td><?php echo $rows['email'];?></td> 
                <td><?php echo $rows['type'];?></td> 
                <td><a href="update_userinfo.php?id=<?php echo $rows['id'];?>">Edit</a> || <a href="usertable.php?del=<?php echo $rows['id'];?>"> Delete</a></td>
            </tr> 
                
            <?php 
                } 
             ?> 
        </table> 
    

</body> 
  
</html> 