<?php 
require_once "../modelos/conexion.php";

$stmt = Conexion::conectar()->prepare("SELECT * FROM bgo_colores_int WHERE clrs_int_status = 1");
$stmt -> execute();

	echo ' <option option="0"> Color Interior </option>';

while( $resultado = $stmt -> fetch()){
	echo '<option value="'.$resultado['clrs_int_id'].'"> '.$resultado['clrs_int_name'].' </option>';		
	}	
?>
	 