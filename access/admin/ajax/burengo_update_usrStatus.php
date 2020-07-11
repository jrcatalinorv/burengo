<?php 
session_start();
require_once "../../modelos/conexion.php";


$usrcode  = $_REQUEST["user"];
$st  = $_REQUEST["state"];
 						 
$stmt2 = Conexion::conectar()->prepare("UPDATE bgo_users SET status = ".$st ." WHERE uid = '".$usrcode."' ");

if($stmt2->execute()){	   
  $out['ok'] = 1;	   
}else{
  $out['ok']  = 0;
  $out['err'] = $stmt->errorInfo();
}
 
echo json_encode($out); 
?>