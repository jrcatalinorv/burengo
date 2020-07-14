<?php
session_start(); 
date_default_timezone_set("America/Santo_Domingo");
require_once "modelos/conexion.php";
require_once "modelos/functions.php";
require_once "modelos/data.php";
require_once "modelos/settings.php";
$code = rand(1000000,9999999) ;

  if(isset($_SESSION["bgoSesion"]) && $_SESSION["bgoSesion"] == "ok"){

$stmt = Conexion::conectar()->prepare(" SELECT COUNT(bgo_code) as totalpv FROM bgo_posts WHERE bgo_usercode = '".$_SESSION['bgo_userId']."'");
$stmt -> execute();
$results = $stmt-> fetch();
$total_postv = number_format($results['totalpv']);

  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="generator" content="Catalino&Co">
  <link rel="icon" type="image/png" href="<?php echo burengoBaseUrl; ?>favicon.ico"/>
  <title> Burengo - Compra, renta o vende vehículos e inmuebles </title>
  <link rel="stylesheet" href="<?php echo burengoBaseUrl; ?>dist/css/pagination.css">
  <link rel="stylesheet" href="<?php echo burengoBaseUrl; ?>plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?php echo burengoBaseUrl; ?>dist/css/adminlte.css">
  <link rel="stylesheet" href="<?php echo burengoBaseUrl; ?>plugins/toastr/toastr.min.css"> 
  <link rel="stylesheet" href="<?php echo burengoBaseUrl; ?>plugins/flag-icon-css-master/css/flag-icon.css" >
  <link rel="stylesheet" href="<?php echo burengoBaseUrl; ?>/plugins/bootstrap-slider/css/bootstrap-slider.min.css">  
  <link rel="stylesheet" href="<?php echo burengoBaseUrl; ?>dist/css/burengo-min.css">  
  <style> @media only screen and (min-width: 320px) and (max-width: 534px){ .linkWeb{ display:none;} }</style> 
<!---------------- Anuncios ----------------------->


<!--------------------------------------------------->
</head>
<body class="hold-transition layout-top-nav layout-navbar-fixed">
<div class="wrapper">
<nav class="main-header navbar navbar-expand-md navbar-dark bg-navy"> 
    <div class="container">
      <a href="<?php echo burengoBaseUrl; ?>" class="navbar-brand"><img src="<?php echo burengoBaseUrl; ?>dist/img/burengo.png" alt="Burengo Logo" class="brand-image   elevation-0" style="opacity: .8"></a>
      <div class="collapse navbar-collapse order-3" id="navbarCollapse"><ul class="navbar-nav"> </ul></div>
	  <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
<?php
  if(isset($_SESSION["bgoSesion"]) && $_SESSION["bgoSesion"] == "ok"){
	 echo '<li class="nav-item"><a class="nav-link" href="profile.php">
			 <img alt="Avatar"  class="user-image" src="media/users/'.$_SESSION['bgo_userImg'].'">
			 '.$_SESSION['bgo_user'].'</a>
		</li>
';
		
	 echo '<li class="nav-item dropdown show">
        <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="true">
          <i class="fas fa-bars fa-lg"></i> </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="dropdown-divider"></div>
		  <a id="btnPublicar" class="dropdown-item" ><i class="fas fa-cloud-upload-alt mr-2" ></i>'.burengo_post.'</a>		  
          <div class="dropdown-divider"></div>		  
          <a href="mis-publicaciones.php" class="dropdown-item"><i class="far fa-list-alt mr-2"></i>'.burengo_Mypost.'</a>
          <div class="dropdown-divider"></div>
          <a href="profile.php" class="dropdown-item">
            <i class="far fa-id-badge mr-2"></i>'.burengo_Account.'</a>
          <div class="dropdown-divider"></div>
          <a href="mail/inbox.php" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i>'.burengo_msg.'</a>
		  <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item" data-toggle="modal" data-target="#modal-favorites"><i class="fas fa-heart mr-2"></i>'.burengo_seeFavs.'</a>
          <div class="dropdown-divider"></div>
          <a href="salir.php" class="dropdown-item"> <i class="fas fa-sign-out-alt text-danger mr-2"></i> '.burengo_logout.'</a>
        </div>
      </li>	';
		
	 
  }else{
echo '<li class="nav-item"><a class="nav-link" href="acceder.php"> '.burengo_login.'</a></li>';
echo '<li class="nav-item float-right"><a class="nav-link" href=""><i class="flag-icon flag-icon-'.COUNTRY_CODE.'"></i></a></li>';

$_SESSION['bgo_userId']="0";
$_SESSION['bgo_maxP'] = "0";
  }
?>
      </ul>
    </div>
</nav>
<div class="content-wrapper bg-white">
    <div class="content-header ">
      <div class="">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">
			<input id="fcd" type="hidden" value="<?php echo $code; ?>" />			
			<input id="route01" type="hidden" value="0" />
			<input id="route02" type="hidden" value="1" />
			<input id="route03" type="hidden" value="1" />				
			<input id="pageCant" type="hidden" value="1" />  
			<input id="pageTop" type="hidden" value="1" />  
			<input id="planTotalP" type="hidden" value="<?php echo $total_postv; ?>" />  
			<input id="planMaxP" type="hidden" value="<?php echo $_SESSION['bgo_maxP']; ?>" /> 			
			<input id="currentCode" type="hidden" value="<?php  echo $_SESSION['bgo_userId']; ?>"/>
			<small> </small></h1>
          </div>
        </div>
      </div>
	</div>
	<div class="content">
      <div class="">
        <div class="row">
          <div class="col-lg-3">
		  	
			<div class="card">
              <div class="card-body p-0">
              <div class="btn-group col-lg-12 p-0 viewFilter">
				  <button style="display:none;" id="op0" name="op0" class="btn btn-lg btn-warning viewOption" view="0"><i class="fas fa-th"></i> Todos </button>
				  <button id="op1" name="op1" class="btn btn-lg btn-default viewOption" view="1"><i class="fas fa-car"></i> <?php echo burengo_vehiculos; ?> </button>
				  <button id="op2" name="op2" class="btn btn-lg btn-default viewOption" view="2"><i class="fas fa-home"></i> <?php echo burengo_inmuebles; ?> </button>
               </div>
              </div>
            </div> 
			
            <div id="btnCompras" class="info-box bg-gradient-success">
              <span class="info-box-icon"><i class="fas fa-wallet"></i></span>
              <div class="info-box-content">
                <span class="info-box-number"> <br/> <h4><?php echo burengo_buy; ?></h4></span><br/>
              </div>
            </div>
		  
	         <div id="btnRentas"class="info-box bg-gradient-warning">
              <span class="info-box-icon"><i class="far fa-calendar-alt"></i> </span>
              <div class="info-box-content">
                <span class="info-box-number"><br/> <h4><?php echo burengo_rent; ?></h4> </span><br/>
              </div>
            </div>
<!-- ==================================================================================================================== -->			
 <div class="gAdsenceVertical" title="Burengo Anuncio 1"> </div>

 <div class="gAdsenceVertical" title="Burengo Anuncio 2"> </div>
			
<!-- Adsence - Pantallas Celulares - Tamaño ** 320 x 50 ** Debajo de botones comprar / rentar  -->
<div class="gAdsenceVerticalphone" title="Burengo Anuncio celular"> </div>
<!-- ./ Fin espacio para anuncios de adsence celulares -->
<!-- ==================================================================================================================== -->				
			
          </div>

<div style="margin-top:-1.2em;" class="col-lg-9 p-0">
 

 
<div class="">

 <div class="card-body outer-plist">
 	<div class="gAdsenceHorizontal" title="Burengo Anuncio 3"></div>
 
<div class="card card-outline card-warning">
 
 <h3 class="card-title p-3 text-mute">  <b class="text-muted">  Anuncios Destacados </b>  </h3>
  <div class="card-body p-1">
  
	<div class="plist pb-2"></div>       

  </div> 
  </div>  



<div class=" mt-4 mb-2">
	 
<div class="row p-0">
<div class="gAdsenceHorizontal" title="Burengo Anuncio 4"></div> 
</div>		  
</div>




<div class="card card-outline card-success mb-4 mt-4">
  <h4 class="card-title p-3 text-mute">   <b class="text-muted"> Anuncios Recientes </b>  </h4>
  <div class="card-body p-1">
<div class="recentPost">
<?php 
$pageno = 1;
$no_of_records_per_page = 18;
$offset = ($pageno-1) * $no_of_records_per_page;

$stmt = Conexion::conectar()->prepare(" SELECT COUNT(p.bgo_code) as totalr FROM bgo_posts p INNER JOIN bgo_places pl ON p.bgo_lugar = pl.pcid AND p.bgo_status = 1 AND p.bgo_country_code = '".COUNTRY_CODE."'");	
$stmt2 = Conexion::conectar()->prepare(" SELECT p.*, pl.*, cu.* FROM bgo_posts p 
INNER JOIN bgo_places pl ON p.bgo_lugar = pl.pcid 
INNER JOIN bgo_currency cu ON p.bgo_currency = cu.cur_id
AND p.bgo_status = 1 AND p.bgo_country_code = '".COUNTRY_CODE."' ORDER BY p.bgo_txdate DESC LIMIT ".$offset.", ".$no_of_records_per_page."");	

$stmt -> execute();
$total_rows = $stmt -> fetch();
$total_pages = ceil($total_rows["totalr"] / $no_of_records_per_page);

$stmt2 -> execute();
while($results = $stmt2 -> fetch()){
$dest="";
$iconDesc="";
$imgNewClass="img-normal-recent";
$valit = "";
list($img_width, $img_height) = getimagesize("media/thumbnails/".$results['bgo_thumbnail']."");

if( $results['bgo_stdesc'] == 9 ){ $dest = 'style="border: solid 4px #ffc926"'; $iconDesc=' <span class="text-warning"> <i class="fas fa-star"></i> </span>';  }
if( intval($img_height) >= intval($img_width) ){ $imgNewClass = "re-route";  $valit='';}  

if($pageno==1){ $prev = 1;  }else{ $prev = intval($pageno)-1; }
if($pageno==$total_pages){ $next = $pageno; }else{ $next = intval($pageno)+1; }

echo '<div  class="col-lg-3 burengo_case_recent visit itemSelection" itemId="'.$results['bgo_code'].'" itemCat="'.$results['bgo_subcat'].'" data-aos="fade-up">';
echo '<div   class="img-holder-recent">
	  <div '.$dest.' class="burengo-img-grid-recent">
	  <img   src="media/thumbnails/'.$results['bgo_thumbnail'].'" alt="Image placeholder" class=" '.$imgNewClass.' "> 
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
 
if($total_pages > 1){
	echo ' <nav class="col-12 pt-2">
		<ul class="pagination justify-content-center"> 
		<li class="page-item" pg="'.$prev.'"> <button class="btn btn-success btn-flat elevation-2"> <i class="fas fa-angle-double-left"></i> Anterior </button></li>';

 echo '<li class="page-item pl-3 pr-3"> <a class="page-link" href="#"> '.$pageno.' / '.$total_pages.' </a></li>';

 
/* -================================- */
echo '<li class="page-item" pg="'.$next.'"> <button class="btn btn-success btn-flat elevation-2"> Siguiente <i class="fas fa-angle-double-right"></i>  </button></li>
</ul> 
</nav> ';
}	

	
?>		
	
	
</div>      

  </div> 
  
  
 
  
  </div>
	
<!-- ==================================================================================================================== -->	

   
 </div>
</div> 
</div> 
</div>
</div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<div id="modalTriggerComprar" data-toggle="modal" data-target="#modal-comprar" ></div>
<div id="modalTriggerRentar" data-toggle="modal" data-target="#modal-rentar" ></div>
<div id="modalTriggerMaxOut" data-toggle="modal" data-target="#modal-planMaxOut"></div>
<div id="modalTriggerPublicar" data-toggle="modal" data-target="#modal-default"></div>

<div class="modal fade" id="modal-comprar">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"> </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

<div class="modal-body">
 <h3><center> <?php echo burengo_qBuy; ?></center></h3><br/>
		 <div class="row">
			<div class="col-md-6">
			<div id="btnBuyVh" class="info-box bg-gradient-success">
              <span class="info-box-icon"><i class="fas fa-car"></i></span>
              <div class="info-box-content"><span class="info-box-number"> <br/> <h4> <?php echo burengo_vehiculos; ?> </h4></span><br></div>
            </div>				
			</div>			
			<div class="col-md-6">	
				<div id="btnBuyIm" class="info-box bg-gradient-success">
                <span class="info-box-icon"><i class="fas fa-home"></i></span>
                <div class="info-box-content"><span class="info-box-number"> <br> <h4> <?php echo burengo_inmuebles; ?> </h4></span><br></div>
            </div>				
			</div>
		</div>
	</div>	 
       </div>
    </div>
</div>

<div class="modal fade" id="modal-rentar">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"> </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
         <div class="modal-body">	
		 <h3><center><?php echo burengo_qRent; ?> </center></h3>
		 <br/>
		 <div class="row">
			<div class="col-md-6">	
			  <div id="btnRentVh" class="info-box bg-gradient-warning">
              <span class="info-box-icon"><i class="fas fa-car"></i></span>
              <div class="info-box-content"><span class="info-box-number"> <br/> <h4> <?php echo burengo_vehiculos; ?> </h4></span><br></div>
            </div>				
			</div>
			
			<div class="col-md-6">
				<div id="btnRentIm" class="info-box bg-gradient-warning">
				<span class="info-box-icon"><i class="fas fa-home"></i></span>
				<div class="info-box-content"><span class="info-box-number"> <br> <h4> <?php echo burengo_inmuebles; ?> </h4></span><br></div>
				</div>				
			</div>
		</div>
	</div>
  </div>
  </div>
</div>

<div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"> <?php echo burengo_newPost; ?> </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <div class="col-md-12">
			<div class="btn-group btn-group-lg col-md-12">
				<button id="mopv1" class="btn btn-sm btn-warning"><i class="fas fa-wallet"></i> <?php echo burengo_sell; ?> </button>
				<button id="mopv2" class="btn btn-sm btn-default"> <i class="far fa-calendar-alt"></i> <?php echo burengo_rent; ?> </button>
			</div>
			<hr/>
			<div class="btn-group btn-group-lg col-md-12">
				<button id="mop1" class="btn btn-sm btn-warning"><i class="fa fa-car"></i> <?php echo burengo_vehiculos; ?> </button>
				<button id="mop2" class="btn btn-sm btn-default"> <i class="fa fa-th"></i> <?php echo burengo_inmuebles; ?> </button>
			</div>
		</div>
			
            </div>
			 <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-danger" data-dismiss="modal"> <?php echo burengo_close; ?> </button>
              <button id="uploadFiles" type="button" class="btn btn-success"> <?php echo burengo_accept; ?> </button>
            </div>
			
          </div>
        </div>
</div>
<div class="modal fade" id="modal-planMaxOut">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">  </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
				<h5 class="text-center"> <i class="fas fa-exclamation-triangle text-danger fa-3x"></i> </h5> <br/>
				<h5 class="text-center"> <?php echo burengo_MaxOut1; ?> <span class="text-info"> <?php echo $_SESSION['bgo_planName']; ?></span>. <?php echo burengo_MaxOut2; ?> <a href="planes.php" class="text-success"> <?php echo burengo_MaxOut3; ?> </a>.</h5>
				<h1> &nbsp; </h1>
            </div>
          </div>
        </div>
</div>
<div class="modal fade" id="modal-favorites">
 <div class="modal-dialog">
   <div class="modal-content">
      <div class="modal-header">
       <h4 class="modal-title">   </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
<div class="modal-body p-0 whlist" style="height:400px;   overflow-y: auto; overflow-x: hidden;"> 
<!----------------------------------->
		
<!----------------------------------->
</div>
   </div>
    </div>
      </div>
<div class="modal fade" id="modal-sample">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"> <?php echo burengo_policy2; ?></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
			<div class="row" style="height:300px;   overflow-y: auto; overflow-x: hidden;">
              <p class="justify-content-between"><?php echo burengo_contract1; ?></p>
			  </div>
 
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default float-right" data-dismiss="modal"> <?php echo burengo_close; ?> </button>
              
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
<div class="modal fade" id="modal-sample2">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"> <?php echo burengo_policy1; ?> </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
			 <div class="row" style="height:300px;   overflow-y: auto; overflow-x: hidden;">
               <p class="justify-content-between"> <?php echo burengo_contract2; ?> </p>
		     </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default float-right" data-dismiss="modal"> <?php echo burengo_close; ?></button>
              
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

<section class="main-footer bg-navy">   </section>  
<footer class="main-footer bg-navy" style="border-color: #001f3f;"> 
 <div class="row">	
	<div class="col-md-8">
	<p>El uso de este site implica la aceptación de nuestra política de privacidad y términos y condiciones de uso.</p>
	
	<p class="pt-2"><a href="#" class="text-center text-danger" data-toggle="modal" data-target="#modal-sample"><?php echo burengo_policy2; ?> </a> </p>
	<p><a href="#" class=" text-center text-danger" data-toggle="modal" data-target="#modal-sample2"> Política de Devoluciones, Reembolsos y Cancelaciones </a></p>
	<p><a href="<?php echo burengoBaseUrl; ?>" class=" text-center text-danger"> Ir a Portada </a></p>

	</div>  
    <div class="col-md-4"> 
		<h6 class="mb-4 text-info"> ¡Síguenos & Contáctanos! </h6> 
<ul class="list-unstyled pl-2">
<li><a href="https://www.facebook.com/burengoweb" target="_blank" class="btn-link text-white"> <i class="fab fa-facebook-square fa-1x text-primary"></i>  burengoweb </a></li>

<li class="pt-2"><a href="https://www.instagram.com/burengoweb" target="_blank" class="btn-link text-white"> <i class="fab fa-instagram fa-1x text-danger"></i></i>  burengoweb </a></li>

<li class="pt-2"><a href="mailto:info@burengo.com" target="_blank" class="btn-link text-white"> <i class="fas fa-envelope fa-1x text-warning"></i></i>  info@burengo.com </a></li>
<li class="pt-2"><a href="contacto.php" class="btn-link text-white"> <i class="fas fa-envelope-open-text fa-1x text-info"></i> Preguntas y Sugerencias      </a></li>
               
              </ul>		
		
	</div>
<div class="col-md-12 pt-4 " style="bottom:0;"> 	<h6 class="mb-2">Burengo.com &copy; 2020 - <?php echo burengo_copyright; ?> </h6> </div>	
</div>
	
</footer>

</div>
<script src="<?php echo burengoBaseUrl; ?>plugins/jquery/jquery.min.js"></script>
<script src="<?php echo burengoBaseUrl; ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo burengoBaseUrl; ?>plugins/toastr/toastr.min.js"></script>
<script src="<?php echo burengoBaseUrl; ?>/plugins/bootstrap-slider/bootstrap-slider.min.js"></script>
<script src="<?php echo burengoBaseUrl; ?>dist/js/adminlte.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$('.plist').load('<?php echo burengoBaseUrl; ?>ajax/burengo_select.php?typo='+$('#route01').val()+'&pageno='+$('#pageCant').val());
getopPages();
first();
});


function explode(){
var top = parseInt($('#pageTop').val());
var current = parseInt($('#pageCant').val());	
var next = current+1;
if(next>top || next == 6 ){
	$('#pageCant').val(1);	
	$('.plist').load('<?php echo burengoBaseUrl; ?>ajax/burengo_select.php?typo='+$('#route01').val()+'&pageno='+$('#pageCant').val());	
	first();
}else{
	$('#pageCant').val(next);
	$('.plist').load('<?php echo burengoBaseUrl; ?>ajax/burengo_select.php?typo='+$('#route01').val()+'&pageno='+$('#pageCant').val());	
	first();	
  }
}
function first(){setTimeout(explode, <?php echo refreshTime; ?>);}
function getopPages(){
	$.getJSON('<?php echo burengoBaseUrl; ?>ajax/burengo_page_stats.php',{			  	 
	value: $('#route01').val() 	 
	},function(data){
	   switch(data['ok'])
		{
			case 0:  toastr.error('Usuario o Clave Incorrectos '); break;
			case 1: $('#pageTop').val(data['top']);  break;		
		 }
	});		
}

$('.viewFilter').on('click', 'button.viewOption', function(){
	var option = $(this).attr('view');
	var active = $('#route01').val();
	
	/* OLD */
	$('#op'+active).removeClass('btn-warning');
	$('#op'+active).addClass('btn-default');
	
	/* New */
	$('#op'+option).removeClass('btn-default');
	$('#op'+option).addClass('btn-warning');
	$('#route01').val(option);
	$('#pageCant').val(1);
	
	$('.plist').load('<?php echo burengoBaseUrl; ?>ajax/burengo_select.php?typo='+$('#route01').val()+'&pageno='+$('#pageCant').val());		
	$('.recentPost').load('<?php echo burengoBaseUrl; ?>ajax/burengo_select_recent.php?typo='+$('#route01').val()+'&pageno='+$('#pageCant').val());		
	getopPages();
});

$('.plist').on("click", "div.itemSelection", function(){ 
	var id = $(this).attr('itemId');
	var cat = $(this).attr('itemCat');
	
	switch(cat){
		case '1': location.href="<?php echo burengoBaseUrl; ?>vehiculos.php?dtcd="+id; break;
		case '2': location.href="<?php echo burengoBaseUrl; ?>inmuebles.php?dtcd="+id; break;
	} 
}); 


$('.plist').on("click","li.page-item",function(){
	$('.plist').load('<?php echo burengoBaseUrl; ?>ajax/burengo_select.php?typo='+$('#route01').val()+'&pageno='+$(this).attr('pg'));		
	getopPages();	
});

$('.recentPost').on("click", "div.itemSelection", function(){ 
	var id = $(this).attr('itemId');
	var cat = $(this).attr('itemCat');
	
	switch(cat){
		case '1': location.href="<?php echo burengoBaseUrl; ?>vehiculos.php?dtcd="+id; break;
		case '2': location.href="<?php echo burengoBaseUrl; ?>inmuebles.php?dtcd="+id; break;
	} 
}); 



$('#btnCompras').click(function(){
var rt = $('#route01').val();
switch(rt){
	case '1': location.href="<?php echo burengoBaseUrl; ?>vehiculos/filtro.php?cat=1"; break;
	case '2': location.href="<?php echo burengoBaseUrl; ?>inmuebles/filtro.php?cat=1"; break;
	default:  $('#modalTriggerComprar').click(); break;
}	
});

$('#btnRentas').click(function(){
var rt = $('#route01').val();
switch(rt){
	case '1': location.href="<?php echo burengoBaseUrl; ?>vehiculos/filtro.php?cat=2"; break;
	case '2': location.href="<?php echo burengoBaseUrl; ?>inmuebles/filtro.php?cat=2"; break;
	default: $('#modalTriggerRentar').click(); break;
}	
});


$('#mopv1').click(function(){
	 $(this).removeClass('btn-default');
	 $(this).addClass('btn-warning');
	 $('#mopv2').removeClass('btn-warning');
	 $('#mopv2').addClass('btn-default');
	 $('#route03').val(1);
 });
 
$('#mopv2').click(function(){
	 $(this).removeClass('btn-default');
	 $(this).addClass('btn-warning');
	 $('#mopv1').removeClass('btn-warning');
	 $('#mopv1').addClass('btn-default');
	 $('#route03').val(2);
 });

$('#mop1').click(function(){
	 $(this).removeClass('btn-default');
	 $(this).addClass('btn-warning');
	 $('#mop2').removeClass('btn-warning');
	 $('#mop2').addClass('btn-default');                      
	 $('#route02').val(1);
 });
 
$('#mop2').click(function(){
	 $(this).removeClass('btn-default');
	 $(this).addClass('btn-warning');
	 $('#mop1').removeClass('btn-warning');
	 $('#mop1').addClass('btn-default');
	 $('#route02').val(2);
 });


$('#uploadFiles').click(function(){
	 var rt1 = $('#route03').val();
	 var rt2 = $('#route02').val();
	 var fullRoute = rt1+rt2;
	 var fcc = $('#fcd').val();

	 switch(fullRoute){
		case '11': location.href = "post/vehiculos/sale/datos.php?ccdt="+fcc; break;
		case '21': location.href = "post/vehiculos/rent/datos.php?ccdt="+fcc; break;
		case '12': location.href = "post/inmuebles/sale/datos.php?ccdt="+fcc+"&ccdtm=12"; break;
		case '22': location.href = "post/inmuebles/rent/datos.php?ccdt="+fcc+"&ccdtm=22"; break;
	 }  
 });

$('#btnPublicar').click(function(){
	var total = parseInt($('#planTotalP').val());
	var max   = parseInt($('#planMaxP').val());  
	if(total < max ){
		$('#modalTriggerPublicar').click();
	}else{
		$('#modalTriggerMaxOut').click();
	}		
});


$('.whlist').load("<?php echo burengoBaseUrl; ?>ajax/burengo_select_favorites.php?id="+$('#currentCode').val());
$('.whlist').on("click","span.itemSelection",function(){
	var id = $(this).attr('itemId');
	var cat = $(this).attr('stid');
	switch(cat){
		case '1': location.href="vehiculos.php?dtcd="+id; break;
		case '2': location.href="inmuebles.php?dtcd="+id; break;
	}
});


$('.whlist').on("click","img.itemSelection",function(){
	var id = $(this).attr('itemId');
	var cat = $(this).attr('stid');
	switch(cat){
		case '1': location.href="vehiculos.php?dtcd="+id; break;
		case '2': location.href="inmuebles.php?dtcd="+id; break;
	}
});

$('.whlist').on("click","a.itemSelection",function(){
	var id = $(this).attr('itemId');
	var cat = $(this).attr('stid');
	switch(cat){
		case '1': location.href="vehiculos.php?dtcd="+id; break;
		case '2': location.href="inmuebles.php?dtcd="+id; break;
	}
});


$('.whlist').on("click","a.itemDelete",function(){
   var pid = $(this).attr('itemId');
   var uid = $(this).attr('userId');
   
   $.getJSON('<?php echo burengoBaseUrl; ?>ajax/burengo_delete_fav.php',{
		pid: pid,
		uid: uid
	},function(data){
		switch(data['ok']){
			case 0: toastr.error('ERROR! No se guardaron los cambios los datos: '+ data['err']); break;
			case 1: $('.whlist').load("<?php echo burengoBaseUrl; ?>ajax/burengo_select_favorites.php?id="+uid);  break;
		}
	});	
 
});


 
 

$('#btnBuyVh').click(function(){ location.href="<?php echo burengoBaseUrl; ?>vehiculos/filtro.php?cat=1"; });
$('#btnRentVh').click(function(){location.href="<?php echo burengoBaseUrl; ?>vehiculos/filtro.php?cat=2"; });
$('#btnBuyIm').click(function(){ location.href="<?php echo burengoBaseUrl; ?>inmuebles/filtro.php?cat=1"; });
$('#btnRentIm').click(function(){ location.href="<?php echo burengoBaseUrl; ?>inmuebles/filtro.php?cat=2"; });

</script>
</body>
</html>