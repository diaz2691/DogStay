
<?php
session_start();
 
 require 'dbConnection.php';
 $dbConn = getConnection();

if (!isset($_SESSION['ownerId'])){
    header("Location: logout.php");
}

if (isset($_SESSION['ownerId'])){
    
     $sql = "SELECT * FROM dogs WHERE dogId = :dogId";
     $stmt = $dbConn -> prepare($sql);
     $stmt->execute(array(":dogId"=>$_POST['dogId']));
     $result = $stmt->fetch();
     
}

if (isset($_POST['updateForm'])) {  //the update form has been submitted
     
     $sql = "UPDATE dogs
             SET dogName = :dogName,
             	    breed = :breed,
                    weight = :weight,
                    gender = :gender
             WHERE dogId = :dogId";
      $namedParameters = array();
      $namedParameters[":dogName"] = $_POST['dogName'];
	  $namedParameters[":breed"] = $_POST['breed'];
      $namedParameters[":weight"] = $_POST['weight'];
      $namedParameters[":gender"] = $_POST['gender'];    
      $namedParameters[":dogId"] = $_POST['dogId'];   
      $stmt = $dbConn -> prepare($sql);
      $stmt->execute($namedParameters);
      //echo "Record has been updated! please refresh to show changes";
	  header("Location: table.php");
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Dog</title>
    <link rel="icon" href="img/favicon-paw.ico" type="img/x-icon">
    <meta charset  = "utf-8"/>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet"><link href="assets/css/font-awesome.css" rel="stylesheet" />
</head>
    
<body >
	<a class="navbar-brand" href="table.php"><i class="fa fa-chevron-left "></i> Back </a>
	<br/><br/><br/>
<div class="container" id="formLength">
	<center><h3 style="color: white"><i class="fa fa-paw "></i> Edit Your Dog's info</h3></center>
	<hr />
<form method="post" class="form-signin" style="font-size: 20px; color: white"> 
    Dog Name: <input class="form-control" type="text" name="dogName" value="<?=$result['dogName']?>">
    Breed: <input class="form-control" type="text" name="breed" value="<?=$result['breed']?>"> 
    Weight: <input class="form-control" type="text" name="weight" value="<?=$result['weight']?>">
    Gender: <input class="form-control" type="text" name="gender" value="<?=$result['gender']?>">
     <input type='hidden' name='dogId' value="<?=$_POST['dogId']?>"><br />
    <input class="btn btn-lg btn-primary btn-block" type="submit" name="updateForm" value="Update!">
    
</form>
</div>
</body>
</html>