<?php 
session_start();
require_once "../../modelos/conexion.php";


$usrcode  = 'U202002151837494884';
$old 	  = crypt($_REQUEST["pass"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
$new 	  = crypt($_REQUEST["npass"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
 

$stmt2 = Conexion::conectar()->prepare("SELECT * FROM bgo_users where uid ='".$usrcode."'");
$stmt2 -> execute();
$results = $stmt2 -> fetch();
										
if($results['pass']==$old){
	$stmt2 = Conexion::conectar()->prepare("UPDATE bgo_users SET pass = '".$new ."' WHERE uid = '".$usrcode."' ");
	if($stmt2->execute()){	   
		$out['ok'] = 1;	   
	}else{
	  $out['ok']  = 0;
	  $out['err'] = $stmt->errorInfo();
	}
}else{
	
	$out['ok'] = 2;
}
echo json_encode($out); 
?>