<?php
session_start();
unset($_SESSION['bgo_userImg']); 
unset($_SESSION["bgoSesion"]);
session_destroy();
header('location:../'); 
 
?>