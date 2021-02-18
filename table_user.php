<?php 
  //include auth_session.php file on all user panel pages
include("auth_session.php");
?>
<?php
require('db.php');

if(isset($_GET['del']))
{
	$id=intval($_GET['del']);
	$adn1="delete from tools where id=?";
    $adn2="delete from service where toolid=?";
    $adn3="delete from calibration where toolid=?";
	$stmt1= $con->prepare($adn1);
    $stmt2= $con->prepare($adn2);
    $stmt3= $con->prepare($adn3);
	$stmt1->bind_param(i,$id);
    $stmt2->bind_param(i,$id);
    $stmt3->bind_param(i,$id);
	$rs1=$stmt1->execute();
    $rs2=$stmt2->execute();
    $rs3=$stmt3->execute();
	if(rs1==true || rs2==true || rs3==true)
	{
       echo "<script>alert('tool has been successfully Deleted');</script>";
       echo "<script>window.open('table.php','_self')</script>";

       
        
	}
   //header('Location:table.php');
}
 
?>
<?php

require('db.php');
 
$type = $_GET['id'];
//echo $type;
// SQL query to select data from database 
$sql = "SELECT * FROM tools where customer='$type'"; 
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
    <div class="left" id="tab"> <a id="naming" href="dashboard_user.php" target="_self" > Dashboard </a> <a id="naming" href="table_user.php?id=<?php $type = $_GET['id']; echo $type;?>" target="_self"> - Tool Listing </a> 
    </div>
    
    
 <h1> <br><b>Tool Listing </h1>


<!-- Add tool and Excel button -->
<h2>
<link rel="stylesheet" type="text/css" href="button.css">
<div class="row">

  <div class="col">
  </div>
  <div class="col">
  <div class="btn-toolbar float-right">

     <button class="btn btn-primary" style="margin:5px;" style="" > <a style="color: #fff;" href="addtool_user.php?id=<?php $type = $_GET['id']; echo $type;?>"> Add Tool </a> </button>
  
    <button class="btn btn-primary" style="margin:5px;"> <a style="color: #fff;" href="DownloadExcel_user.php?id=<?php $type = $_GET['id']; echo $type;?>">  Excel Download </a>  </button>

  </div>
  </div>
</div>
</h2>
        <!-- TABLE CONSTRUCTION--> 
        <table id="tableMain"> 
            <tr> 
                <th><b>Customer</b></th>
                <th><b>Part number</b></th>
                <th><b>Serial number</b></th>
                <th><b>Assest number</b></th>
                <th><b>Last cal</b></th>
                <th><b>Description</b></th>
                <th><b>User Note</b></th> 
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
                <td ><?php echo $rows['customer'];?></td>
                <td ><?php echo $rows['partnumber'];?></td> 
                <td><?php echo $rows['serialnumber'];?></td> 
                <td><?php echo $rows['assestnumber'];?></td> 
                <td><?php echo $rows['caldate'];?></td> 
                <td><?php echo $rows['description'];?></td>
                <td><?php echo $rows['usernote'];?></td>
                <td><a href="toolinformation_user.php?id=<?php echo $rows['id'];?>&amp;cust=<?php $type = $_GET['id']; echo $type;?>">View</a></td>
                
            </tr> 
                
            <?php 
                } 
             ?> 
        </table> 
    

</body> 
  
</html> 