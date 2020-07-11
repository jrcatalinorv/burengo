<?php 
require_once "../../modelos/conexion.php";
$pcountry = $_REQUEST['code'];
$pcstr = $_REQUEST["place"];
$pcstatus = 1; 

/* Insertar datos en la tabla factura */ 
$stmt = Conexion::conectar()->prepare("INSERT INTO bgo_places (pcstr,pcountry,pcstatus) VALUES (:pcstr,:pcountry,:pcstatus)");
$stmt->bindParam(":pcstr",$pcstr, PDO::PARAM_STR);
$stmt->bindParam(":pcountry",$pcountry, PDO::PARAM_STR);
$stmt->bindParam(":pcstatus",$pcstatus, PDO::PARAM_INT);
 
if($stmt->execute()){
   $out['ok'] = 1;
}else{
  $out['ok']  = 0;
  $out['err'] = $stmt->errorInfo();
}
echo json_encode($out); 
?>