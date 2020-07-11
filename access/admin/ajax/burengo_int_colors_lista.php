<?php 
require_once "../../modelos/conexion.php";
$stmt = Conexion::conectar()->prepare("SELECT  *  FROM bgo_colores_int");
$stmt -> execute();

while( $resultado = $stmt -> fetch()){
	
if($resultado["clrs_int_status"]==1){
	$cct = "text-success";
	$st = 0;
}else{
	$cct = "text-secondary";
	$st = 1;
}	
	
	echo '<li class="list-group-item p-1"><b> 
	<i class="fas fa-circle '.$cct.' "></i> '.$resultado["clrs_int_name"].'</b> 
	<a class="float-right changeStatus" nxid="'.$resultado["clrs_int_id"].'" nxt="'.$st.'"  >
	| &nbsp; <i class="fas fa-power-off '.$cct.' "></i> &nbsp; </a>  
	<a class="float-right editarCategoria" catId="'.$resultado["clrs_int_id"].'" catStr="'.$resultado["clrs_int_name"].'"  >
	&nbsp; <i class="fas fa-edit text-warning"></i> &nbsp; </a>  
	</li>';		
	}	
?>
	 