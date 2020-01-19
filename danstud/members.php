<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<style>
#customers {

    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 80%;
}

#customers td, #customers th {
    border: 1px solid #ddd;
    padding: 6px;
}

#customers tr:nth-child(even)
{
background-color: #f2f2f2;
}

#customers tr:hover {background-color: #ddd;}

#customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #21375b;
    color: white;
}
</style>
</head>
<body>
  <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">


<table id="customers" align="center">
  <tr>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Email Address</th>
  </tr>

  <?php
  require 'connection.php';
  $list = "SELECT * FROM `signup` WHERE `type` = 1";
  $result = $conn->query($list);
  //$_SESSION['new'] = $result->fetch_assoc();
  
  while($_SESSION['row'] = $result->fetch_assoc()){
    if (count($_SESSION['row']) > 0) {
    ?>
    <tr>
      <?php
      echo '
      <td><a href="Chat.php?gid='.$_SESSION['row']['Nationalid'].'" >'. $_SESSION['row']['First'] .'</a></td>
      ';
      ?>
      <td><?php echo $_SESSION['row']['Last']; ?></td>
      <td><?php echo $_SESSION['row']['Email']; ?></td>
    </tr>
    <?php
    }
  }
  ?>

  
</table>
<script>
function myFunction() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>


</body>
</html>
