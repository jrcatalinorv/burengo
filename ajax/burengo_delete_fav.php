<?php 
require_once "../modelos/conexion.php";
$uid = $_REQUEST["uid"];
$pid = $_REQUEST["pid"];

$stmt = Conexion::conectar()->prepare("DELETE FROM bgo_whishlist WHERE FAVUID = '".$uid."' AND FAVPID ='".$pid."'");
 if($stmt->execute()){	 
	$out['ok']  = 1;
 }else{
	$out['ok']  = 0;
   $out['err'] = $stmt->errorInfo();
 }
echo json_encode($out); 
?>