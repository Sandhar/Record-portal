<!DOCTYPE html>
<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
?>
<?php
require('db.php');
// Code for update data
$jobnumber=$datereceived=$datecompleted=$issue=$fault=$resolution=$img=$cert=$shortname="";
if(isset($_POST['update']))
		{
		
        
        $jobnumber=$_POST['jobnumber'];
        $datereceived = date('Y-m-d', strtotime($_POST['datereceived']));
        $datecompleted = date('Y-m-d', strtotime($_POST['datecompleted']));
        $issue=$_POST['issue'];
        $fault=$_POST['fault'];
        $resolution=$_POST['resolution'];
        $uid=$_GET['id'];
    
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
        
        
        if($_FILES["image1"]["error"] == 0)
        {  
            $fileName1 = rand(1000,1000000).$_FILES['image1']['name'];
            $filepath1 = "upload/".$fileName1;                        
        if($shortname != "" && move_uploaded_file($_FILES["image1"]["tmp_name"],"upload/".$fileName1))
{ 
        //echo "both!";
        $completeFileName = implode(',',$files);
        $ad="update service set jobnumber=?,datereceived=?,datecompleted=?,issue=?,fault=?,resolution=?,cert=?,img=? where sid=?";
        $stmt= $con->prepare($ad);
        $stmt->bind_param('ssssssssi',$jobnumber,$datereceived,$datecompleted,$issue,$fault,$resolution,$filepath1,$completeFileName,$uid);
        $stmt->execute();                    
        echo "<script>alert('Data updated Successfully');</script>" ;
        
       
                                
   }//both updates
            else{
                 //echo 'only cert!';
               
               $ad="update service set jobnumber=?,datereceived=?,datecompleted=?,issue=?,fault=?,resolution=?,cert=? where sid=?";
               $stmt= $con->prepare($ad);
               $stmt->bind_param('sssssssi',$jobnumber,$datereceived,$datecompleted,$issue,$fault,$resolution,$filepath1,$uid);
               $stmt->execute();
               // $newId = $stmtins->insert_id;
               $stmt->close();
        
               move_uploaded_file($_FILES["image1"]["tmp_name"],"upload/".$fileName1);
               echo "<script>alert('Data updated Successfully');</script>" ;
               
               
                }//only cert
            
            
}
else if($shortname != ""){  
        //echo 'only images!';       
        $completeFileName = implode(',',$files);
        $ad="update service set jobnumber=?,datereceived=?,datecompleted=?,issue=?,fault=?,resolution=?,img=? where sid=?";
               $stmt= $con->prepare($ad);
               $stmt->bind_param('sssssssi',$jobnumber,$datereceived,$datecompleted,$issue,$fault,$resolution,$completeFileName,$uid);
               $stmt->execute();
               // $newId = $stmtins->insert_id;
               $stmt->close();
        
               //move_uploaded_file($_FILES["image2"]["tmp_name"],"upload/".$fileName2);
               echo "<script>alert('Data updated Successfully');</script>" ;
             
 }//only images
else {    
               // echo 'nothing!';
               $ad="update service set jobnumber=?,datereceived=?,datecompleted=?,issue=?,fault=?,resolution=? where sid=?";
               $stmt= $con->prepare($ad);
               $stmt->bind_param('ssssssi',$jobnumber,$datereceived,$datecompleted,$issue,$fault,$resolution,$uid);
               $stmt->execute();
               // $newId = $stmtins->insert_id;
               $stmt->close();
               echo "<script>alert('Data updated Successfully');</script>" ;   
    }//nothing
    
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
    
    
 <h1> <br> Edit Service Info </h1>  

    <div class="container2"> 
      
<?php 
   
    $id=$_GET['id'];
	$ret = "select * from service where sid=?";
	$stmt2 = $con->prepare($ret);
	$stmt2->bind_param('i',$id);
	$stmt2->execute();
	 $res=$stmt2->get_result();
	 $cnt=1;
	   while($row=$res->fetch_object())
	  {
	?>

<form name="stmt" enctype="multipart/form-data" method="post">

Job Number:<input class="login-input" type="text" text-align name="jobnumber" value="<?php echo $row->jobnumber;?>" required="required" />
<br><br>
Date Received:<input class="login-input" type="date" name="datereceived" value="<?php echo $row->datereceived; ?>" required="required"/>
<br><br>
Date Completed:<input class="login-input" type="date" name="datecompleted" value="<?php echo $row->datecompleted; ?>" required="required"/>
<br><br>
Issue :<input class="login-input" type="text" text-align name="issue" value="<?php echo $row->issue;?>" required="required" />
<br><br>
Fault :<input class="login-input" type="text" text-align name="fault" value="<?php echo $row->fault;?>" required="required" />
<br><br>
Fault :<input class="login-input" type="text" text-align name="resolution" value="<?php echo $row->resolution;?>" required="required" />
<br><br>
Update Report:<input class="login-input" name="image1" type="file" id="file1"/>
    <a class="login-input" href="<?php echo $row->cert;?>"> Download Report</a>
    <br><br>
    <input type="hidden" id="cert" name="cert" value="<?php $cert = $row->cert; echo $cert;?>">
 Update Pictures
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
    Pictures:
    <?php $field = explode(",", $row->img); foreach ($field as $value) :?>
    <a href="upload/<?php echo $value;?>"><img src="upload/<?php echo $value;?>" width="70" height="70" alt="img"></a> 
    <?php endforeach;?>
                   

    <br><br>
<!--   <input type="hidden" id="img" name="img" value="<?php $img = $row->img; echo $img;?>">-->
    
<input class="login-button" type="submit" name="update" value="Submit" />

    
</form>
<?php } ?>
   </div>   
    
</body>
</html>