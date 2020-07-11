<?php 
require_once "../modelos/conexion.php";
$msgid = "MSG".date('YmdHis').rand(1000,9999);
$usrfrom = $_REQUEST["from"];
$usrto = $_REQUEST["to"];
$toemail = $_REQUEST["email"];
$msgtext = $_REQUEST["msg"];
$msgpost = $_REQUEST["post"];
$replyto = $_REQUEST["reply"];

/* Insertar datos en la tabla factura */ 
$stmt = Conexion::conectar()->prepare("INSERT INTO bgo_msg(msgid,replyto,usrfrom,usrto,toemail,msgtext,msgpost)VALUES(:msgid,:replyto,:usrfrom,:usrto,:toemail,:msgtext,:msgpost)");

$stmt->bindParam(":msgid",$msgid, PDO::PARAM_STR);
$stmt->bindParam(":replyto",$replyto, PDO::PARAM_STR);
$stmt->bindParam(":usrfrom",$usrfrom, PDO::PARAM_STR);
$stmt->bindParam(":usrto",$usrto, PDO::PARAM_STR);
$stmt->bindParam(":toemail",$toemail, PDO::PARAM_STR);
$stmt->bindParam(":msgtext",$msgtext, PDO::PARAM_STR);
$stmt->bindParam(":msgpost",$msgpost, PDO::PARAM_STR);
 
if($stmt->execute()){
   $out['ok'] = 1;
}else{
  $out['ok']  = 0;
  $out['err'] = $stmt->errorInfo();
}
echo json_encode($out); 
?>