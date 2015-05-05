
<?php
session_start();


if (!isset($_SESSION['ownerId'])){
    header("Location: logout.php");
}

if (isset($_SESSION['ownerId'])){
     
     require 'dbConnection.php';
     $dbConn = getConnection();
     
     $sql = "SELECT * FROM users WHERE userId = :userId";
     $stmt = $dbConn -> prepare($sql);
     $stmt->execute(array(":userId"=>$_SESSION['ownerId']));
     $result = $stmt->fetch();
     
}

if (isset($_POST['updateForm'])) {  //the update form has been submitted
     
     $sql = "UPDATE users
             SET fname = :fname,
             	    lname = :lname,
                    email = :email,
                    phone = :phone
             WHERE userId = :ownerId";
      $namedParameters = array();
      $namedParameters[":fname"] = $_POST['fname'];
	  $namedParameters[":lname"] = $_POST['lname'];
      $namedParameters[":email"] = $_POST['email'];
      $namedParameters[":phone"] = $_POST['phone'];    
      $namedParameters[":ownerId"] = $_SESSION['ownerId'];   
      $stmt = $dbConn -> prepare($sql);
      $stmt->execute($namedParameters);
      //echo "Record has been updated! please refresh to show changes";
	  header("Location: profile.php");
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
    <meta charset  = "utf-8"/>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
</head>
    
<body >
	<a class="navbar-brand" href="profile.php"><i class="fa fa-chevron-left "></i> Back </a>
	<br/><br/><br/>
<div class="container">
	<form method="post" class="form-signin">
	    
	    First Name: <input class="form-control" type="text" name="fname" value="<?=$result['fname']?>"> <br />
	    Last Name: <input class="form-control" type="text" name="lname" value="<?=$result['lname']?>"> <br />
	    email: <input class="form-control" type="text" name="email" value="<?=$result['email']?>"><br />
	    Phone: <input class="form-control" type="tel" name="phone" value="<?=$result['phone']?>"><br />
	    
	    <input class="btn btn-lg btn-primary btn-block" type="submit" name="updateForm" value="Update!">
	</form>
</div>
</body>
</html>