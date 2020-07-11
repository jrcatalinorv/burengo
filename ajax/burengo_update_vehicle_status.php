<?php 
require_once "../modelos/conexion.php";

$bgo_code = $_REQUEST["code"];

/* Insertar datos en la tabla factura */ 
$stmt = Conexion::conectar()->prepare("UPDATE bgo_posts SET bgo_status = 1 WHERE bgo_code = '".$bgo_code."'");
		 
 
if($stmt->execute()){
   $out['ok'] = 1;
}else{
  $out['ok']  = 0;
  $out['err'] = $stmt->errorInfo();
}
echo json_encode($out); 
?>