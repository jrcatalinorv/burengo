<?php 
require_once "../../modelos/conexion.php";


$id =  trim($_REQUEST["id"]);
$cur_code =  trim($_REQUEST["code"]);
$cur_str =  trim($_REQUEST["currency"]);
$cur_sign =  trim($_REQUEST["sign"]);
$cur_cty =  trim($_REQUEST["country"]);
$cur_status = 1;

/* Insertar datos en la tabla factura */ 
$stmt = Conexion::conectar()->prepare("UPDATE bgo_currency SET cur_code = '".$cur_code."', cur_str = '".$cur_str."', cur_sign = '".$cur_sign."', cur_cty = '".$cur_cty."' WHERE cur_id = '".$id."'");
if($stmt->execute()){
   $out['ok'] = 1;
}else{
  $out['ok']  = 0;
  $out['err'] = $stmt->errorInfo();
}
echo json_encode($out); 
?>