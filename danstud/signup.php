<?php

require "header.php";
?>
<style type="text/css">
	body{
		width: 100%;
	}
	form{
		width: 60%;
		border-radius: 2%;
	}
</style>
<body>
	<div class="header">
		<h2>Sign Up</h2>
		
	</div>
	<form method="post" action="server.php">
		
		<div class="input-group">
			<label>First Name:</label>
			<input type="text" pattern="[A-Za-z]*" name="first" placeholder = "First Name" required>
		</div>
		<div class="input-group">
			<label>Last Name:</label>
			<input type="text" pattern="[A-Za-z]*" name="last" required>
		</div>
		<div class="input-group">
			<label>National id:</label>
			<input type="text" name="national" required>
		</div>
		<div class="input-group">
			<label>Phone Number:</label>
			<input type="text" name="phone" required pattern=".{10,}" title="Phone number should contain only 10 characters">
		</div>
		<div class="input-group">
			<label>Email Adress</label>
			<input type="email" name="mail" required>
		</div>
		<div class="input-group">
			<label>Year Of Birth</label>
			<input type="date" name="YOB" required>
		</div>
		<div class="input-group">
			<label>Enter Password</label>
			<input type="password" name="pass1"required pattern=".{10,}" title="Password is too weak">
		</div>
		<div class="input-group">
			<label>Confirm Password</label>
			<input type="password" name="pass2"required pattern=".{10,}" title="Password is too weak">
		</div>
		<div>
			<label>Role</label>
			<br/><br/>
			<input type="radio" name="type" value="1">Applicants
			<br /><br />
			<input type="radio" name="type" value="0">Guarantor
		</div> 

		<div class="input-group">
			<BUTTON type="submit" name="register" class ="btn">Sign Up</BUTTON>
			
		</div>
		<p>
			Already a member?<a href="login.php">Sign in</a>
		</p>
		
	</form>
	
</body>
</html>