<?php 
require_once "../../modelos/conexion.php";
$code = 'bgo';
$name= trim($_REQUEST["nm"]); 
$mail= trim($_REQUEST["ml"]); 
$addr= trim($_REQUEST["ad"]); 
$phone= trim($_REQUEST["ph"]); 

/* Insertar datos en la tabla factura */ 
$stmt = Conexion::conectar()->prepare("UPDATE bgo_cpinfo SET cpname = '".$name."', cpemail = '".$mail."', cpaddr = '".$addr."', cpphone = '".$phone."' WHERE cpcode = '".$code."'");
if($stmt->execute()){
   $out['ok'] = 1;
}else{
  $out['ok']  = 0;
  $out['err'] = $stmt->errorInfo();
}
echo json_encode($out); 
?>