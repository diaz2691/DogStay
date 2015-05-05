
<?php
session_start();


if (!isset($_SESSION['ownerId'])){
    header("Location: logout.php");
}

if (isset($_SESSION['ownerId'])){
     
     require 'dbConnection.php';
     $dbConn = getConnection();
     
     $sql = "SELECT * FROM locations WHERE locationId = :locationId";
     $stmt = $dbConn -> prepare($sql);
     $stmt->execute(array(":locationId"=>$_POST['locationId']));
     $result = $stmt->fetch();
     
}

if (isset($_POST['updateForm'])) {  //the update form has been submitted
     
     $sql = "UPDATE locations
             SET address = :address,
             	    city = :city,
                    state = :state,
                    zipcode = :zipcode
             WHERE locationId = :locationId";
      $namedParameters = array();
      $namedParameters[":address"] = $_POST['address'];
	  $namedParameters[":city"] = $_POST['city'];
      $namedParameters[":state"] = $_POST['state'];
      $namedParameters[":zipcode"] = $_POST['zipcode'];    
      $namedParameters[":locationId"] = $_POST['locationId'];   
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
<div class="container">
<form method="post" class="form-signin">
    
    Street Address: <input class="form-control" type="text" name="address" value="<?=$result['address']?>"> <br />
    City: <input class="form-control" type="text" name="city" value="<?=$result['city']?>"> <br />
    State: <input class="form-control" type="text" name="state" value="<?=$result['state']?>"><br />
    Zip Code: <input class="form-control" type="text" name="zipcode" value="<?=$result['zipcode']?>"><br />
    
    <input class="btn btn-lg btn-primary btn-block" type="submit" name="updateForm" value="Update!">
    
</form>
</div>
</body>
</html>