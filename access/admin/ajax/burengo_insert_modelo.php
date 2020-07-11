<?php 
require_once "../../modelos/conexion.php";
$model = $_REQUEST["modelo"];
$marca     = $_REQUEST["marca"];
$status = 1; 

/* Insertar datos en la tabla factura */ 
$stmt = Conexion::conectar()->prepare("INSERT INTO bgo_modelos_vehiculos(mvd_marca,mvd_modelo,mvd_status) VALUES (:mvd_marca,:mvd_modelo,:mvd_status)");
$stmt->bindParam(":mvd_marca",$marca, PDO::PARAM_INT);
$stmt->bindParam(":mvd_modelo",$model, PDO::PARAM_STR);
$stmt->bindParam(":mvd_status",$status, PDO::PARAM_INT);
 
if($stmt->execute()){
   $out['ok'] = 1;
}else{
  $out['ok']  = 0;
  $out['err'] = $stmt->errorInfo();
}
echo json_encode($out); 
?>