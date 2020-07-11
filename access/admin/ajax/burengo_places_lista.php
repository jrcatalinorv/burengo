<?php 
require_once "../../modelos/conexion.php";

$cd = $_REQUEST["cd"];

$stmt = Conexion::conectar()->prepare("SELECT p.*, c.* FROM bgo_places p INNER JOIN bgo_country c ON p.pcountry = c.cyid AND p.pcountry = '".$cd."' ORDER BY p.pcstr");
$stmt -> execute();

while( $resultado = $stmt -> fetch()){
	echo '<tr>
            <td>'.$resultado['pcstr'].'</td>
			<td>'.$resultado['cystr'].'</td>';
         if($resultado['pcstatus']==1){ 
			  echo '<td><span class="text-success"><strong> Activo </strong> </span></td>'; 
			  echo '<td>  
			  <div class="btn-group">
   
			   <button type="button" class="btn btn-warning editarCategoria" nxid="'.$resultado['pcid'].'" nxt="0" ="'.$resultado['tsvid'].'" catStr="'.$resultado['pcstr'].'" > &nbsp; <i class="fas fa-edit text-white"></i> &nbsp; </button> 
			   <button type="button" class="btn btn-success changeStatus" nxid="'.$resultado['pcid'].'" nxt="0" > &nbsp; <i class="fas fa-power-off"></i> &nbsp; </button>
			  
			  </div>
			  </td>';
		 }else{
			 echo '<td><span class="text-warning"><strong> Inactivo </strong> </span> </span></td>';
			 echo '<td> 
		 <div class="btn-group">
             <button type="button" class="btn btn-warning editarCategoria" nxid="'.$resultado['pcid'].'" catStr="'.$resultado['pcstr'].'" > &nbsp; <i class="fas fa-edit text-white"></i> &nbsp; </button> 
			 <button type="button" class="btn btn-secondary  changeStatus" nxid="'.$resultado['pcid'].'" nxt="1" > &nbsp; <i class="fas fa-power-off"></i>    &nbsp;  </button>
		</td>';			 
		 }
		echo '</tr>';		
	}	
?>
	 