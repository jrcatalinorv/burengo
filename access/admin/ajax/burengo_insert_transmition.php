<?php 
require_once "../../modelos/conexion.php";
$tsvstr = $_REQUEST["strt"];
$tsvstatus = 1; 

/* Insertar datos en la tabla factura */ 
$stmt = Conexion::conectar()->prepare("INSERT INTO bgo_transmision_vehiculo (tsvstr,tsvstatus) VALUES (:tsvstr,:tsvstatus)");
$stmt->bindParam(":tsvstr",$tsvstr, PDO::PARAM_STR);
$stmt->bindParam(":tsvstatus",$tsvstatus, PDO::PARAM_INT);
 
if($stmt->execute()){
   $out['ok'] = 1;
}else{
  $out['ok']  = 0;
  $out['err'] = $stmt->errorInfo();
}
echo json_encode($out); 
?>