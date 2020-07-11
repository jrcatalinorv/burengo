<?php 
require_once "../modelos/conexion.php";
$stmt = Conexion::conectar()->prepare("SELECT  *  FROM bgo_colores");
$stmt -> execute();



while( $resultado = $stmt -> fetch()){
	
if($resultado["clrs_status"]==1){
	$cct = "text-success";
}else{
	$cct = "text-secondary";
}	
	
	echo '<li class="list-group-item"><b> <i class="fas fa-circle '.$cct.' "></i> '.$resultado["clrs_name"].'</b> 
	<a class="float-right">
	<small>
	<i class="fas fa-edit text-warning"></i> Editar </a>
	</small>
	</li>';		
	}	
?>
	 