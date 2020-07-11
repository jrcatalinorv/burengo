<?php 
require_once "../../modelos/conexion.php";
$stmt = Conexion::conectar()->prepare("SELECT * FROM bgo_transmision_vehiculo");
$stmt -> execute();

while( $resultado = $stmt -> fetch()){
	echo '<tr>
            <td>'.$resultado['tsvid'].'</td>
            <td>'.$resultado['tsvstr'].'</td>';
         if($resultado['tsvstatus']==1){ 
			echo '<td><span class="text-success"><strong> Activo </strong> </span></td>'; 
			echo '<td> 
			<div class="btn-group">
               <button type="button" class="btn btn-warning editarCategoria" catId="'.$resultado['tsvid'].'" catStr="'.$resultado['tsvstr'].'" > &nbsp; <i class="fas fa-edit text-white"></i> &nbsp; </button> 
			   <button type="button" class="btn btn-success changeStatus" nextCatState="0" catId="'.$resultado['tsvid'].'" > &nbsp; <i class="fas fa-power-off"></i> &nbsp; </button>
			</div></td>';
			
		 }else{
			 echo '<td><span class="text-warning"><strong> Inactivo </strong> </span> </span></td>';
			echo '<td> 
			<div class="btn-group">
               <button type="button" class="btn btn-warning editarCategoria" catId="'.$resultado['tsvid'].'" catStr="'.$resultado['tsvstr'].'" > &nbsp; <i class="fas fa-edit text-white"></i> &nbsp; </button> 
			   <button type="button" class="btn btn-secondary  changeStatus" nextCatState="1" catId="'.$resultado['tsvid'].'" > &nbsp; <i class="fas fa-power-off"></i>    &nbsp;  </button>
			</div></td>';			 
		 }
		echo '</tr>';		
	}	
?>
	 