<?php 
require_once "../modelos/conexion.php";
require_once "../modelos/data.php";

$stmt = Conexion::conectar()->prepare("SELECT * FROM bgo_currency WHERE cur_status = 1 AND cur_cty ='".COUNTRY_CODE."'");
$stmt -> execute();

	echo '<option value="0"> Tipo de Moneda </option>';

while( $resultado = $stmt -> fetch()){
	echo '<option value="'.$resultado['cur_id'].'"> '.$resultado['cur_str'].' </option>';		
	}	
?>
	 