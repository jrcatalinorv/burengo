<?php 
session_start();
date_default_timezone_set("America/Santo_Domingo");
require_once "modelos/conexion.php";
require_once "modelos/data.php";
require_once "modelos/functions.php";

$usr = $_REQUEST['user'];

/*Buscar datos del Usuario */
$stmt2 = Conexion::conectar()->prepare("SELECT * FROM bgo_users WHERE uid = '".$usr."'"); 
$stmt2 -> execute();  
$rslts = $stmt2 -> fetch();
$use_img = $rslts["img"];
$use_nombre = $rslts["name"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="icon" type="image/png" href="<?php echo burengoBaseUrl; ?>favicon.ico"/>
  <title>Burengo.com</title>
  <link rel="stylesheet" href="<?php echo burengoBaseUrl; ?>plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?php echo burengoBaseUrl; ?>dist/css/adminlte.css">
  <link rel="stylesheet" href="<?php echo burengoBaseUrl; ?>dist/css/burengo-min.css">    
</head>
<body class="hold-transition layout-top-nav layout-navbar-fixed">
<div class="wrapper">
 <nav class="main-header navbar navbar-expand-md navbar-dark bg-navy"> 
    <div class="container">
      <a href="index.php" class="navbar-brand">
         <img src="<?php echo burengoBaseUrl; ?>dist/img/burengo.png" alt="Burengo Logo" class="brand-image   elevation-0" style="opacity: .8">  
      </a>
      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <ul class="navbar-nav"> </ul>
      </div>
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <li class="nav-item"><a class="nav-link" href="<?php echo burengoBaseUrl; ?>"> <?php echo burengo_portada; ?> </a></li>
		<li class="nav-item"><a class="nav-link">
			 <img alt="Avatar"  class="user-image" src="<?php echo burengoBaseUrl; ?>media/users/<?php echo $use_img; ?>">
			 <?php echo $use_nombre; ?></a>
		</li>
      </ul>
    </div>
  </nav>

  <div class="content-wrapper">
 <section class="content">
      <div class="container-fluid">
	   <div class="row">
         <div class="col-md-10 pt-2 mx-auto">
            <div class="card">
              <div class="card-body">
           <div class="row plist">
		   		 <?php
$stmt = Conexion::conectar()->prepare(" SELECT p.*, pl.*, cu.* FROM bgo_posts p 
INNER JOIN bgo_places pl ON p.bgo_lugar = pl.pcid 
INNER JOIN bgo_currency cu ON p.bgo_currency = cu.cur_id
AND p.bgo_status = 1 AND bgo_usercode = '".$usr."'");

$stmt -> execute();
while($results = $stmt -> fetch()){
$dest="";
$iconDesc="";
$imgNewClass="img-normal";
$valit = "";	
	
list($img_width, $img_height) = getimagesize(burengoBaseUrl."media/thumbnails/".$results['bgo_thumbnail']."");	

if( $results['bgo_stdesc'] == 9 ){ $dest = 'style="border: solid 4px #ffc926"'; $iconDesc=' <span class="text-warning"> <i class="fas fa-star"></i> </span>';  }
if( intval($img_height) >= intval($img_width) ){ $imgNewClass = "re-route";  $valit='';}


echo '<div class="col-lg-3  burengo_case visit itemSelection" itemId="'.$results['bgo_code'].'" itemCat="'.$results['bgo_subcat'].'" data-aos="fade-up">';
      
echo '<div   class="img-holder">
	  <div '.$dest.' class="burengo-img-grid">
	  <img   src="'.burengoBaseUrl.'media/thumbnails/'.$results['bgo_thumbnail'].'" alt="Image placeholder" class=" '.$imgNewClass.' "> 
     </div>
	  <div style="z-index:999; margin-top:-2em;" class="pl-2">'; 

  if($results['bgo_cat']==1){	  
	 echo '<span class="badge bg-success bgo_mfont"> '.$results["cur_sign"].' '.number_format($results['bgo_price']).' '.convert($results['bgo_uom']).' '.$valit.' </span>  
	  '.$iconDesc.'</div>';
  }else{
	 echo '<span class="badge bg-warning bgo_mfont"> '.$results["cur_sign"].' '.number_format($results['bgo_price']).' '.convert($results['bgo_uom']).' '.$valit.' </span>  
	'.$iconDesc.'</div>';
  }	
  
echo '<h5 class="pt-2 bgo_font"> '.softTrim($results['bgo_title'],25).'';  
	echo '<br/>
		<small class="float-left">  <i class="fas fa-map-marker-alt text-danger"></i> '.$results['pcstr'].'  </small>
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

/*
	  echo '<div class=" p-2"><img  src="'.burengoBaseUrl.'media/thumbnails/'.$results['bgo_thumbnail'].'" alt="Image placeholder" class="img-fluid burengo-img-grid"> 
      <div style="z-index:999; margin-top:-2em;">'; 
if($results['bgo_cat']==1){	  
	 echo '<span class="badge bg-success">$'.number_format($results['bgo_price'],2).' '.convert($results['bgo_uom']).' </span></div>';
}else{
	 echo '<span class="badge bg-warning">$'.number_format($results['bgo_price'],2).' '.convert($results['bgo_uom']).' </span></div>';
}	  
	  echo '<h5 class="pt-2"> 
		  <small>'. $results['bgo_title'] .'</small>';  
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
}*/		 
?>
</div>
</div><!-- /.card-body -->
        </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  </div>
  <!-- /.content-wrapper -->

 
 <footer class="main-footer"> Burengo &copy; 2020 - <?php echo burengo_copyright; ?>  </footer>
</div>
<script src="<?php echo burengoBaseUrl; ?>plugins/jquery/jquery.min.js"></script>
<script src="<?php echo burengoBaseUrl; ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo burengoBaseUrl; ?>dist/js/adminlte.min.js"></script>
<script src="<?php echo burengoBaseUrl; ?>dist/js/demo.js"></script>
<script type="text/javascript">
$('.plist').on("click", "div.itemSelection", function(){ 
	var id = $(this).attr('itemId');
	var cat = $(this).attr('itemCat');
	
	switch(cat){
		case '1': location.href="<?php echo burengoBaseUrl; ?>vehiculos.php?dtcd="+id; break;
		case '2': location.href="<?php echo burengoBaseUrl; ?>inmuebles.php?dtcd="+id; break;
	} 
});  
</script>
</body>
</html>
 