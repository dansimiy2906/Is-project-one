<?php
 session_start();

unset ($_SESSION["permit"]);

session_destroy();


header('location: home.php');

?>