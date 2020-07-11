<?php 
require_once "../../modelos/conexion.php";

$cur_code =  $_REQUEST["code"];
$cur_str =  $_REQUEST["currency"];
$cur_sign =  $_REQUEST["sign"];
$cur_cty =  $_REQUEST["country"];
$cur_status = 1;

 

/* Insertar datos en la tabla factura */ 
$stmt = Conexion::conectar()->prepare("INSERT INTO bgo_currency(cur_code,cur_str,cur_sign,cur_cty,cur_status) 
VALUES (:cur_code,:cur_str,:cur_sign,:cur_cty,:cur_status)");
$stmt->bindParam(":cur_code",$cur_code, PDO::PARAM_STR);
$stmt->bindParam(":cur_str",$cur_str, PDO::PARAM_STR);
$stmt->bindParam(":cur_sign",$cur_sign, PDO::PARAM_STR);
$stmt->bindParam(":cur_cty",$cur_cty, PDO::PARAM_STR);
$stmt->bindParam(":cur_status",$cur_status, PDO::PARAM_INT);
 
if($stmt->execute()){
   $out['ok'] = 1;
}else{
  $out['ok']  = 0;
  $out['err'] = $stmt->errorInfo();
}
echo json_encode($out); 
?>