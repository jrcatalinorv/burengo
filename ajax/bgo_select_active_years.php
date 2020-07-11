<?php 
require_once "../modelos/conexion.php";

$stmt = Conexion::conectar()->prepare("SELECT * FROM bgo_active_years WHERE yr_status = 1 ORDER BY yr_id DESC");
$stmt -> execute();

	echo '<option value="0"> Seleccione el Año </option>';

while( $resultado = $stmt -> fetch()){
	echo '<option value="'.$resultado['yr_str'].'"> '.$resultado['yr_str'].' </option>';		
	}	
?>
	 