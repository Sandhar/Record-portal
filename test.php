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
    
    
    <?php
    //to connect to the database
    require('db.php');
    
    $img= $id='';
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['submit'])) {
        
        $id=$_REQUEST['id'];  
        
        for($i=0; $i<count($_FILES['image']['name']); $i++) { 

        //Get the temp file path 
        $tmpFilePath = $_FILES['image']['tmp_name'][$i]; 

        //Make sure we have a filepath 
        if($tmpFilePath != ""){ 

            //save the filename 
            $shortname = $_FILES['image']['name'][$i]; 

            //save the url and the file 
            $filePath = "upload/" .$_FILES['image']['name'][$i]; 
            
            //Upload the file into the temp dir             
            if(move_uploaded_file($tmpFilePath, $filePath)) { $files[] = $shortname; 


            } 
        } 
    } 

        
if(is_array($files)){ 
    
        $completeFileName = implode(',',$files);
//        echo $completeFileName;
        $query = "INSERT INTO images(id,img)VALUES('$id','$completeFileName')";
        $result   = mysqli_query($con, $query);
        echo 'File uploaded';
        
}
    

else{echo 'File not uploaded';}

}            
        
?>
 
    
<h1>
     <button class="btn btn-primary" style="margin-left:300px;" > <a style="color: #fff"; href="test2.php"> Images </a> </button> 
    </h1>
<form method="post" class="form2" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  
    <div>
            <h1 class="login-title">Add Details</h1>
        
        </div>
    
    <input class="login-input" type="text" name="id" value="<?php echo $id;?>" placeholder="ID" autofocus="true">
    <br><br>
    
    images
    <div class="login-input1">
    <input  name="image[]" type="file" id="file">
    <br>
    <input  name="image[]" type="file" id="file">
    <br>
    <input  name="image[]" type="file" id="file">
    <br>
    <input  name="image[]" type="file" id="file">
    </div>
    
  <input type="submit" name="submit" value="Submit" class="login-button">  
</form>       
    
</body>
</html>

