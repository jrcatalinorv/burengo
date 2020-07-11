<?php 
require_once "../../modelos/conexion.php";
$fuel = $_REQUEST["strfuel"];
$fstatus = 1; 

/* Insertar datos en la tabla factura */ 
$stmt = Conexion::conectar()->prepare("INSERT INTO bgo_fuel(fstr,fstatus) VALUES (:fstr,:fstatus)");
$stmt->bindParam(":fstr",$fuel, PDO::PARAM_STR);
$stmt->bindParam(":fstatus",$fstatus, PDO::PARAM_INT);
 
if($stmt->execute()){
   $out['ok'] = 1;
}else{
  $out['ok']  = 0;
  $out['err'] = $stmt->errorInfo();
}
echo json_encode($out); 
?>