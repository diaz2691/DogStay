<?php
session_start();

if (!isset($_SESSION['ownerId'])){
    header("Location: logout.php");
}


 if (isset($_POST['updateForm'])) {  //the update form has been submitted
     require 'dbConnection.php';
	 $dbConn = getConnection();
	 
     $sql = "INSERT INTO dogs (dogName, breed, weight, gender, ownerId) VALUES (:dogName, :breed, :weight, :gender, :ownerId)";
     $stmt = $dbConn->prepare($sql);
     $stmt->execute(array(":dogName" => $_POST['dogName'],
     					   ":breed" => $_POST['breed'],
                           ":weight" => $_POST['weight'],     
      					   ":gender" => $_POST['gender'],  
      					   ":ownerId" => $_SESSION['ownerId']));
      
      //echo "Record has been updated! please refresh to show changes";
	  header("Location: table.php");
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Dogs</title>
    <link rel="icon" href="img/favicon-paw.ico" type="img/x-icon">
    <meta charset  = "utf-8"/>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet"><link href="assets/css/font-awesome.css" rel="stylesheet" />
</head>
    
<body >
	<a class="navbar-brand" href="table.php"><i class="fa fa-chevron-left "></i> Back </a>
	<br/><br/><br/>
<div class="container" id="formLength">
	<center><h3 style="color: white"><i class="fa fa-paw "></i> Add Your Dog</h3></center>
<form method="post" class="form-signin">
	<input class="form-control" type="text" name="dogName" placeholder="Dog's Name"> <br />
    <input class="form-control" type="text" name="breed" placeholder="Breed"> <br />
    <input class="form-control" type="text" name="weight" placeholder="Weight"> <br />
    <input class="form-control" type="text" name="gender" placeholder="Gender"> <br />
    
    <input type="submit" class="btn btn-lg btn-primary btn-block" name="updateForm" value="Create!">
    
</form>
</div>
</body>
</html>