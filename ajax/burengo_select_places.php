<?php 
require_once "../modelos/conexion.php";
require_once "../modelos/data.php";

$stmt = Conexion::conectar()->prepare("SELECT * FROM bgo_places WHERE pcstatus = 1 AND pcountry = '".COUNTRY_CODE."'");
$stmt -> execute();



	echo ' <option value="0"> Provincia </option>';

while( $resultado = $stmt -> fetch()){
	echo '<option value="'.$resultado['pcid'].'"> '.$resultado['pcstr'].' </option>';		
	}	
?>
	 