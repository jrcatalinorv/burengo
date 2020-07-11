<?php 
require_once "../../modelos/conexion.php";
$tv_name = $_REQUEST["strt"];
$tv_status = 1; 

/* Insertar datos en la tabla factura */ 
$stmt = Conexion::conectar()->prepare("INSERT INTO bgo_traccion_vehiculo (tv_name,tv_status) VALUES (:tv_name,:tv_status)");
$stmt->bindParam(":tv_name",$tv_name, PDO::PARAM_STR);
$stmt->bindParam(":tv_status",$tv_status, PDO::PARAM_INT);
 
if($stmt->execute()){
   $out['ok'] = 1;
}else{
  $out['ok']  = 0;
  $out['err'] = $stmt->errorInfo();
}
echo json_encode($out); 
?>