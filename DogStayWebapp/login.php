<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/login.css" rel="stylesheet">

  </head>

  <body>
    <div class="container">
      <div id="logo">
	  	<img src="img/DogStaylogo.png">
	  </div>	
      <form action = "loginProcess.php" method="POST" class="form-signin">
        <!--<label for="inputEmail" class="sr-only">Username</label>-->
        <input type="username" name="username" id="username" class="form-control" placeholder="Username" required autofocus>
        <!--<label for="inputPassword" class="sr-only">password</label>-->
        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
        
        <button name = "loginForm" class="btn btn-lg btn-primary btn-block" type="submit">Log in</button>
      </form>

    </div> 
  </body>
</html>
