<?php 
require_once "../../modelos/conexion.php";
$user = $_REQUEST["user"];
$pid = $_REQUEST["planid"];
$date = date('Y-m-d'); 
$up_expdate =  date('Y-m-d', strtotime($date. ' + 30 days'));


/* Colocar datos del plan */
$stmt2 = Conexion::conectar()->prepare("SELECT * FROM bgo_planes WHERE planid = ".$pid."");
$stmt2 -> execute();
$results = $stmt2 -> fetch();

$max_fotos = $results['planmaxf'];
$max_post = $results['planmaxp'];


/* Actualizar los datos */
$stmt0 = Conexion::conectar()->prepare("UPDATE bgo_user_plan SET up_planid = ".$pid." , up_maxp =".$max_post." , up_maxf =".$max_fotos." , up_expdate = '".$up_expdate."' WHERE up_uid = '".$user."'");
if($stmt0 -> execute()){

$stmt = Conexion::conectar()->prepare(" UPDATE bgo_users SET profile = ".$pid.", status = 1 WHERE uid = '".$user."'");
$stmt -> execute();

$out['ok'] = 1;

}else{
	
  $out['ok']  = 0;
  $out['err'] = $stmt0->errorInfo();	
}
 
echo json_encode($out); 
?>