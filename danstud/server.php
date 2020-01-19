

<?php
     session_start();
     require "connection.php";

     //if the registration button is clicked
      if (isset($_POST['register'])) {
        //$first = mysqli_real_escape_string($conn, $_POST['first']);
        
        $first = mysqli_real_escape_string($conn, $_POST['first']);
        $last = mysqli_real_escape_string($conn,$_POST['last']);
        $national = mysqli_real_escape_string($conn,$_POST['national']);
        $phone= mysqli_real_escape_string($conn,$_POST['phone']);
        $type= mysqli_real_escape_string($conn,$_POST['type']);
        $mail = mysqli_real_escape_string($conn,$_POST['mail']);
        $YOB = mysqli_real_escape_string($conn,$_POST['YOB']);
        $pass1 = mysqli_real_escape_string($conn,$_POST['pass1']);
        $pass2 = mysqli_real_escape_string($conn,$_POST['pass2']);        

          $pass1 = md5($pass1);
          $pass2 = md5($pass2);
          if ($pass1 == $pass2) {
         $sql = "INSERT INTO `signup`(`Nationalid`, `First`, `Last`, `YOB`, `Email`, `phone`, `pass1`, `type`) VALUES ('$national','$first','$last','$YOB','$mail','$phone','$pass1', '$type')";
          
          $result = $conn->query($sql);
            if(!$result) {

              
               header('location:login.php');
            }
            else{
               
              echo "Error: " . $sql . "<br>" . $conn->error;
            }
          }    

          
      }
        
      if (isset($_POST['login'])) {
        $username = mysqli_real_escape_string($conn,$_POST['national']);
        $pass1 = mysqli_real_escape_string($conn,$_POST['pass1']);

          $pass = md5($pass1);
          $query = ("SELECT * FROM signup WHERE `Nationalid` ='$username' AND pass1 = '$pass'");
          //$query = "SELECT * FROM `signup` WHERE `Nationalid` = 1017856 AND `First` = 'Dan';";
           $result2 = $conn->query($query);
            if ($result2->num_rows > 0) {
              $_SESSION['permit'] = $result2->fetch_assoc();
              $userType = $_SESSION['permit']['type'];
              $_SESSION['success'] = "You are now logged in";
              /*if ($userType != 0) {
                header('location:one.php');
              }else
              {
                header('location:home.php');
              }*/
              header('location:home.php');

            }
            else{
              
               //
              echo "<script type='text/javascript'>alert('incorrect username or password')</script>";
            }

          }

      if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['national']);
        header('location: login.php');
      }
      ?>