<?php 
require_once "../modelos/conexion.php";

$stmt = Conexion::conectar()->prepare("SELECT * FROM bgo_fuel WHERE fstatus = 1");
$stmt -> execute();

	echo ' <option value="0"> Combustible </option>';

while( $resultado = $stmt -> fetch()){
	echo '<option value="'.$resultado['fid'].'"> '.$resultado['fstr'].' </option>';		
	}	
?>
	 