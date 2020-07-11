<?php 
require_once "../modelos/conexion.php";
$stmt = Conexion::conectar()->prepare("SELECT * FROM bgo_marcas_vehiculos 
WHERE mv_status = 1 ORDER BY mv_marca");
$stmt -> execute();

	echo '<option value="0" > Marcas </option>';

while( $resultado = $stmt -> fetch()){
	echo '<option value="'.$resultado['mv_id'].'"> '.$resultado['mv_marca'].' </option>';		
	}	
?>
	 