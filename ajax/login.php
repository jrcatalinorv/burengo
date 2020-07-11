<?php 
session_start();
require_once "../modelos/conexion.php";
require_once "../modelos/data.php";

$usr  = strtolower ($_REQUEST["usr"]);
$pass = crypt($_REQUEST["pass"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

$stmt2 = Conexion::conectar()->prepare("SELECT * FROM bgo_users where user ='".$usr."' and pass = '".$pass."' 
AND bgo_country in ('".COUNTRY_CODE."','all') AND status = 1");
$stmt2 -> execute();
$results = $stmt2 -> fetch();										
if($results['user']==$usr && $results['pass']==$pass){
	
$_SESSION['bgo_maxP'] = 0;
$_SESSION['bgo_planName'] = '';
 	
	if($results['profile']==100){
		$addr="access/admin/dashboard.php";
	}else if($results['profile']< 99 && $results['profile'] > 0 ){
	   $stmt3 = Conexion::conectar()->prepare("SELECT * FROM bgo_user_plan u INNER JOIN bgo_planes p ON u.up_planid = p.planid AND u.up_uid = '".$results['uid']."'");
	   $stmt3 -> execute();
	   $results3 = $stmt3 -> fetch();
	   $_SESSION['bgo_maxP'] = $results3["up_maxp"];
	   $_SESSION['bgo_planName'] = $results3["planname"];
	   $_SESSION['bgo_planDesc'] = intval($results3["up_destacadas"]);
	   $addr=burengoBaseUrl;
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
	$_SESSION['bgo_ccode'] = COUNTRY_CODE;
	
 
	$out['url'] = $addr;
	$out['ok'] = 1;
	$out['status'] = 1; 
}else{
	$out['ok'] = 0;
}
echo json_encode($out); 
?>