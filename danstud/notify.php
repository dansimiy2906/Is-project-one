
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