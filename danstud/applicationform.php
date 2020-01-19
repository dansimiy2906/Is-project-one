<?php
session_start();
require 'connection.php';
?>
<!DOCTYPE HTML>  
<html>
<head>
  <style>
* {
    box-sizing: border-box;
}

input[type=text], select, textarea {
    width: 80%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    resize: vertical;
}

label {
    padding: 12px 12px 12px 0;
    display: inline-block;
}

input[type=submit] {
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    float: right;
}

input[type=submit]:hover {
    background-color: #45a049;
}

.container {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
    width: 70%;
    position: absolute;
    left: 15%;
    right:30%;
}

.col-25 {
    float: left;
    width: 25%;
    margin-top: 6px;
}

.col-75 {
    float: left;
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
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php
// define variables and set to empty values
$nameErr = $emailErr = $genderErr = $websiteErr = "";
$name = $email = $gender = $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed"; 
    }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Date is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format"; 
    }
  }
    
  if (empty($_POST["website"])) {
    $website = "";
  } else {
    $website = test_input($_POST["website"]);
    // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
      $websiteErr = "Invalid URL"; 
    }
  }

  if (empty($_POST["comment"])) {
    $comment = "";
  } else {
    $comment = test_input($_POST["comment"]);
  }

  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>Loan Application Form</h2>
<div class="container" style="">
<form method="post" action="applicationform.php"> 
<div class="row">
  <div class="col-25"> 
    <span class="error"><?php echo $nameErr;?></span>
  <br>
    <label for="fname">Applicants Full Name</label>
      </div>
      <div class="col-75">
   <input type="text" name="amount" value="<?php echo $name;?>" required>
  </div>
    </div>
    <br/>
    <div class="row">
  <div class="col-25"> 
    <span class="error"><?php echo $nameErr;?></span>
  <br>
    <label for="fname">Employer</label>
      </div>
       <div class="col-75">
   <input type="text" name="amount" value="<?php echo $name;?>" required>
  </div>
      <br>
      <div class="row">
  <div class="col-25"> 
    <span class="error"><?php echo $nameErr;?></span>
  <br>
    </div>
    <br>
    
  <div class="row" style="margin-right: 50%">
    <a href="applicationform.php" download>Download</a>
      <input type="submit" name="saved" value="SAVE" />
  </div>
    
</form>
</div>

</body>
</html>
<?php
$applicant = $_SESSION['permit']['Nationalid'];
if(isset($_POST['saved'])){
	$l_amt = mysqli_real_escape_string($conn, $_POST['amount']);
	$l_date = mysqli_real_escape_string($conn, $_POST['date']);
	$comment = mysqli_real_escape_string($conn, $_POST['comment']);
	
	$loansql = "INSERT INTO `loanapplication`(`loanAmt`, `AppReason`, `AppDoneBy`) VALUES ('$l_amt', '$comment', '$applicant')";
	
	$conn->query($loansql);
	
	header('location:applicationform.php');
}
?>

