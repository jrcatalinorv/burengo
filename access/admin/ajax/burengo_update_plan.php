<?php 
require_once "../../modelos/conexion.php";

$pn = $_REQUEST["plan"];
$nm = $_REQUEST["name"];
$pc = $_REQUEST["price"];
$dr = $_REQUEST["duration"]; 

/* Insertar datos en la tabla factura */ 
$stmt = Conexion::conectar()->prepare("UPDATE bgo_planes SET planname = '".$nm."' , planprice = ".$pc.", 
planduration = ".$dr." WHERE planid = '".$pn."'");
if($stmt->execute()){
   $out['ok'] = 1;
}else{
  $out['ok']  = 0;
  $out['err'] = $stmt->errorInfo();
}
echo json_encode($out); 
?>