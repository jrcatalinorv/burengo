<?php 
require_once "../modelos/conexion.php";
require_once "../modelos/functions.php";
require_once "../modelos/data.php";

$sb = $_REQUEST['sp'];
$tb = $_REQUEST['tp'];
$lw = $_REQUEST['lw'];
$hg = $_REQUEST['hg'];
$ac = $_REQUEST['me'];
$pageno = 1;
$no_of_records_per_page = 6;
$offset = ($pageno-1) * $no_of_records_per_page;

 $stmt2 = Conexion::conectar()->prepare(" SELECT p.*, pl.* FROM bgo_posts p 
 INNER JOIN bgo_places pl ON p.bgo_lugar = pl.pcid 
 AND p.bgo_status = 1 
 AND p.bgo_subcat = ".$sb." 
 AND p.bgo_cat = ".$tb." 
 AND p.bgo_price BETWEEN ".$lw." AND ".$hg." 
 AND p.bgo_country_code = '".COUNTRY_CODE."'
 AND p.bgo_code <> '".$ac."' LIMIT ".$offset.", ".$no_of_records_per_page."");			
 

$stmt2 -> execute();
while($results = $stmt2 -> fetch()){

echo '<div class="col-lg-2 col-md-1 visit itemSelection" itemId="'.$results['bgo_code'].'" itemCat="'.$results['bgo_subcat'].'" data-aos="fade-up">';
      

	  echo '<div class=" p-1"><img  src="media/thumbnails/'.$results['bgo_thumbnail'].'" alt="Image placeholder" class="img-fluid burengo-img-grid"> 
      <div style="z-index:999; margin-top:-2em;">'; 
if($results['bgo_cat']==1){	  
	 echo '<span class="badge bg-success bgo_mfont">$'.number_format($results['bgo_price'],2).' '.convert($results['bgo_uom']).' </span></div>';
}else{
	 echo '<span class="badge bg-warning bgo_mfont">$'.number_format($results['bgo_price'],2).' '.convert($results['bgo_uom']).' </span></div>';
}	  
	  echo '<h5 class="pt-2 bgo_font"> 
		  <small>'.softTrim($results['bgo_title'],18).'</small>';  
		echo '<br/>
		<small class="float-left"> <i class="fas fa-map-marker-alt text-danger"></i> '.$results['pcstr'].'  </small>
		<small>'; 
			if($results['bgo_cat']==1){
				echo '<span class="badge bg-success float-right "> Venta';   
					if($results['bgo_subcat']==1){
						echo ' <i class="fas fa-car"></i> ';
					}else{
						echo ' <i class="fas fa-home"></i> ';
					}
				echo '</span>';
			}else{
				echo ' <span class="badge bg-warning float-right"> Renta';  
					if($results['bgo_subcat']==1){
						echo ' <i class="fas fa-car"></i> ';
					}else{
						echo ' <i class="fas fa-home"></i> ';
					}

				echo '</span>';
			}
					
		echo '</small> </h5>
      <div class="reviews-star float-left">   
      </div>
 </div> </div>'; 
 }	
?>
 