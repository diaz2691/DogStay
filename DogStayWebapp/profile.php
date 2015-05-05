<?php
session_start();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Free Bootstrap Admin Template</title>
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
                <a  class="navbar-brand" href="profile.php"> 
				<?php
				echo $_SESSION['username'];
				?>
                </a>
            </div>

            <div class="notifications-wrapper">
<ul class="nav">
          
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user"></i> My Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="mapView.html"><i class="fa fa-sign-out"></i> Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
               
            </div>
        </nav>
        <!-- /. NAV TOP  -->
        <nav  class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li>
                        <div class="user-img-div">
                            <img src="assets/img/avatar.gif" class="img-circle" />
                        </div>
                    </li>
                     <li>
                        <a  href="#"> <strong>  <?php echo $_SESSION['username']; ?> </strong></a>
                    </li>
                    <li>
                        <a class="active-menu"  href="profile.php"><i class="fa fa-dashboard "></i>Dashboard</a>
                    </li>
                    <li>
                        <a href="table.html"><i class="fa fa-bolt "></i>Data Tables </a>
                    </li>
                     <li>
                        <a href="forms.html"><i class="fa fa-code "></i>Upload Picture</a>
                    </li>
                </ul>
            </div>
            
        </nav>
        <!-- /. SIDEBAR MENU (navbar-side) -->
        <div id="page-wrapper" class="page-wrapper-cls">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Profile</h1>
                    </div>
                    
                </div>
                <div class="row" style="heigth:100px; float:left">

                <table class="table table-striped table-bordered table-hover" style="float:left" >
                    <thead >
                        <tr>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Rating</th>
                            
                        </tr>
                        <tr>
                            <th> </th>
                            <th> </th>
                            <th> </th>
                        </tr>
                        
                    </thead>
                </table>
                
                
            </div>
                <div class="style-box-one Style-one-clr-three" style="float:right">
                            <a href="#">
                                <span class="glyphicon glyphicon-camera"></span>
                                 <h5>Upload Yard Pictures</h5>
                            </a>
                        </div>
<!--
                 <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-danger">
                            This is a free admin dashboard temple for personal and commercial use. Use this template for your projecs and save you money and time. Hope you will like it.
                        </div>
                    </div>
                </div>
-->
                <div class="row">

            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
        </div>
    <!-- /. WRAPPER  -->

    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.11.1.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>


</body>
</html>
