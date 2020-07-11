<?php 
require_once "../modelos/conexion.php";
$id = $_REQUEST["pid"];
$src = '../media/users/'.$id.'/';

$stmt = Conexion::conectar()->prepare("DELETE FROM bgo_users WHERE uid = '".$id."'");
 if($stmt->execute()){
	$out['ok']  = 1;
 }else{
	$out['ok']  = 0;
   $out['err'] = $stmt->errorInfo();
 }
echo json_encode($out); 
?>