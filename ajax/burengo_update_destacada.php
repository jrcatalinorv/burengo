<?php 
require_once "../modelos/conexion.php";
$id = $_REQUEST["pid"];
$status = $_REQUEST["status"]; 
$option = $_REQUEST["option"];

if($option==1){
  $stmt = Conexion::conectar()->prepare("UPDATE bgo_posts SET bgo_stdesc = 9 WHERE bgo_code = '".$id."'");
}else{
  $stmt = Conexion::conectar()->prepare("UPDATE bgo_posts SET bgo_stdesc = ".$status." WHERE bgo_code = '".$id."'");
}

if($stmt->execute()){
   $out['ok'] = 1;
}else{
  $out['ok']  = 0;
  $out['err'] = $stmt->errorInfo();
}
echo json_encode($out); 
?>