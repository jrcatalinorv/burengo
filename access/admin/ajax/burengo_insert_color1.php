<?php 
require_once "../../modelos/conexion.php";
$clrs_name = $_REQUEST["color"];
$clrs_status = 1; 

/* Insertar datos en la tabla factura */ 
$stmt = Conexion::conectar()->prepare("INSERT INTO bgo_colores(clrs_name,clrs_status) VALUES (:clrs_name,:clrs_status)");
$stmt->bindParam(":clrs_name",$clrs_name, PDO::PARAM_STR);
$stmt->bindParam(":clrs_status",$clrs_status, PDO::PARAM_INT);
 
if($stmt->execute()){
   $out['ok'] = 1;
}else{
  $out['ok']  = 0;
  $out['err'] = $stmt->errorInfo();
}
echo json_encode($out); 
?>