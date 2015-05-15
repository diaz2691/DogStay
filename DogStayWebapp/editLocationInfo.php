
<?php
session_start();

 
 require 'dbConnection.php';
 $dbConn = getConnection();
 
if (!isset($_SESSION['ownerId'])){
    header("Location: logout.php");
}

if (isset($_SESSION['ownerId'])){

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
                    zipcode = :zipcode,
                    price = :price,
                    dateIn = :dateIn,
                    dateOut = :dateOut
             WHERE locationId = :locationId";
      $namedParameters = array();
      $namedParameters[":address"] = $_POST['address'];
	  $namedParameters[":city"] = $_POST['city'];
      $namedParameters[":state"] = $_POST['state'];
      $namedParameters[":zipcode"] = $_POST['zipcode'];
	  $namedParameters[":price"] = $_POST['price'];  
	  $namedParameters[":dateIn"] = $_POST['dateIn'];  
	  $namedParameters[":dateOut"] = $_POST['dateOut'];      
      $namedParameters[":locationId"] = $_POST['locationId'];   
      $stmt = $dbConn->prepare($sql);
      $stmt->execute($namedParameters);
      //print_r($namedParameters);
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
<div class="container"  id="formLength">
	<center><h3 style="color: white"><i class="fa fa-map-marker "></i> Edit Your Location's info</h3></center>
	<hr/>
<form method="post" class="form-signin" style="font-size: 20px; color: white">
    
    Street Address: <input class="form-control" type="text" name="address" value="<?=$result['address']?>">
    City: <input class="form-control" type="text" name="city" value="<?=$result['city']?>"> 
    State: <input class="form-control" type="text" name="state" value="<?=$result['state']?>">
    Zip Code: <input class="form-control" type="text" name="zipcode" value="<?=$result['zipcode']?>">
    Price: <input class="form-control" type="text" name="price" value="<?=$result['price']?>">
    Date In: <input class="form-control" type="date" name="dateIn" value="<?=$result['dateIn']?>">
    Date Out: <input class="form-control" type="date" name="dateOut" value="<?=$result['dateOut']?>">
    <input type='hidden' name='locationId' value="<?=$_POST['locationId']?>"><br />
    <input class="btn btn-lg btn-primary btn-block" type="submit" name="updateForm" value="Update!">
    
</form>
</div>
</body>
</html>