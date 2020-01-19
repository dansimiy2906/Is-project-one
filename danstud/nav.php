<?php
require 'connection.php';
?>
<body>
<div class="topnav" id="myTopnav">
  <a href="home.php" class="active">Home</a>
    <?php if(!isset($_SESSION['permit'])) { ?>
  <a href="signup.php">Sign Up</a>
  <a href="login.php">Login</a>

<?php } ?>
  <a href="about.php">About</a>
  <?php
  if(isset($_SESSION['permit']))  
   if($_SESSION['permit']['type'] == 0) { ?>
       <a href="members.php">Members</a>
       <?php } ?>
       <?php
  if(isset($_SESSION['permit']))  
   if($_SESSION['permit']['type'] == 0) { ?>
   <div class="dropdown">
   <?php
   $garantnow = $_SESSION['permit']['Nationalid'];
   $chat_count = "SELECT * FROM `chatroom` WHERE `sms_status` = 0 AND reciever = '$garantnow'";
   $chat_count_res = $conn->query($chat_count);
   $count = mysqli_num_rows($chat_count_res);
   
   $chat_query = "SELECT * FROM `chatroom` WHERE `sms_status` = 0 AND reciever = '$garantnow' GROUP BY `name` ORDER BY `time` DESC";
   ?>
  <button class="dropbtn" name="notify" action = "notify.php">Notification 	&#40;<?php echo $count; ?>&#41;	</button>
  <div class="dropdown-content">
    <?php  
	$chat_query_res = $conn->query($chat_query);
	while($row = $chat_query_res->fetch_assoc())
	{
    echo '
	<a href="Chat.php?gid='.$row["sender"].'">'.$row["name"].'</a> 
		';
	}
    ?>
  </div>
</div>
<script>
$(document).ready(
        function() {
            setInterval(function() {
                $.ajax({
                    
                    cache: false,
                    success: function(data)
                    {
                        $('#message').html(data);
                    },                                          
                });
            }, 1000);
        });

<?php
     include('connection.php');

     if (isset($_POST['notify'])) {
      if ($_POST['notify'] !='') {

        $update_query = "UPDATE `chatroom` SET `message_status`= 1 WHERE `message_status` = 0";
        mysqli_query($conn,$update_query);
     }
     $query = "SELECT * FROM `chatroom` ORDER BY `id` DESC LIMIT 5";
     $result = mysqli_query($conn,$query);
     $output = '';

     if (mysqli_num_rows($result)>0) {

      while ($row = mysqli_fetch_array($result)) {
        $output .= '
        <li>
        <a href = "chat.php">
        <strong>'.$row["name"].'</strong><br/>
        </a>
        </li>
        ';
      }
     }
     else{
      $output .= '<li><a href="#" class="text-bold text-italic">No Noti Found</a></li>';
}

$status_query = "SELECT * FROM `chatroom` WHERE `message_status` = 0";
$result_query = mysqli_query($conn,$status_query);
$count = mysqli_num_rows($result_query);
$data = array(
  'notification'=>$output,
  'unseen_notification' => $count
);

     
     echo json_encode($data);
}
?>


</script>
    <?php } ?>
  
  

  <?php 
  if(isset($_SESSION['permit']))  
   if($_SESSION['permit']['type'] == 1) { ?>
    <div class="dropdown">
      <button class="dropbtn">ApplyLoan 
        <i class="fa fa-caret-down"></i>
      </button>
      <div class="dropdown-content">
       
        <a href="applicationform.php">Application form</a>
        <a href="guarantor.php">View guarantor list</a>
         <a href="account.php">Account</a>
          
      </div>
    </div> 
    <?php } ?>

    
 <?php if(isset($_SESSION['permit'])) { ?>
  <div>
    <a href="logout.php" style="margin-left: 62% "><img src="icons/logout.jpg" style="height: 20px; width: 20px; margin-top: 2%"></a>
  </div>
<?php } ?>
</div>

<script>
function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}
</script>

</body>