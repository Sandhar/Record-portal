<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard - Client area</title>
    <link rel="stylesheet" href="style.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    
<?php
require('db.php');
$y="";
if(isset($_GET['del']))
{
	$id=intval($_GET['del']);
    $query    = "SELECT * FROM `images` WHERE id='$id'";
        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        $logged_in_user = mysqli_fetch_assoc($result);
        $x = $logged_in_user ['img'];
        //echo $x;
        
//        $y= "upload/".$x;
//        echo $y;
      
        $field = explode(",", $x); 
        foreach ($field as $value){
            $y= "upload/".$value;
            //echo $y;
            unlink($y);
            
        }
    
    
    
	$adn1="delete from images where id=?";
	$stmt1= $con->prepare($adn1);
	$stmt1->bind_param(i,$id);
	$rs1=$stmt1->execute();
    

	if(rs1==true)
	{
       echo "<script>alert('tool has been successfully Deleted');</script>";
       
	}
   
}
 
?>  
    
    
<table> 
            <tr> 
                <th><b>ID</b></th>
                <th><b>images</b></th>
                <td><b>Action</b></td>
                
            </tr>
    
    <?php


//if(isset($_GET['id'])){
//    $id = $_GET['id'];
    //echo $id;
// SQL query to select data from database 
$sql = "SELECT * FROM images"; 
$result = $con->query($sql); 
$con->close();  

    foreach($result as $row) {
    
    ?>
    
   <tr > 
                <!--FETCHING DATA FROM EACH  
                    ROW OF EVERY COLUMN--> 
                <td ><?php echo $row['id'];?></td>
                <td >
                <?php $field = explode(",", $row['img']); foreach ($field as $value) :?>
                <a href="upload/<?php echo $value;?>"><img src="upload/<?php echo $value;?>" width="70" height="70" alt="img"></a> 
                <?php endforeach;?>
                </td>
                <td><a href="test2.php?del=<?php echo $row['id'];?>"> Delete</a></td>
       
       
    </tr>      

<?php   
}
?>
    </table>  
      
</body>
</html>