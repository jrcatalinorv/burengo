<?php 
require_once "../../modelos/conexion.php";
$stmt = Conexion::conectar()->prepare("SELECT * FROM bgo_fuel");
$stmt -> execute();

while( $resultado = $stmt -> fetch()){
	echo '<tr>
            <td>'.$resultado['fid'].'</td>
            <td>'.$resultado['fstr'].'</td>';
         if($resultado['fstatus']==1){ 
			echo '<td><span class="text-success"><strong> Activo </strong> </span></td>'; 
			echo '<td> 
			<div class="btn-group">
               <button type="button" class="btn btn-warning editarCategoria" catId="'.$resultado['fid'].'" catStr="'.$resultado['fstr'].'" > &nbsp; <i class="fas fa-edit text-white"></i> &nbsp; </button> 
			   <button type="button" class="btn btn-success changeStatus" nextCatState="0" catId="'.$resultado['fid'].'" > &nbsp; <i class="fas fa-power-off"></i> &nbsp; </button>
			</div></td>';
			
		 }else{
			 echo '<td><span class="text-warning"><strong> Inactivo </strong> </span> </span></td>';
			echo '<td> 
			<div class="btn-group">
               <button type="button" class="btn btn-warning editarCategoria" catId="'.$resultado['fid'].'" catStr="'.$resultado['fstr'].'" > &nbsp; <i class="fas fa-edit text-white"></i> &nbsp; </button> 
			   <button type="button" class="btn btn-secondary  changeStatus" nextCatState="1" catId="'.$resultado['fid'].'" > &nbsp; <i class="fas fa-power-off"></i>    &nbsp;  </button>
			</div></td>';			 
		 }
		echo '</tr>';		
	}	
?>
	 