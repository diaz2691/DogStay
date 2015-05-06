<?php
    session_start();
	require 'dbConnection.php';
    $dbConn = getConnection();
	
	function getId($dbConn ,$username, $password)
	{
		$sql = "SELECT userId FROM users WHERE username = :username AND password = :password";
		$stmt = $dbConn -> prepare($sql);
		$stmt -> execute(array(":username" => $username,
							   ":password" => $password));
		return $stmt -> fetch();
	}
	
    if(isset($_POST['loginForm'])){
        $sql = "SELECT * FROM users WHERE username = :username AND password = :password";
        $namedParams[":username"] = $_POST['username'];
        $namedParams[":password"] = sha1($_POST['password']);
        
        $stmt = $dbConn->prepare($sql);
        $stmt->execute($namedParams);
        $result = $stmt->fetch();
        
        if(empty($result)){
            header("Location: reservation.php?error='wrong username");
            
        }else{
            $_SESSION["username"] = $result["username"];
			$vals = getId($dbConn, $_POST["username"], sha1($_POST['password']));
			$_SESSION['ownerId'] = $vals['userId'];
			
			if($_POST['stay'] != 2){
	        	header("Location: profile.php");
			}
			else{
				$vals = getId($dbConn, $_POST["username"], sha1($_POST['password']));
				$_SESSION['userId'] = $vals['userId'];
				$_SESSION['name'] = $_POST['name'];
				$_SESSION['ownerId'] = $_POST['ownerId'];
				$_SESSION['price'] = $_POST['price'];
				$_SESSION['dateIn'] = $_POST['dateIn'];
				$_SESSION['dateOut'] = $_POST['dateOut'];
					
				header("Location: reservation.php");
			}
			
			
        }  
    }
?>