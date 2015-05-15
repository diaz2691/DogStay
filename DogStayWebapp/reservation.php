<?php
session_start();

 require 'dbConnection.php';
 $dbConn = getConnection();

 function getDogs($dbConn, $id) {
	$sql = "SELECT dogId, dogName FROM dogs WHERE ownerId = :ownerId";
	$stmt = $dbConn -> prepare($sql);
	$stmt -> execute(array(":ownerId" => $_SESSION['userId']));
	return $stmt -> fetchAll();
}
		 

if (isset($_SESSION['userId'])){
     echo "<style type='text/css'>
     		#signLog{
		   		display:none;
		    }
		   	#dogs{
		   		display:block;
		   	}
		   	#pro{
		   		display:none;
		   	}
		   </style>";
		   
	 $dogs = getDogs($dbConn);
     if(empty($dogs)){
     	echo "<style type='text/css'>
     		#signLog{
		   		display:none;
		    }
		   	#dogs{
		   		display:none;
		   	}
		   	#pro{
		   		display:block;
		   	}
		   </style>";
		
     }
}
else if(!isset($_SESSION['userId'])){
	echo "<style type='text/css'>
     		#signLog{
		   		display:block;
		    }
		   	#dogs{
		   		display:none;
		   	}#pro{
		   		display:none;
		   	}
		   </style>";
		   
}
if(isset($_POST['reserve'])){
	
	$sql = "INSERT INTO reservations (ownerId, clientId, dogId, price, dateIn, dateOut) VALUES (:ownerId, :clientId, :dogId, :price, :dateIn, :dateOut)";
     $stmt = $dbConn->prepare($sql);
     $stmt->execute(array(":ownerId" => $_SESSION['ownerId'],
     					   ":clientId" => $_SESSION['userId'],
                           ":dogId" => $_POST['usersDogs'],     
      					   ":price" => $_SESSION['price'],  
      					   ":dateIn" => $_SESSION['dateIn'],
						   ":dateOut" => $_SESSION['dateOut']));
	
	header("Location: profile.php");
}
if(isset($_POST['profile'])){
	$_SESSION['ownerId'] = $_SESSION['userId'];
	header("Location: profile.php");
}

	
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="img/favicon-paw.ico" type="img/x-icon">
    <title>Reservation</title>
    <meta charset  = "utf-8"/>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <link href="assets/css/font-awesome.css" rel="stylesheet"/>
    
</head>
    
<body >
	<a class="navbar-brand" href="logout.php"><i class="fa fa-chevron-left "></i> Home </a>
	<br/><br/><br/>
<div class="container"  id="formLength">
	<center><h3 style="color: white"><i class="fa fa-map-marker "></i></h3></center>
	<?php
	if(!isset($_SESSION['name'])){
		$_SESSION['name'] = $_POST['name'];
		$_SESSION['ownerId'] = $_POST['ownerId'];
		$_SESSION['price'] = $_POST['price'];
		$_SESSION['dateIn'] = $_POST['dateIn'];
		$_SESSION['dateOut'] = $_POST['dateOut'];
	}
	
	?>
	<table style="font-size: 20px; color: white">
		<tr><td>Owner:</td><td><?= $_SESSION['name'] ?></td></tr>
		<tr><td>Price:</td><td><?= $_SESSION['price'] ?></td></tr>
		<tr><td>Check In:</td><td><?= $_SESSION['dateIn'] ?></td></tr>
		<tr><td>Check Out:</td><td><?= $_SESSION['dateOut'] ?></td></tr>
	</table>
	<div id="pro">
		<br/><br/>
		<p style="font-size: 20px; color: white">Go to your profile to add dogs first!</p>
		<br/><br/>
		<form method="post" class="form-signin">
		    <input type="submit" class="btn btn-lg btn-primary btn-block" name="profile" value="Profile!">
		</form>
	</div>
	<br />
	<div id="dogs" >
		<form method="post">
			<font style="font-size: 20px; color: white">Choose a dog for this reservation:</font>
			<select name="usersDogs">
	        		<?php
	        		foreach ($dogs as $key) {
						echo "<option value='" . $key['dogId'] . "'>" .  $key['dogName'] . "</option>";
					}
	        		?>
	        </select>
		<br/><br/>
			<input class="btn btn-lg btn-primary btn-block" type="submit" name="reserve" value="Make Reservation!">
		</form>
	</div>
	
	<div id="signLog">
		<form action="signup.php" method="post">
			<input type='hidden' name='stay' value='2'> 
			<input type="hidden" name="name" value="<?= $_POST['name'] ?>">
			<input type="hidden" name="ownerId" value="<?= $_POST['ownerId'] ?>">
			<input type="hidden" name="price" value="<?= $_POST['price'] ?>">
			<input type="hidden" name="dateIn" value="<?= $_POST['dateIn'] ?>">
			<input type="hidden" name="dateOut" value="<?= $_POST['dateOut'] ?>">
			<button name = "signUp" class="btn btn-lg btn-primary btn-block" type="submit">sign up</button>
		</form>
		<br />
		<form action="login.php" method="post">
			<input type='hidden' name='stay' value='2'> 
			<input type="hidden" name="name" value="<?= $_POST['name'] ?>">
			<input type="hidden" name="ownerId" value="<?= $_POST['ownerId'] ?>">
			<input type="hidden" name="price" value="<?= $_POST['price'] ?>">
			<input type="hidden" name="dateIn" value="<?= $_POST['dateIn'] ?>">
			<input type="hidden" name="dateOut" value="<?= $_POST['dateOut'] ?>">
			<input class="btn btn-lg btn-primary btn-block" type="submit" name="login" value="login">
		</form>
	</div>
</div>

</body>
</html>
