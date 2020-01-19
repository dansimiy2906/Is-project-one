<?php
      session_start(); 
      require 'header.php';
     require 'nav.php';


  if (!isset($_SESSION['permit'])) {
  	$_SESSION['msg'] = "You must log in first";
  	
  }
  /*
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }*/ 
?>


<body>
	<div class="header">
		<h2> Home Page</h2>
	</div>
	<div class="content">
		<?php if(isset($_SESSION['success'])): ?>
			<div class="error success">
				<h3>
					<?php
					     echo $_SESSION['success'];
					     unset($_SESSION['success']);

					?>
				</h3>
			</div>
             
		<?php endif ?>
		<?php if (isset($_SESSION['username'])): ?>
			<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
			<p><a href="home.php?logout='1'" style="color:red;">Logout</a></p>

		<?php endif ?>

		
	</div>

</body>
</html>