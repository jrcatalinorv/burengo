<?php 
require_once "../../modelos/conexion.php";
$categoria = strtoupper($_REQUEST["strcategoria"]);
$status = 1; 

/* Insertar datos en la tabla factura */ 
$stmt = Conexion::conectar()->prepare("INSERT INTO bgo_marcas_vehiculos(mv_marca,mv_status) VALUES (:mv_marca,:mv_status)");
$stmt->bindParam(":mv_marca",$categoria, PDO::PARAM_STR);
$stmt->bindParam(":mv_status",$status, PDO::PARAM_INT);
 
if($stmt->execute()){
   $out['ok'] = 1;
}else{
  $out['ok']  = 0;
  $out['err'] = $stmt->errorInfo();
}
echo json_encode($out); 
?>