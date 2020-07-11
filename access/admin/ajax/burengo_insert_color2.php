<?php 
require_once "../../modelos/conexion.php";
$clrs_int_name = $_REQUEST["color"];
$clrs_int_status = 1; 

/* Insertar datos en la tabla factura */ 
$stmt = Conexion::conectar()->prepare("INSERT INTO bgo_colores_int(clrs_int_name,clrs_int_status) VALUES (:clrs_int_name,:clrs_int_status)");
$stmt->bindParam(":clrs_int_name",$clrs_int_name, PDO::PARAM_STR);
$stmt->bindParam(":clrs_int_status",$clrs_int_status, PDO::PARAM_INT);
 
if($stmt->execute()){
   $out['ok'] = 1;
}else{
  $out['ok']  = 0;
  $out['err'] = $stmt->errorInfo();
}
echo json_encode($out); 
?>