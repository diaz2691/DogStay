<?php
session_start();

require 'dbConnection.php';
$dbConn = getConnection();

function getDogs($dbConn) {
	$sql = "SELECT dogId, dogName, breed, weight, gender FROM dogs WHERE ownerId = :ownerId";
	$stmt = $dbConn -> prepare($sql);
	$stmt -> execute(array(":ownerId" => $_SESSION['ownerId']));
	return $stmt -> fetchAll();
}

function getLocations($dbConn) {
	$sql = "SELECT address, city, state, zipcode, price, dateIn, dateOut, locationId FROM locations WHERE ownerId = :ownerId";
	$stmt = $dbConn -> prepare($sql);
	$stmt -> execute(array(":ownerId" => $_SESSION['ownerId']));
	return $stmt -> fetchAll();
}

function getReservationsClient($dbConn) {
	$sql = "SELECT reservationId, ownerId, clientId, dogId, price, dateIn, dateOut FROM reservations WHERE clientId = :ownerId";
	$stmt = $dbConn -> prepare($sql);
	$stmt -> execute(array(":ownerId" => $_SESSION['ownerId']));
	return $stmt -> fetchAll();
}

function getReservationsOwner($dbConn) {
	$sql = "SELECT reservationId, ownerId, clientId, dogId, price, dateIn, dateOut FROM reservations WHERE ownerId = :ownerId";
	$stmt = $dbConn -> prepare($sql);
	$stmt -> execute(array(":ownerId" => $_SESSION['ownerId']));
	return $stmt -> fetchAll();
}

function getOwnerName($dbConn, $id) {
	$sql = "SELECT fname, lname FROM users WHERE userId = :userId";
	$stmt = $dbConn -> prepare($sql);
	$stmt -> execute(array(":userId" => $id));
	return $stmt -> fetch();
}
function getDogName($dbConn, $id) {
	$sql = "SELECT dogName FROM dogs WHERE dogId = :dogId";
	$stmt = $dbConn -> prepare($sql);
	$stmt -> execute(array(":dogId" => $id));
	return $stmt -> fetch();
}

$dogs = getDogs($dbConn);
$locationsOfuser = getLocations($dbConn);
$reservationsOfClient = getReservationsClient($dbConn);
$reservationsOfOwner = getReservationsOwner($dbConn);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<link rel="icon" href="img/favicon-paw.ico" type="img/x-icon">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profile</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME ICONS STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!--CUSTOM STYLES-->
    <link href="assets/css/style.css" rel="stylesheet" />
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
     
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a  class="navbar-brand" href="profile.php"> 
				<?php
				echo $_SESSION['username'];
				?>
                </a>
            </div>
        </nav>
        <!-- /. NAV TOP  -->
        <nav  class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li>
						<a href="profile.php"><i class="fa fa-home "></i>Profile Info</a>
					</li>
					<li>
						<a class="active-menu" href="table.php"><i class="fa fa-bar-chart "></i>Data Tables </a>
					</li>
					<li>
						<a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a>
					</li>
                </ul>
            </div>

        </nav>
        <!-- /. SIDEBAR MENU (navbar-side) -->
        <div id="page-wrapper" class="page-wrapper-cls">
            <div id="page-inner">
            	<?php  ?>
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Data Tables</h1>
                    </div>
                </div>
                <div class="row">
                <div class="col-md-6">
                     <!--    Dogs  -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Dogs
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Breed</th>
                                            <th>Weight</th>
                                            <th>Gender</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php 
                                    		if(isset($dogs)){
	                                    		foreach ($dogs as $v) {
													echo "<tr>
			                                            <td>" . $v['dogName'] . "</td>
			                                            <td>" . $v['breed'] . "</td>
			                                            <td>" . $v['weight']. "</td>
			                                            <td>" . $v['gender']. "</td>
			                                        	<td><form action='editDogInfo.php' method='post'>
											            	<input type='hidden' name='dogId' value='" . $v['dogId'] . "'> 
											            	<input type='submit' value='edit' name='editDogInfo'>
											            </form></td>
											            </tr>";
												}
											}
											else {
												echo "<tr><td>none</td></tr>";
											}
											echo "<tr><td>
											<form action='addDog.php' method='post'>
								            	<input type='submit' value='add' name='addDogForm'/>
								            </form>
								            </td></tr>";
                                    	?>
									    </script>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- End  Dogs  -->
                </div>
                <div class="col-md-6">
                     <!--    Locations  -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Locations
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Address</th>
                                            <th>City</th>
                                            <th>State</th>
                                            <th>Zip Code</th>
                                            <th>Price</th>
                                            <th>Available from - to</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php 
                                    		if(isset($locationsOfuser)){
                                    		foreach ($locationsOfuser as $v) {
												echo "<tr>
		                                            <td>" . $v['address'] . "</td>
		                                            <td>" . $v['city'] . "</td>
		                                            <td>" . $v['state']. "</td>
		                                            <td>" . $v['zipcode']. "</td>
		                                            <td>" . $v['price']. "</td>
		                                            <td>" . $v['dateIn'] . " - " . $v['dateOut'] . "</td>
		                                            <td><form action='editLocationInfo.php' method='post'>
											            	<input type='hidden' name='locationId' value='" . $v['locationId'] . "'> 
											            	<input type='submit' value='edit' name='editLocationInfo'>
											            </form></td>
											            </tr>";
											}
											}
											else {
												echo "<tr><td>none</td></tr>";
											}
											echo "<tr><td>
											<form action='addLocation.php' method='post'>
								            	<input type='submit' value='add' name='addLocationForm'/>
								            </form>
								            </td></tr>";
                                    	?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- End  Locations  -->
                </div>
            </div>
                <div class="row">
                <div class="col-md-6">
                     <!--    Reservations  -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Reservations for your dog(s)
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Location's owner</th>
                                            <th>Dog</th>
                                            <th>Price</th>
                                            <th>Address</th>
                                            <th>Check In</th>
                                            <th>Check Out</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php 
                                    		if(isset($reservationsOfClient)){
                                    		foreach ($reservationsOfClient as $v) {
                                    			$ownerName = getOwnerName($dbConn ,$v['ownerId']);
												$dogName = getDogName($dbConn ,$v['dogId']);
												echo "<tr>
		                                            <td>" . $ownerName['fname'] . " " . $ownerName['lname'] . "</td>
		                                            <td>" . $dogName['dogName'] . "</td>
		                                            <td>" . $v['price']. "</td>
		                                            <td>" . $v['dateIn']. "</td>
		                                        	<td>" . $v['dateOut']. "</td>
		                                        	<td><form action='deleteReservation.php' method='post'>
										            	<input type='hidden' name='reservationId' value='" . $v['reservationId'] . "'> 
										            	<input type='submit' value='Delete' name='deleteReserv'>
										            </form></td>
		                                        </tr>";
											}
											}
											else {
												echo "<tr><td>none</td></tr>";
											}
                                    	?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- End  Reservations  -->
                    
                </div>
                <div class="col-md-6">
                     <!--    Reservations  -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Reservations on your location(s)
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Dog's owner</th>
                                            <th>Dog</th>
                                            <th>Price</th>
                                            <th>Address</th>
                                            <th>Check In</th>
                                            <th>Check Out</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php 
                                    		if(isset($reservationsOfOwner)){
                                    		foreach ($reservationsOfOwner as $v) {
                                    			$ownerName = getOwnerName($dbConn ,$v['ownerId']);
												$dogName = getDogName($dbConn ,$v['dogId']);
												echo "<tr>
		                                            <td>" . $ownerName['fname'] . " " . $ownerName['lname'] . "</td>
		                                            <td>" . $dogName['dogName'] . "</td>
		                                            <td>" . $v['price']. "</td>
		                                            <td>" . $v['dateIn']. "</td>
		                                        	<td>" . $v['dateOut']. "</td>
		                                        </tr>";
											}
											}
											else {
												echo "<tr><td>none</td></tr>";
											}
                                    	?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- End  Reservations  -->
                    
                </div>
            </div>

            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <script src="assets/js/jquery-1.11.1.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/jquery.metisMenu.js"></script>
    <script src="assets/js/custom.js"></script>


</body>
</html>
