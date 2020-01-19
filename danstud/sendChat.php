<?php  
require "connection.php";
if (isset($_POST['send']))
 {	
	  $uname = $_POST['user_name'];
	  $reciever = $_POST['garants'];
	  $sender = $_POST['nowUser'];
	  $umessage = $_POST['message'];

	  $query = "INSERT INTO chatroom(name, message, time, reciever, sender) VALUES ('$uname', '$umessage', now(), '$reciever', '$sender')";

	  $insert_res = $conn->query($query);

	  if ($insert_res) {

		$_SESSION['recieve'] = $reciever;

		header("Location:chat.php?gid=".$_SESSION['recieve']);
	  }else
	  {
		echo "error ". $query." ".$conn->error;
	  }  	
}
if(isset($_POST['subresult'])){
$chkres = $_POST['chk'];
$chkreceiva = $_POST['garantres'];

$sqlchk = "UPDATE `loanapplication` SET `Gfeedback`= '$chkres' WHERE `gNationalId` ='$chkreceiva'";

if($conn->query($sqlchk)){

$_SESSION['recieve'] = $chkreceiva;

header("Location:chat.php?gid=".$_SESSION['recieve']);
}else{
echo "Error";
}
}
?>
