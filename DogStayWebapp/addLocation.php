<?php
session_start();

if (!isset($_SESSION['ownerId'])){
    header("Location: logout.php");
}

 if (isset($_POST['updateForm'])) {  //the update form has been submitted
     require 'dbConnection.php';
	 $dbConn = getConnection();
	 
     $sql = "INSERT INTO locations (address, city, state, zipcode, ownerId, price, dateIn, dateOut) VALUES (:address, :city, :state, :zipcode, :ownerId, :price, :dateIn, :dateOut)";
     $stmt = $dbConn->prepare($sql);
     $stmt->execute(array(":address" => $_POST['address'],
     					   ":city" => $_POST['city'],
                           ":state" => $_POST['state'],     
      					   ":zipcode" => $_POST['zipcode'],  
      					   ":ownerId" => $_SESSION['ownerId'],
						   ":price" => $_POST['price'],
						   ":dateIn" => $_POST['dateIn'],
						   ":dateOut" => $_POST['dateOut']));
      
	  header("Location: table.php");
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>locations</title>
    <meta charset  = "utf-8"/>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
</head>
    
<body >
	<a class="navbar-brand" href="table.php"><i class="fa fa-chevron-left "></i> Back </a>
	<br/><br/><br/>
<div class="container"  id="formLength">
	<center><h3 style="color: white"><i class="fa fa-map-marker "></i> Add Your Location</h3></center>
<form method="post" class="form-signin">
	<input class="form-control" type="text" name="address" placeholder="Street Address"> <br />
    <input class="form-control" type="text" name="city" placeholder="City"> <br />
   	<input class="form-control" type="text" name="state" placeholder="State"> <br />
    <input class="form-control" type="text" name="zipcode" placeholder="Zip Code"> <br />
    <input class="form-control" type="text" name="price" placeholder="Price"> <br />
    <input class="form-control" type="date" name="dateIn" placeholder="Check in"> <br />
    <input class="form-control" type="date" name="dateOut" placeholder="Check out"> <br />
    
    <input class="btn btn-lg btn-primary btn-block" type="submit" name="updateForm" value="Create!">
    
</form>
</div>
</body>
</html>