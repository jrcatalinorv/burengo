<?php 
session_start();
require_once "../modelos/conexion.php";

$uid = $_REQUEST["code"];
$name = $_REQUEST["nombre"];
$user = strtolower ($_REQUEST["user"]);
$addr =  $_REQUEST["address"];
$provinvia =  $_REQUEST["provincia"];
$ced =  $_REQUEST["ced"];
$phone =  $_REQUEST["tel"];
$email =  $_REQUEST["email"];
$whatsapp = $_REQUEST["wa"]; 
$instagram = $_REQUEST["ig"]; 
$facebook = $_REQUEST["fb"]; 

$stmt = Conexion::conectar()->prepare("UPDATE bgo_users SET name = '".$name."' , user = '".$user."',addr = '".$addr."', provinvia = ".$provinvia.",
 ced = '".$ced."', phone = '".$phone."',email = '".$email."', bgo_whatsapp = '".$whatsapp."', bgo_instagram = '".$instagram."', 
bgo_facebook = '".$facebook."' WHERE uid = '".$uid."'");
	 
if($stmt->execute()){
   
   	$_SESSION['bgo_name'] = $name;
	$_SESSION['bgo_user'] = $user;
	$out['ok'] = 1;
 
   
}else{
  $out['ok']  = 0;
  $out['err'] = $stmt->errorInfo();
}
echo json_encode($out); 
?>