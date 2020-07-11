<?php 
session_start();
require_once "../modelos/conexion.php";

/*------------------------------------------*/
$vst_post = $_REQUEST["code"];
$vstdate = date('Y-m-d'); 
/*------------------------------------------*/

/* Insertar datos en la tabla factura */ 
$stmt = Conexion::conectar()->prepare("INSERT INTO bgo_visits(vstdate,vst_post) VALUES (:vstdate,:vst_post)");
$stmt->bindParam(":vstdate",$vstdate, PDO::PARAM_STR);
$stmt->bindParam(":vst_post",$vst_post, PDO::PARAM_STR);
 
if($stmt->execute()){
   $out['ok'] = 1;
}else{
  $out['ok']  = 0;
  $out['err'] = $stmt->errorInfo();
}
echo json_encode($out); 
?>