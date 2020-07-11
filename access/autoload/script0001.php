<?php 
date_default_timezone_set("America/Santo_Domingo");
require_once "../modelos/conexion.php";
$today = date('Y-m-d');
$stmt = Conexion::conectar()->prepare("SELECT * FROM bgo_user_plan WHERE up_expdate = '".$today."'");
$stmt -> execute();
WHILE($rest= $stmt-> fetch()){
$stmt2 = Conexion::conectar()->prepare("UPDATE bgo_users SET profile = 7  WHERE uid = '".$rest['up_uid']."'");
$stmt2 -> execute();
$stmt3 = Conexion::conectar()->prepare("UPDATE bgo_user_plan SET up_planid = 7 , up_maxp = 0, up_maxf = 0  WHERE up_uid = '".$rest['up_uid']."'");
$stmt3 -> execute();
} 
?>