<?php 
require_once "../modelos/conexion.php";

$FAVUID = $_REQUEST["user"];
$FAVPN = $_REQUEST["name"];
$FAVPTH = $_REQUEST["thump"];
$FAVPID = $_REQUEST["post"];

 
/* Insertar datos en la tabla factura */ 
$stmt = Conexion::conectar()->prepare("INSERT INTO bgo_whishlist (FAVUID,FAVPID,FAVPN,FAVPTH)VALUES(:FAVUID,:FAVPID,:FAVPN,:FAVPTH)");

$stmt->bindParam(":FAVUID",$FAVUID, PDO::PARAM_STR);
$stmt->bindParam(":FAVPID",$FAVPID, PDO::PARAM_STR);
$stmt->bindParam(":FAVPN",$FAVPN, PDO::PARAM_STR);
$stmt->bindParam(":FAVPTH",$FAVPTH, PDO::PARAM_STR);

if($stmt->execute()){
   $out['ok'] = 1;
}else{
  $out['ok']  = 0;
  $out['err'] = $stmt->errorInfo();
}
echo json_encode($out); 
?>