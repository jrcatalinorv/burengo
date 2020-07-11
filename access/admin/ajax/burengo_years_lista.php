<?php 
require_once "../../modelos/conexion.php";
$stmt = Conexion::conectar()->prepare("SELECT * FROM bgo_active_years ORDER BY yr_str DESC");
$stmt -> execute();

while( $resultado = $stmt -> fetch()){
	echo '<tr>
            <td>'.$resultado['yr_str'].'</td>';
         if($resultado['yr_status']==1){ 
			echo '<td><span class="text-success"><strong> Activo </strong> </span></td>'; 
			echo '<td> 
			<button type="button" class="btn btn-block btn-warning btn-sm changeStatus" nxid="'.$resultado['yr_id'].'" nxt="0"> Inactivar </button>  
			</td>';
			
		 }else{
			 echo '<td><span class="text-warning"><strong> Inactivo </strong> </span> </span></td>';
			echo '<td> 
			  <button type="button" class="btn btn-block btn-success btn-sm changeStatus"  nxid="'.$resultado['yr_id'].'" nxt="1"> Activar </button>
			 </td>';			 
		 }
		echo '</tr>';		
	}	
?>
	 