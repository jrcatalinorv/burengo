<?php 
require_once "../../modelos/conexion.php";
require_once "../../modelos/data.php";

$ct = $_REQUEST['cty'];

$stmt = Conexion::conectar()->prepare("SELECT * FROM bgo_places WHERE pcountry = '".$ct."'");
$stmt -> execute();

	echo '<option value="0"> Todas las Provincias </option>';
	
while( $results = $stmt -> fetch()){
	echo '<option value="'.$results["pcid"].'"> '.$results["pcstr"].' </option>';
}	
?> 