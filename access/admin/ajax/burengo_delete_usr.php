<?php 
session_start();
require_once "../../modelos/conexion.php";


$usrcode  = $_REQUEST["user"];
 						 
$stmt2 = Conexion::conectar()->prepare("DELETE FROM bgo_users WHERE uid = '".$usrcode."' ");

if($stmt2->execute()){	   
  $out['ok'] = 1;	   
}else{
  $out['ok']  = 0;
  $out['err'] = $stmt->errorInfo();
}
 
echo json_encode($out); 
?>