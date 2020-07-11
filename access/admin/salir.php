<?php
session_start();
$_SESSION["bgoSesion"] == null;
unset($_SESSION['bgo_userImg']); 
unset($_SESSION["bgoSesion"]);
session_destroy();

header('location:../../'); 
 
?>