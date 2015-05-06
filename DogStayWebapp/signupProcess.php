<?php
    session_start();
    if(isset($_POST['signupForm'])){
    	
        require 'dbConnection.php';
        $dbConn = getConnection();
		
		
		$sql = "INSERT INTO users (fname, lname, email, phone, username, password) VALUES (:fname, :lname, :email, :phone, :username, :password)";
        $stmt = $dbConn -> prepare($sql);
        $nameParameters = array(":fname" => $_POST['firstName'],
                                 ":lname" => $_POST['lastName'],
                                 ":email" => $_POST['email'],
                                 ":phone" => $_POST['phone'],
                                 ":username" => $_POST['username'],
                                 ":password" => sha1($_POST['password']));
		$stmt -> execute($nameParameters);	
        
        $_SESSION["username"] = $_POST['username'];
		if($_POST['stay'] != 2){
        	header("Location: profile.php");
		}
		else{
			$_SESSION['name'] = $_POST['name'];
			$_SESSION['ownerId'] = $_POST['ownerId'];
			$_SESSION['price'] = $_POST['price'];
			$_SESSION['dateIn'] = $_POST['dateIn'];
			$_SESSION['dateOut'] = $_POST['dateOut'];
				
			$_SESSION['userId'] =  $dbConn -> lastInsertId();
			header("Location: reservation.php");
		}
    }
?>