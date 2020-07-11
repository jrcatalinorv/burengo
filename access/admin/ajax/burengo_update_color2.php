<?php 
require_once "../../modelos/conexion.php";
$id = $_REQUEST["pid"];
$str = $_REQUEST["str"]; 

/* Insertar datos en la tabla factura */ 
$stmt = Conexion::conectar()->prepare("UPDATE bgo_colores_int SET clrs_int_name = '".$str."' WHERE clrs_int_id = '".$id."'");
if($stmt->execute()){
   $out['ok'] = 1;
}else{
  $out['ok']  = 0;
  $out['err'] = $stmt->errorInfo();
}
echo json_encode($out); 
?>