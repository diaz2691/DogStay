<?php
session_start();

function getInfo() {
	require 'dbConnection.php';
	$dbConn = getConnection();
	$sql = "SELECT userId, fname, lname, email, phone, username, password FROM users WHERE username = :username";
	$stmt = $dbConn -> prepare($sql);
	$stmt -> execute(array(":username" => $_SESSION['username']));
	return $stmt -> fetch();
}

$info = getInfo();

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Profile</title>
		<!-- BOOTSTRAP STYLES-->
		<link href="assets/css/bootstrap.css" rel="stylesheet" />
		<!-- FONTAWESOME ICONS STYLES-->
		<link href="assets/css/font-awesome.css" rel="stylesheet" />
		<!--CUSTOM STYLES-->
		<link href="assets/css/style.css" rel="stylesheet" />
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
					<a  class="navbar-brand" href="profile.php"> <?php
					echo $_SESSION['username'];
					?> </a>
					
				</div> 
			</nav>
			
			<!-- /. NAV TOP  -->
			
			<nav  class="navbar-default navbar-side" role="navigation">
				<div class="sidebar-collapse">
					<ul class="nav" id="main-menu">
						<li>
							<a class="active-menu"  href="profile.php"><i class="fa fa-home "></i>Profile Info</a>
						</li>
						<li>
							<a href="table.php"><i class="fa fa-bar-chart "></i>Data Tables </a>
							<?php $_SESSION['ownerId'] = $info['userId'];
							//header("Location: table.php");?>
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
					<div class="row">
						<div class="col-md-12">
							<h1 class="page-head-line">Profile Information</h1>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<!--    info table  -->
							<div class="panel panel-default">
								<div class="panel-heading">
									Profile Information
								</div>
								<div class="panel-body">
									<div class="table-responsive">
										<table class="table table-hover">
											<tbody>
												<tr>
													<td>Username</td>
													<td><?php echo $info['username']; ?></td>
												</tr>
												<tr>
													<td>First Name</td>
													<td><?php echo $info['fname']; ?></td>
												</tr>
												<tr>
													<td>Last Name</td>
													<td><?php echo $info['lname']; ?></td>
												</tr>
												<tr>
													<td>Email</td>
													<td><?php echo $info['email']; ?></td>
												</tr>
												<tr>
													<td>Phone</td>
													<td><?php echo $info['phone']; ?></td>
												</tr>
												<tr>
													<td>
									                     <form action="editProfileInfo.php">
									                         <input type="submit" value="edit" name="editForm"/>
									                     </form>   
									                </td> 
								                </tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<!-- End  info table  -->
						</div>
					</div>

					<!-- /. PAGE INNER  -->
				</div>
				<!-- /. PAGE WRAPPER  -->
			</div>
		</div>
		<!-- /. WRAPPER  -->
		<script src="assets/js/jquery-1.11.1.js"></script>
		<script src="assets/js/bootstrap.js"></script>
		<script src="assets/js/jquery.metisMenu.js"></script>
		<script src="assets/js/custom.js"></script>

	</body>
</html>
