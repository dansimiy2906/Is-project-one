

 <?php
session_start();
  require "connection.php";
  if (isset($_GET["gid"])) {

    $recieva = $_GET["gid"];
  }  else{
    $recieva = $_SESSION['recieve'];
  }
  
  //name that appears in chatbox when chatting
  $senda = $_SESSION['permit']['Nationalid'];
  
  $status = "SELECT * FROM `chatroom` WHERE `reciever` = '$senda' AND `sender` = '$recieva' AND `sms_status` = 0";
  if($conn->query($status)){
	  $upStatus = "UPDATE `chatroom` SET `sms_status` = 1 WHERE `reciever` = '$senda' AND `sender` = '$recieva'";
	  
	  $conn->query($upStatus);
  }

  $senderName = "SELECT `First` FROM `signup` WHERE `Nationalid` ='$senda' LIMIT 1";
  $resultNm= $conn->query($senderName);
  $nedrow = $resultNm->fetch_assoc();
  $nowNm = $nedrow["First"];
  
  $recievaNm = "SELECT `reciever`, `sender` FROM `chatroom`;";
  $recresultNm= $conn->query($recievaNm);
  $recnedrow = $recresultNm->fetch_assoc();
  $rec = $recnedrow["reciever"];
  $send = $recnedrow["sender"];

/*sqllink = "SELECT `chatlinkingId` FROM `chatters` WHERE `user1_Id` = '$senda'";

  $resultlink= $conn->query($sqllink);
  $_SESSION['id'] = $resultlink->fetch_assoc();
  $nowlink = $_SESSION['id']["chatlinkingId"];
  */
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Chat</title>
		<link rel="stylesheet" type="text/css" href="css/chatroom.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<script src="https://code.jquery.com/jquery-3.3.1.min.js"
     integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
     crossorigin="anonymous"></script>
     
    </head>
    <body>
       
    		<h4 class="text-center">Chat with guarantors/Applicant online <a href="home.php">HOME</a></h4> <?php
         if(isset($_SESSION['permit']))
          if($_SESSION['permit']['type'] == 0) {?>
			<form action="sendChat.php" method = "POST">
            Guatantee:
            <input type="radio" name="chk" value="1">
           			<input type="hidden" name="garantres" value="<?php echo $recieva; ?>"><br>
            <br/><br/>

            Decline:
            <input type="radio" name="chk" value="0">

            <button type="submit" name="subresult">Submit</button>
			</form>
          <?php }?>
          <?php
           if (isset($_POST['submit'])) {
          $check = mysqli_real_escape_string($conn, $_POST['check']);
          $sql = "UPDATE `loanapplication` SET `Gfeedback`=$check where `AppDoneBy` = $Nationalid";
        }
        
			$sql = "SELECT * FROM `chatters` WHERE `user1_Id` = '$senda' OR `user1_Id` = '$recieva' AND `user2_Id`='$recieva' or `user2_Id`='$senda' AND `chatlinkingId` is NOT null";

			$chtresult = $conn->query($sql);

			if ($chtresult->num_rows > 0) {
			
    		?>
    		<div class="well" id="chatbox">
    			<?php
				$query = "SELECT * FROM `chatroom` WHERE `reciever` ='$recieva' AND `sender` = '$senda' OR`reciever` ='$senda' AND `sender` = '$recieva'";
				$runres = $conn->query($query);
				if ($runres->num_rows > 0) {
				while ($row = $runres->fetch_assoc()) {
         		?>
            <div class="container">

			    <p>
			    	<span style="color: red;"> <?php echo $row['name'];?></span>
    				<span style="color: blue;"><?php echo $row['message'];?></span>
    				<span style="float: right;"><?php echo $row['time'];?></span>
			    </p>
        </div>

			    <?php
				}	}
				?>
			</div>
			<?php 
			}elseif ($chtresult->num_rows == 0)
			 {
				$chtsql2 = "INSERT INTO `chatters`( `user1_Id`, `user2_Id`) VALUES ('$senda','$recieva')";

				$conn->query($chtsql2);
			}
			else{
				echo "Error". $sql. $conn->Error;

				}

			 ?>


    		<form id="myChatForm" action="sendChat.php" method="POST">

    			<input type="hidden" name="user_name" value="<?php echo $nowNm; ?>"><br>
    			<input type="hidden" name="garants" value="<?php echo $recieva; ?>"><br>
          <input type="hidden" name="nowUser" value="<?php echo $senda; ?>"><br>
    			<textarea type="text" name="message" id="message" placeholder="Enter your message" cols="30" rows="3"></textarea><br>
    			<button type="submit" class="btn btn-success btn-lg" name="send" id="sendMessageBtn">Send Message</button>
    		</form>

    	</div>
</body>
</html>
