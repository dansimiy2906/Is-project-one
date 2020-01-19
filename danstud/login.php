<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<div class="header">
		<h2>Login</h2>
	</div>
	<form method="post" action="server.php">
		
		<div class="input-group">
			<label>National id:</label>
			<input type="text" name="national" required>
		</div>
		<div class="input-group">
			<label>Enter Password</label>
			<input type="password" name="pass1" required>
		</div>
		<div class="input-group">
			<BUTTON type="submit" name="login" class ="btn">Login</BUTTON>
			
		</div>
		<p>
			Not yet a member?<a href="signup.php">Sign up</a>
		</p>
		
	</form>
	
</body>
</html>