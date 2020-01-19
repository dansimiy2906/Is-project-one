<?php
session_start();
require 'connection.php';
$id = $_SESSION['permit']['Nationalid'];
?>
<!DOCTYPE html>
<html>
<head>
<style>
* {
    box-sizing: border-box;
}

input[type=text],[type=number], select, textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    resize: vertical;
}

label {
    padding: 12px 12px 12px 0;
    display: inline-block;
font-weight:bold;
}

button[type=submit] {
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    float: center;
}

input[type=submit]:hover {
    background-color: #45a049;
}

.container {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
float:center;
}

.col-25 {
    float: left;
    width: 25%;
    margin-top: 6px;
}

.col-75 {
    float: center;
    width: 75%;
    margin-top: 6px;
}

/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
}

/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
    .col-25, .col-75, input[type=submit] {
        width: 100%;
        margin-top: 0;
    }
}
</style>
</head>
<body>

<div class="container" style="width:60%" align="center">
  <form action="Account.php" method="POST">
    <div class="row">
      <div class="col-75">
		<label>AMOUNT</label><br />
        <input type="number" name="amt" placeholder="Enter Amount">
      </div>
    </div>
    <div class="row">
      <button type="submit" name="deposit">DEPOSIT</button>
      <button type="submit" name ="withdraw">WITHDRAW</button>
    </div>
  </form>
</div>
</body>
</html>
<?php
if (isset($_POST['deposit'])) {

        $depoamt = $_POST['amt'];
		$type = "deposite";
      
         $deposite = "INSERT INTO `account`(`transactionamt`, `trandoneby`, `transactiontype`, `transactiondate`) VALUES ('$depoamt', '$id','$type', now())";
          
		if($conn->query($deposite)) {
		  
		   header('location:account.php');
		}
		else{
		   echo "Error: " . $deposite . "<br>" . $conn->error;
		}
	  }
if (isset($_POST['withdraw'])) {

        $drawamt = $_POST['amt'];
		$typ = "withdraw";
      
         $withdraw = "INSERT INTO `account`(`transactionamt`, `trandoneby`, `transactiontype`, `transactiondate`) VALUES ('$drawamt','$id, '$typ', now())";
          
		if($conn->query($withdraw)) {
		  
		   header('location:account.php');
		}
		else{
		  echo "Error: " . $withdraw . "<br>" . $conn->error;
		}
	  }    
?>