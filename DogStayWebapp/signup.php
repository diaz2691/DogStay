<?php

?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/login.css" rel="stylesheet">
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <script>  
    	var avaButton = false, avaButton2 = false;
      	function checkUsername() {  
      	$("#usernameError").css("color", "red");
	    if($("#username").val().length < 4){
	    	displayError("#username","Username must have at least 4 characters");
	    	return false;
	    }
	    
	     $.ajax({
	            type: "get",
	            url: "verifyUsername.php",
	            dataType: "json",
	            data: {"username": $("#username").val() },
	            success: function(data,status) {
	            	//alert(data['exists']);
	            	if(data['exists']) {
	            		$("#username").css("background-color","red");
	            		$("#username").focus();
	            	}
	            	else{
	            		console.log("username");
	            		avaButton = true;
	            		displaySuccess("#username");
	            		if(avaButton && avaButton2){
				  			document.getElementById("signupB").disabled = false;
					  	}
					  	else{
					  		document.getElementById("signupB").disabled = true;
					  	}
	            		
	            		return false;
	            	}
	            	
	            },
	            complete: function(data,status) { 
	            }
	         });
     }  	
     
    function displaySuccess(id){
          $(id).css("background-color","green");
          $(id).focus();
    } 
  	
  	function displayError(id){
        $(id).css("background-color","red");
        $(id).focus();
  	}	
    function checkPhone(){
  		if(!/^\(\d{3}\)\s\d{3}-\d{4}$/.test($("#phone").val())) {
  			displayError("#phone");
  			return false;
  		}
  		else{
  			console.log("phone");
  			avaButton2 = true;
  			displaySuccess("#phone");
  			if(avaButton && avaButton2){
	  			document.getElementById("signupB").disabled = false;
		  	}
		  	else{
		  		document.getElementById("signupB").disabled = true;
		  	}
            return false;
  		}
  		
  		
  	}

  	</script>
</head>
<body>
	<div class="container">
		
		<div id="logo">
			<img src="img/DogStaylogo.png">
	  	</div>
	    
	    <form action="signupProcess.php" method="POST" class="form-signin">
	        <input type="text" name="firstName" id="firstName" class="form-control" placeholder="First Name" required autofocus>
	        <input type="text" name="lastName" id="lastName" class="form-control" placeholder="Last Name" required >
	        <input type="email" name="email" id="email" class="form-control" placeholder="Email" required >
	        <input type="tel" name="phone" id="phone" class="form-control" placeholder="phone" required><span id="phoneError"></span>
	        <input type="text" name="username" id="username" class="form-control" placeholder="Username" required> <span id="usernameError"></span>
	        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
	      <button id="signupB" name="signupForm" class="btn btn-lg btn-primary btn-block" type="submit" disabled='disabled'>Sign Up</button>    
	    </form>
	    	    
	</div>	    
	<script>
	  	$("#username").change(checkUsername);
	  	$("#phone").change(checkPhone);
 	</script>
</body>
</html>