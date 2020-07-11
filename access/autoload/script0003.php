<?php 
date_default_timezone_set("America/Santo_Domingo");
require_once "../modelos/conexion.php";
$today = date('Y-m-d');
$stmt = Conexion::conectar()->prepare("SELECT * FROM bgo_posts WHERE bgo_duedate = '".$today."'");
$stmt -> execute();
WHILE($rest= $stmt-> fetch()){

echo $id= $rest['bgo_code']."<br>";
$ccode = $rest['bgo_country_code']; 

$stmt = Conexion::conectar()->prepare("DELETE FROM bgo_posts WHERE bgo_code = '".$id."'");
$stmt->execute();   
} 
?>