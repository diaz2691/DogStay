<?php
    session_start();
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		
		if(isset($_POST['username']) && isset($_POST['password'])){
			
	        require 'dbConnection.php';
	        
	        $dbConn = getConnection();
	        $sql = "SELECT * FROM users WHERE username = :username AND password = :password";
	        $namedParams[":username"] = $_POST['username'];
	        $namedParams[":password"] = sha1($_POST['password']);
	        
	        $stmt = $dbConn->prepare($sql);
	        $stmt->execute($namedParams);
	        $result = $stmt->fetch();
	        
	        if(empty($result)){
	            header("Location: login.html?error='wrong username");
	            
	        }else{
	        	
	            $_SESSION["username"] = $result["username"];
				
			
	            header("Location: profile.php");
	        }
		} 
		
	}
    
?>