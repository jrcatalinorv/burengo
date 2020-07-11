<?php 
session_start();
require_once "../modelos/conexion.php";
require_once "../modelos/functions.php";
require_once "../modelos/data.php";

$sb = $_REQUEST['typo'];

switch($sb){
	case 1: $stmt  = Conexion::conectar()->prepare(" SELECT p.*, pl.* FROM bgo_posts p INNER JOIN bgo_places pl ON p.bgo_lugar = pl.pcid AND p.bgo_usercode='".$_SESSION['bgo_userId']."' AND bgo_subcat = 1 "); break;		 break;
	case 2: $stmt  = Conexion::conectar()->prepare(" SELECT p.*, pl.* FROM bgo_posts p INNER JOIN bgo_places pl ON p.bgo_lugar = pl.pcid AND p.bgo_usercode='".$_SESSION['bgo_userId']."' AND bgo_subcat = 2 ");break;
	default: $stmt = Conexion::conectar()->prepare(" SELECT p.*, pl.* FROM bgo_posts p INNER JOIN bgo_places pl ON p.bgo_lugar = pl.pcid AND p.bgo_usercode='".$_SESSION['bgo_userId']."' ");break;
}
 	
$stmt -> execute();
while($results = $stmt -> fetch()){
$dest = 'style="width: 250px; height:100px; overflow:hidden; display:block; margin-left: auto; margin-right: auto;" ';	
if($results['bgo_stdesc'] ==9){ $dest = 'style="  width: 250px; height:100px; overflow:hidden; display:block; margin-left: auto; margin-right: auto;"';  }	
	
echo '<div class="col-12 col-sm-4 col-md-3 d-flex align-items-stretch itemSelection" itemId="'.$results['bgo_code'].'">
              <div class="card bg-light">
                <div class="card-header text-muted border-bottom-0">';
                  
				   if($results['bgo_subcat']==1){
					   echo '<span class="badge bg-info float-right"> Vehiculos </span>';
				   }else{ 
					   echo '<span class="badge bg-info float-right"> Inmnuebles </span>';
				   }
			 
				   
               echo '</div>
                <div class="card-body pt-1">
                  <div class="row">
                    <div class="col-7">
                      <h3 class="lead"><b> '.$results['bgo_title'].'</b></h3>
                  
                      <ul class="ml-4 mb-0 fa-ul ">';
                    
						
						
					if($results['bgo_cat']==1){
						if($results['bgo_subcat']==1){
							echo '<li class="small pt-1"><span class="fa-li"><i class="fas fa-car fa-lg text-info"></i></span> Venta </li>';
						}else{
							echo '<li class="small pt-1"><span class="fa-li"><i class="fas fa-home fa-lg text-info"></i></span> Venta </li>';
						}
					  }else{
							if($results['bgo_subcat']==1){
							echo '<li class="small pt-1"><span class="fa-li"><i class="fas fa-car fa-lg text-info"></i></span> Renta </li>';
							}else{
								echo '<li class="small pt-1"><span class="fa-li"><i class="fas fa-home fa-lg text-info"></i></span> Renta </li>';
							}
						}
						
						echo '<li class="small pt-1"><span class="fa-li"><i class="fas fa-lg fa-dollar-sign text-info"></i></span>'.number_format($results['bgo_price'],2).' '.convert($results['bgo_uom']).' <li>
                      	 
						 <li class="small pt-1"><span class="fa-li"><i class="fas fa-lg fa-map-marker-alt text-danger"></i></span>'.$results['pcstr'].'</li>'; 
						 
						 if($results['bgo_status']>=1){
						     echo '<li class="small pt-1"><span class="fa-li"><i class="fas fa-circle text-success"></i></span> Activo </li>'; 
						 }else{	
						   echo '<li class="small pt-1"><span class="fa-li"><i class="fas fa-circle text-secondary"></i></span></span> Inactivo </li>'; 
                           }
					 echo '</ul>
                    </div>
                    <div class="col-sm-5 text-center" '.$dest.' >
                      <img  style="width: 200px;"  src="media/thumbnails/'.$results['bgo_thumbnail'].'" alt="" class="img-fluid">
                    
					</div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                     <div class="btn-group">';
                       
					   
					   if($results['bgo_stdesc'] ==9){
						   echo '<button class="btn btn-sm btn-info destc" itemId="'.$results['bgo_code'].'" title="Destacada" >  &nbsp; <i class="fas fa-star text-warning"></i> &nbsp;  </button>';
						
					   }else{
							echo '<button class="btn btn-sm btn-info dest" itemId="'.$results['bgo_code'].'" title="Destacar">  &nbsp; <i class="far fa-star"></i> &nbsp;  </button>';
						
					   }
					   
						echo'<button type="button" class="btn btn-primary edit" itemId="'.$results['bgo_code'].'" tp="'.$results['bgo_subcat'].'"  tps="'.$results['bgo_cat'].'" title="Editar"> &nbsp; <i class="fas fa-edit"></i> &nbsp; </button>';
                    
						if($results['bgo_status'] >=1){					   
							echo '<button type="button" class="btn btn-warning btn-sm changeStatus" itemId="'.$results['bgo_code'].'" ns="0" title="Inactivar"> &nbsp; <i class="fas fa-power-off"></i> &nbsp; </button>';
						}else{
							echo '<button type="button" class="btn btn-success btn-sm changeStatus" itemId="'.$results['bgo_code'].'" ns="1" title="Activar"> &nbsp; <i class="fas fa-power-off"></i> &nbsp; </button>';
                        }
						
						echo '<button type="button" class="btn btn-danger btn-sm deletePost" itemId="'.$results['bgo_code'].'" title="Borrar"> &nbsp; <i class="fas fa-trash"></i> &nbsp; </button>
                      </div>
                  </div>
                </div>
              </div>
            </div>';	
}	 
?>
 