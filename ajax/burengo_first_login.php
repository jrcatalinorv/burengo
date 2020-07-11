<?php 
session_start();
require_once "../modelos/conexion.php";

 
$uid  = $_REQUEST["uid"];
 
$stmt2 = Conexion::conectar()->prepare("SELECT * FROM bgo_users where uid ='".$uid."'");
$stmt2 -> execute();
$results = $stmt2 -> fetch();
										
if($results['uid']==$uid){

	if($results['profile']==100){
		$addr="dashboard.php";
	}else if($results['profile']< 99 && $results['profile'] > 0 ){
		$addr="inicio.php";
	}else{
		$addr="salir.php";
	}
 
	
	$_SESSION['bgo_userId'] = $results['uid'];
	$_SESSION['bgo_name'] = $results['name'];
	$_SESSION['bgo_user'] = $results['user'];
	$_SESSION['bgo_userImg'] = $results['img'];
	$_SESSION['bgo_perfil'] = $results['profile'];
	$_SESSION["bgoSesion"] = 'ok';
	$_SESSION['bgo_year'] = date('Y');
	$_SESSION['bgo_version'] = '1.1.0.1';
 
	$out['url'] = $addr;
	$out['ok'] = 1;
	$out['status'] = 1; 
}else{
	$out['ok'] = 0;
}
echo json_encode($out); 
?>