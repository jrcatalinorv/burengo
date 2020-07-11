<?php 
require_once "../../modelos/conexion.php";
$id  = $_REQUEST["pid"];
$id2 = $_REQUEST["mid"];
$str = $_REQUEST["str"]; 

/* Insertar datos en la tabla factura */ 
$stmt = Conexion::conectar()->prepare("UPDATE bgo_modelos_vehiculos 
	SET mvd_modelo = '".$str."', mvd_marca = ".$id2." 
	WHERE mvd_id = '".$id."'");
if($stmt->execute()){
   $out['ok'] = 1;
}else{
  $out['ok']  = 0;
  $out['err'] = $stmt->errorInfo();
}
echo json_encode($out); 
?>