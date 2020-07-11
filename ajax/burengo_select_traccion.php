<?php 
require_once "../modelos/conexion.php";

$stmt = Conexion::conectar()->prepare("SELECT * FROM bgo_traccion_vehiculo WHERE tv_status = 1");
$stmt -> execute();

	echo ' <option value="0"> Traccion </option>';

while( $resultado = $stmt -> fetch()){
	echo '<option value="'.$resultado['tv_id'].'"> '.$resultado['tv_name'].' </option>';		
	}	
?>
	 