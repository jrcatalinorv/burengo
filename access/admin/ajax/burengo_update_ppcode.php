<?php 
require_once "../../modelos/conexion.php";
$code = 'bgo';
$paypalID = $_REQUEST["url"]; 

/* Insertar datos en la tabla factura */ 
$stmt = Conexion::conectar()->prepare("UPDATE bgo_cpinfo SET paypal_code = '".$paypalID."' WHERE cpcode = '".$code."'");
if($stmt->execute()){
   $out['ok'] = 1;
}else{
  $out['ok']  = 0;
  $out['err'] = $stmt->errorInfo();
}
echo json_encode($out); 
?>