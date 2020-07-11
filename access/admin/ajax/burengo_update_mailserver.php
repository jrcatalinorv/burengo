<?php 
require_once "../../modelos/conexion.php";
$code = 'bgo';
$host= trim($_REQUEST["host"]); 
$port= trim($_REQUEST["port"]); 
$user= trim($_REQUEST["user"]); 
$pass= trim($_REQUEST["pass"]); 

/* Insertar datos en la tabla factura */ 
$stmt = Conexion::conectar()->prepare("UPDATE bgo_mail_server SET mail_host = '".$host."', mail_port = '".$port."', mail_user = '".$user."', mail_pass = '".$pass."' WHERE site_code = '".$code."'");
if($stmt->execute()){
   $out['ok'] = 1;
}else{
  $out['ok']  = 0;
  $out['err'] = $stmt->errorInfo();
}
echo json_encode($out); 
?>