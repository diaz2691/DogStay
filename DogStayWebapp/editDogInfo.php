
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
    <meta charset  = "utf-8"/>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet"><link href="assets/css/font-awesome.css" rel="stylesheet" />
</head>
    
<body >
	<a class="navbar-brand" href="table.php"><i class="fa fa-chevron-left "></i> Back </a>
	<br/><br/><br/>
<div class="container" id="formLength">
<form method="post" class="form-signin">
    
    Dog Name: <input class="form-control" type="text" name="dogName" value="<?=$result['dogName']?>"> <br />
    Breed: <input class="form-control" type="text" name="breed" value="<?=$result['breed']?>"> <br />
    Weight: <input class="form-control" type="text" name="weight" value="<?=$result['weight']?>"><br />
    Gender: <input class="form-control" type="text" name="gender" value="<?=$result['gender']?>"><br />
     <input type='hidden' name='dogId' value="<?=$_POST['dogId']?>">
    <input class="btn btn-lg btn-primary btn-block" type="submit" name="updateForm" value="Update!">
    
</form>
</div>
</body>
</html>