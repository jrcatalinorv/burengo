<?php 
require_once "../../modelos/conexion.php";
$stmt = Conexion::conectar()->prepare("SELECT m.*, mc.* FROM bgo_modelos_vehiculos m
INNER JOIN bgo_marcas_vehiculos mc ON m.mvd_marca = mc.mv_id");
$stmt -> execute();

while( $resultado = $stmt -> fetch()){
	echo '<tr>
            <td>'.$resultado['mvd_id'].'</td>
            <td>'.$resultado['mv_marca'].'</td>
			<td>'.$resultado['mvd_modelo'].'</td>';
         if($resultado['mvd_status']==1){ 
			echo '<td><span class="text-success"><strong> Activo </strong> </span></td>'; 
			echo '<td> 
			<div class="btn-group">
               <button type="button" class="btn btn-warning editarCategoria" catId="'.$resultado['mvd_id'].'" catId2="'.$resultado['mvd_marca'].'" catStr="'.$resultado['mvd_modelo'].'"  catStr2="'.$resultado['mv_marca'].'" > &nbsp; <i class="fas fa-edit text-white"></i> &nbsp; </button> 
			   <button type="button" class="btn btn-success changeStatus" nextCatState="0" catId="'.$resultado['mvd_id'].'" > &nbsp; <i class="fas fa-power-off"></i> &nbsp; </button>
			</div></td>';
			
		 }else{
			 echo '<td><span class="text-warning"><strong> Inactivo </strong> </span> </span></td>';
			echo '<td> 
			<div class="btn-group">
               <button type="button" class="btn btn-warning editarCategoria" catId="'.$resultado['mvd_id'].'" catStr="'.$resultado['mvd_modelo'].'" > &nbsp; <i class="fas fa-edit text-white"></i> &nbsp; </button> 
			   <button type="button" class="btn btn-secondary  changeStatus" nextCatState="1" catId="'.$resultado['mvd_id'].'" > &nbsp; <i class="fas fa-power-off"></i>    &nbsp;  </button>
			</div></td>';			 
		 }
		echo '</tr>';		
	}	
?> 