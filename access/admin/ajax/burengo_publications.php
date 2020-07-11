<?php 
require_once "../../modelos/conexion.php";
require_once "../../modelos/functions.php";

$tp = $_REQUEST["tp"];
 

if($tp=='all'){

	$stmt = Conexion::conectar()->prepare(" SELECT p.*, pl.* FROM bgo_posts p
INNER JOIN bgo_places pl ON p.bgo_lugar = pl.pcid");
	
}else{
	$stmt = Conexion::conectar()->prepare(" SELECT p.*, pl.* FROM bgo_posts p
INNER JOIN bgo_places pl ON p.bgo_lugar = pl.pcid AND bgo_subcat = ".$tp."");	
} 
 
$stmt -> execute();
while($results = $stmt -> fetch()){

$cd = $results["bgo_country_code"];
	
echo '<div class="col-12 col-sm-4 col-md-3 d-flex align-items-stretch itemSelection" itemId="'.$results['bgo_code'].'"">
              <div class="card bg-light">
                <div class="card-header text-muted border-bottom-0">'; 
               echo '</div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b><small>'.$results['bgo_title'].'</small></b></h2>
                  
                      <ul class="ml-4 mb-0 fa-ul text-muted">';
                    
						
						
					if($results['bgo_cat']==1){
						if($results['bgo_subcat']==1){
							echo '<li class="small pt-1"><span class="fa-li"><i class="fas fa-car fa-lg"></i></span> Venta </li>';
						}else{
							echo '<li class="small pt-1"><span class="fa-li"><i class="fas fa-home fa-lg"></i></span> Venta </li>';
						}
					  }else{
							if($results['bgo_subcat']==1){
							echo '<li class="small pt-1"><span class="fa-li"><i class="fas fa-car fa-lg"></i></span> Renta </li>';
							}else{
								echo '<li class="small pt-1"><span class="fa-li"><i class="fas fa-home fa-lg"></i></span> Renta </li>';
							}
						}
						
						echo '<li class="small pt-1"><span class="fa-li"><i class="fas fa-lg fa-dollar-sign"></i></span>'.number_format($results['bgo_price'],2).' '.convert($results['bgo_uom']).' <li>
                      	 <li class="small pt-1"><span class="fa-li"><i class="fas fa-lg fa-map-marker"></i></span>'.$results['pcstr'].'</li>';      
					  
					  if($results['bgo_status']==1){
						     echo '<li class="small pt-1"><span class="fa-li"><i class="fas fa-circle text-success"></i></span> Activo </li>'; 
						 }else{	
						   echo '<li class="small pt-1"><span class="fa-li"><i class="fas fa-circle text-secondary"></i></span></span> Inactivo </li>'; 
                           }
					  
					  echo '</ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="../../'.$cd.'/media/thumbnails/'.$results['bgo_thumbnail'].'" alt="" class="  img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                     <div class="btn-group">';
                       
						if($results['bgo_status']==1){					   
							echo '<button type="button" class="btn btn-warning changeStatus"  itemId="'.$results['bgo_code'].'" ns="0"><i class="fas fa-power-off"></i> Inactivar </button>';
						}else{
							echo '<button type="button" class="btn btn-success changeStatus"  itemId="'.$results['bgo_code'].'" ns="1"><i class="fas fa-power-off"></i>Activar </button>';
                        }
						
						echo '<button type="button" class="btn btn-danger deletePost" itemId="'.$results['bgo_code'].'"   countryCode="'.$results['bgo_country_code'].'"><i class="fas fa-trash"></i> Borrar </button>
                      </div>
                  </div>
                </div>
              </div>
            </div>';	
}	
?>

 