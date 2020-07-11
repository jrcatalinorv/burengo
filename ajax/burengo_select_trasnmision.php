<?php 
require_once "../modelos/conexion.php";

$stmt = Conexion::conectar()->prepare("SELECT * FROM bgo_transmision_vehiculo WHERE tsvstatus = 1");
$stmt -> execute();

echo ' <option value="0"> Transmision </option>';
while( $resultado = $stmt -> fetch()){
	echo '<option value="'.$resultado['tsvid'].'"> '.$resultado['tsvstr'].' </option>';		
	}	
?>
	 