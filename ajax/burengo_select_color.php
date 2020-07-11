<?php 
require_once "../modelos/conexion.php";

$stmt = Conexion::conectar()->prepare("SELECT * FROM bgo_colores WHERE clrs_status = 1");
$stmt -> execute();

	echo ' <option value="0"> Color </option>';

while( $resultado = $stmt -> fetch()){
	echo '<option value="'.$resultado['clrs_id'].'"> '.$resultado['clrs_name'].' </option>';		
	}	
?>
	 