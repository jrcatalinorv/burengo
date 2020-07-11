<?php 
require_once "../../modelos/conexion.php";

$cd = $_REQUEST["cd"];

$stmt = Conexion::conectar()->prepare("SELECT c1.*, c2.* FROM bgo_currency c1
INNER JOIN bgo_country c2 ON c1.cur_cty = c2.cyid 
AND c1.cur_cty  = '".$cd."'");
$stmt -> execute();

while( $resultado = $stmt -> fetch()){
	echo '<tr>
            <td>'.$resultado['cur_code'].'</td>
            <td>'.$resultado['cur_str'].'</td>
            <td>'.$resultado['cur_sign'].'</td>
			<td>'.$resultado['cystr'].'</td>';
         if($resultado['cur_status']==1){ 
			echo '<td><span class="text-success"><strong> Activo </strong> </span></td>'; 
		 echo '<td>  
		 <div class="btn-group">
		   <button type="button" class="btn btn-warning editarCurrency" catId="'.$resultado['cur_id'].'" str="'.$resultado['cur_str'].'" code="'.$resultado['cur_code'].'"  sign="'.$resultado['cur_sign'].'" > &nbsp; <i class="fas fa-edit text-white"></i> &nbsp; </button> 
  		   <button type="button" class="btn btn-success changeStatus" nxid="'.$resultado['cur_id'].'" nxt="0"> &nbsp; <i class="fas fa-power-off"></i> &nbsp; </button>  
		 </div>
		 </td>';
			
		 }else{
			 echo '<td><span class="text-warning"><strong> Inactivo </strong> </span> </span></td>';
			echo '<td> 
			 <div class="btn-group">
		   <button type="button" class="btn btn-warning editarCurrency" catId="'.$resultado['cur_id'].'" str="'.$resultado['cur_str'].'" code="'.$resultado['cur_code'].'"  sign="'.$resultado['cur_sign'].'" > &nbsp; <i class="fas fa-edit text-white"></i> &nbsp; </button> 
  		   <button type="button" class="btn btn-secondary changeStatus"  nxid="'.$resultado['cur_id'].'" nxt="1">  &nbsp; <i class="fas fa-power-off"></i> &nbsp; </button> 
		   </div>
		   </td>';			 
		 }
		echo '</tr>';		
	}	
?>
	 