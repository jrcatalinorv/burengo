<?php
session_start();
require_once "modelos/data.php";
unset($_SESSION['bgo_userImg']); 
unset($_SESSION["bgoSesion"]);
session_destroy();
header('location: '.burengoBaseUrl.''); 
 
?>