<?php 
require_once "../modelos/conexion.php";
$id = $_REQUEST["id"];

$stmt = Conexion::conectar()->prepare("SELECT * FROM bgo_modelos_vehiculos 
WHERE mvd_status = 1 and mvd_marca = ".$id." ORDER BY mvd_modelo");
$stmt -> execute();

	echo '<option value="0"> Modelos </option>';

while( $resultado = $stmt -> fetch()){
	echo '<option value="'.$resultado['mvd_id'].'"> '.$resultado['mvd_modelo'].' </option>';		
	}	
?>
	 