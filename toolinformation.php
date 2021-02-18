<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
?>
<!DOCTYPE html>
<!--for deleting calibration-->
<?php
require('db.php');

if(isset($_GET['del1']))
{
	$id=intval($_GET['del1']);
	$adn1="delete from calibration where cid=?";
	$stmt1= $con->prepare($adn1);
	$stmt1->bind_param(i,$id);
	$rs1=$stmt1->execute();
	if(rs1==true)
	{
       echo "<script>alert('Calibration has been successfully Deleted');</script>";
       echo "<script>window.open('table.php','_self')</script>";

       
        
	}
   //header('Location:table.php');
}
?>
<!--for deleting service-->
<?php
require('db.php');

if(isset($_GET['del2']))
{
	$id=intval($_GET['del2']);
	$adn1="delete from service where sid=?";
	$stmt1= $con->prepare($adn1);
	$stmt1->bind_param(i,$id);
	$rs1=$stmt1->execute();
   
	if(rs1==true)
	{
       echo "<script>alert('Service has been successfully Deleted');</script>";
       echo "<script>window.open('table.php','_self')</script>";

       
        
	}
   //header('Location:table.php');
}
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
    
    <h1> <br> Tool Information </h1>
        <table id="tableMain"> 
            <tr>
                <th><b>Customer</b></th>
                <th><b>Part number</b></th>
                <th><b>Serial number</b></th>
                <th><b>Assest number</b></th>
                <th><b>Last cal</b></th>
                <th><b>Description</b></th>
                <th><b>User Note</b></th>
                <th><b>Action</b></th> 
            </tr> 
    <?php
    require('db.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];
    //echo $x;
// SQL query to select data from database 
$sql = "SELECT * FROM tools where id='$id'"; 
$result = $con->query($sql); 
$con->close();  

    foreach($result as $row) {
     //Printing data
        ?>
       
    <tr > 
                <!--FETCHING DATA FROM EACH  
                    ROW OF EVERY COLUMN-->
                <td ><?php echo $row['customer'];?></td>
                <td ><?php echo $row['partnumber'];?></td> 
                <td><?php echo $row['serialnumber'];?></td> 
                <td><?php echo $row['assestnumber'];?></td> 
                <td><?php echo $row['caldate'];?></td> 
                <td><?php echo $row['description'];?></td>
                <td><?php echo $row['usernote'];?></td>
                <td><a href="edit.php?id=<?php echo $row['id'];?>">Edit</a></td>
    </tr> 
<?php
}
}
?>
 </table> 

<!-- Button add calibration    -->
<h1> <br> Calibartion Data </h1>
<h2>
<link rel="stylesheet" type="text/css" href="button.css">
<div class="row">

  <div class="col">
  </div>
  <div class="col">
  <div class="btn-toolbar float-right">
    <button class="btn btn-primary" style="margin: 12px;" > <a style="color: #fff"; href="addcalibration.php?id=<?php $id = $_GET['id']; echo $id;?>"> +ADD Calibration </a> </button>  
  </div>
  </div>
</div>
</h2>  
<!--    table started-->
    <table> 
            <tr> 
                <th><b>Date Received</b></th>
                <th><b>Date Completes</b></th>
                <th><b>Next Due</b></th>
                <th><b>Calibration Certificate</b></th>
                <td><b>Action</b></td>
            </tr>
      
    <?php
    require('db.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];
    //echo $id;
// SQL query to select data from database 
$sql = "SELECT * FROM calibration where toolid='$id' ORDER BY timestmp DESC"; 
$result = $con->query($sql); 
$con->close();  

    foreach($result as $row) {
        ?>
   <tr > 
                <!--FETCHING DATA FROM EACH  
                    ROW OF EVERY COLUMN--> 
                <td ><?php echo $row['datereceived'];?></td> 
                <td><?php echo $row['datecompleted'];?></td> 
                <td><?php echo $row['nextdue'];?></td> 
                <td><a href="<?php echo $row['cert'];?>"> Download Certificate </a></td>
                <td><a href="editcalibration.php?id=<?php echo $row['cid'];?>">Edit</a> || <a href="toolinformation.php?del1=<?php echo $row['cid'];?>"> Delete</a></td>
                                              
    </tr>   

<?php
}
}
?>
 </table>        
    
<!--    service data-->
    
    
    <h1> <br> Service Data </h1>
     <h2>
<link rel="stylesheet" type="text/css" href="button.css">
<div class="row">

  <div class="col">
  </div>
  <div class="col">
  <div class="btn-toolbar float-right">
    <button class="btn btn-primary" style="margin: 12px;" > <a style="color: #fff"; href="addservice.php?id=<?php $id = $_GET['id']; echo $id;?>"> +ADD Service </a> </button>  
  </div>
  </div>
</div>
</h2>
     
    <table id="tableMain"> 
            <tr> 
                <th><b>Job Number</b></th>
                <th><b>Date Received</b></th>
                <th><b>Date Completes</b></th>
                <th><b>Issue</b></th>
                <th><b>Fault</b></th>
                <th><b>Resolution</b></th>
                <th><b>Calibration Report</b></th>
                <th><b>Picture</b></th>
                <td><b>Action</b></td>
                
            </tr>
    
    <?php
    require('db.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];
    //echo $id;
// SQL query to select data from database 
$sql = "SELECT * FROM service where toolid='$id' ORDER BY timestamp DESC"; 
$result = $con->query($sql); 
$con->close();  

    foreach($result as $row) {
    
    ?>
    
   <tr > 
                <!--FETCHING DATA FROM EACH  
                    ROW OF EVERY COLUMN--> 
                <td ><?php echo $row['jobnumber'];?></td>
                <td ><?php echo $row['datereceived'];?></td> 
                <td><?php echo $row['datecompleted'];?></td> 
                <td><?php echo $row['issue'];?></td> 
                <td><?php echo $row['fault'];?></td>
                <td><?php echo $row['resolution'];?></td>
                <td><a href="<?php echo $row['cert'];?>"> Download Report </a></td>
                <td >
                <?php $field = explode(",", $row['img']); foreach ($field as $value) :?>
                <a href="upload/<?php echo $value;?>"><img src="upload/<?php echo $value;?>" width="70" height="70" alt="img"></a> 
                <?php endforeach;?>
                </td>
                <td><a href="editservice.php?id=<?php echo $row['sid'];?>">Edit</a> || <a href="toolinformation.php?del2=<?php echo $row['sid'];?>"> Delete</a></td>
       
       
    </tr>      

<?php   
}
}
?>
    </table>  
    
    
</body>
</html>
