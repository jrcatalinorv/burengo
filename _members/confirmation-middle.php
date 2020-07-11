<?php 
session_start();
date_default_timezone_set("America/Santo_Domingo");
require_once "../modelos/conexion.php";
 
$plan = $_REQUEST["p"];
$uid = $_REQUEST["acc"];


if($plan==5){
$stmt0 = Conexion::conectar()->prepare("UPDATE bgo_user_plan SET up_destacadas = up_destacadas+1 WHERE up_uid = '".$uid."'");
$stmt0 -> execute();
 

echo '<script>	location.href="confirmation-destacados.php?p='.$plan.'&acc='.$uid.'"; </script>';

}else{
$stmt0 = Conexion::conectar()->prepare("UPDATE bgo_user_plan SET up_destacadas = 99999 WHERE up_uid = '".$uid."'");
$stmt0 -> execute();
 echo '<script>	location.href="confirmation-destacados.php?p='.$plan.'&acc='.$uid.'"; </script>';		
}
 
?>

 