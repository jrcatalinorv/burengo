<?php
session_start();
date_default_timezone_set("America/Santo_Domingo");
require_once "../modelos/conexion.php";
require_once "../modelos/data.php";
require_once "../modelos/settings.php";
$code = rand(1000000,9999999) ;

if(isset($_SESSION['bgo_userId'])){   
}else{
  header('Location: '.burengoBaseUrl.''); 
} 

$stmt = Conexion::conectar()->prepare(" SELECT COUNT(bgo_code) as totalpv FROM bgo_posts WHERE bgo_usercode = '".$_SESSION['bgo_userId']."'");
$stmt -> execute();
$results = $stmt-> fetch();
$total_postv = number_format($results['totalpv']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="icon" type="image/png" href="<?php echo burengoBaseUrl; ?>favicon.ico"/>
  <title> Burengo - Compra, renta o vende vehículos e inmuebles </title>
  <link rel="stylesheet" href="<?php echo burengoBaseUrl; ?>dist/css/pagination.css">
  <link rel="stylesheet" href="<?php echo burengoBaseUrl; ?>plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?php echo burengoBaseUrl; ?>dist/css/adminlte.css">
  <link rel="stylesheet" href="<?php echo burengoBaseUrl; ?>plugins/toastr/toastr.min.css"> 
  <link rel="stylesheet" href="<?php echo burengoBaseUrl; ?>dist/css/burengo-min.css">  
</head>
<body class="hold-transition layout-top-nav layout-navbar-fixed">
<div class="wrapper">
<nav class="main-header navbar navbar-expand-md navbar-dark bg-navy"> 
    <div class="container">
      <a href="" class="navbar-brand"><img src="<?php echo burengoBaseUrl; ?>dist/img/burengo.png" alt="Burengo Logo" class="brand-image   elevation-0" style="opacity: .8"></a>
       <div class="collapse navbar-collapse order-3" id="navbarCollapse"><ul class="navbar-nav"> </ul></div>
	  <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
     <li class="nav-item"><a class="nav-link" href="profile.php">
			 <img alt="Avatar"  class="user-image" src="<?php echo burengoBaseUrl; ?>media/users/<?php echo $_SESSION['bgo_userImg']; ?>">
			 <?php echo $_SESSION['bgo_user']; ?></a>
		</li>
 		<li class="nav-item dropdown show">
        <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="true">
          <i class="fas fa-bars fa-lg"></i> </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="dropdown-divider"></div>
		  <a id="btnPublicar" class="dropdown-item" >
            <i class="fas fa-cloud-upload-alt mr-2" ></i><?php echo burengo_post; ?>    
          </a>		  
          <div class="dropdown-divider"></div>		  
          <a href="publicaciones.php" class="dropdown-item">
            <i class="far fa-list-alt mr-2"></i> <?php echo burengo_Mypost; ?> 
          </a>
          <div class="dropdown-divider"></div>
          <a href="profile.php" class="dropdown-item">
            <i class="far fa-id-badge mr-2"></i>  <?php echo burengo_Account; ?>     
          </a>
          <div class="dropdown-divider"></div>
          <a href="mail/inbox.php" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> <?php echo burengo_msg; ?>
          </a>
		  <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item" data-toggle="modal" data-target="#modal-favorites">
            <i class="fas fa-heart mr-2"></i> <?php echo burengo_seeFavs; ?>
          </a>
          <div class="dropdown-divider"></div>
          <a href="salir.php" class="dropdown-item"> <i class="fas fa-sign-out-alt text-danger mr-2"></i> <?php echo burengo_logout; ?> </a>
        </div>
      </li>
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
		    <input id="currentCode" class="form-control" type="hidden" value="<?php  echo $_SESSION['bgo_userId']; ?>"/>			
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
			<!-- Adsence - Pantallas Grandes  Tamaño ** 300 x 250 ** Debajo de botones comprar / rentar  -->
			<div class="gAdsenceVertical" title="Burengo Anuncio 1">
 
			</div>
			
					 
			<div class="gAdsenceVertical" title="Burengo Anuncio 2">
 
			</div>
			<!-- ./ Fin espacio para anuncios de adsence 300 x 250  -->
			
			<!-- Adsence - Pantallas Celulares - Tamaño ** 320 x 50 ** Debajo de botones comprar / rentar  -->
			<div class="gAdsenceVerticalphone" title="Burengo Anuncio Celular">
			    
			</div>
			<!-- ./ Fin espacio para anuncios de adsence celulares -->
<!-- ==================================================================================================================== -->				
			
			
			
			
          </div>

<div style="margin-top:-1.2em;" class="col-lg-9 p-0">
<div class="">
 <div class="card-body outer-plist">
  <!-- ==================================================================================================================== -->	
<!-- Adsence - Pantallas Grandes  Tamaño ** 720 x 100  Encima de las publicaciones  -->
<div class="gAdsenceHorizontal" title="Burengo Anuncio 3"> 
	 	
</div> 
<!-- ==================================================================================================================== -->	

 
 
   <div class="plist"></div>
 </div>
</div>  
</div>
  
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

   <div id="modalTriggerMaxOut" data-toggle="modal" data-target="#modal-planMaxOut"></div>
   <div id="modalTriggerPublicar" data-toggle="modal" data-target="#modal-default"></div>
   <div id="modalTriggerComprar" data-toggle="modal" data-target="#modal-comprar" ></div>
   <div id="modalTriggerRentar" data-toggle="modal" data-target="#modal-rentar" ></div>

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
			
			 <h3><center> <?php echo burengo_qBuy; ?> </center></h3>
		 <br/>
		 <div class="row">
			<div class="col-md-6">
				
				<div id="btnBuyVh" class="info-box bg-gradient-success">
              <span class="info-box-icon"><i class="fas fa-car"></i></span>
              <div class="info-box-content">
                <span class="info-box-number"> <br/> <h4> <?php echo burengo_vehiculos; ?> </h4></span><br>
              </div>
            </div>				
			</div>			
			<div class="col-md-6">
				<div id="btnBuyIm" class="info-box bg-gradient-success">
              <span class="info-box-icon"><i class="fas fa-home"></i></span>
              <div class="info-box-content">
                <span class="info-box-number"> <br> <h4> <?php echo burengo_inmuebles; ?> </h4></span><br>
              </div>
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
		 <h3><center> <?php echo burengo_qRent; ?> </center></h3>
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
   <!-- /.modal -->

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



<footer class="main-footer">
    Burengo &copy; 2020 - <?php echo burengo_copyright; ?> 
<div class="float-right d-none d-sm-inline-block">
       	<a href="#" class="text-center text-mute" data-toggle="modal" data-target="#modal-sample"><?php echo burengo_policy2; ?> </a>   
    </div>
  </footer>
</div>

<script src="<?php echo burengoBaseUrl; ?>plugins/jquery/jquery.min.js"></script>
<script src="<?php echo burengoBaseUrl; ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo burengoBaseUrl; ?>plugins/toastr/toastr.min.js"></script>
<script src="<?php echo burengoBaseUrl; ?>dist/js/adminlte.min.js"></script>
<script src="<?php echo burengoBaseUrl; ?>dist/js/demo.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$('.plist').load('<?php echo burengoBaseUrl; ?>ajax/burengo_select_acc.php?typo='+$('#route01').val()+'&pageno='+$('#pageCant').val());
getopPages();
first();
$('.whlist').load("<?php echo burengoBaseUrl; ?>ajax/burengo_select_favorites.php?id="+$('#currentCode').val());
});

function explode(){
var top = parseInt($('#pageTop').val());
var current = parseInt($('#pageCant').val());	
var next = current+1;
if(next>top || next == 6){
	$('#pageCant').val(1);	
	$('.plist').load('<?php echo burengoBaseUrl; ?>ajax/burengo_select_acc.php?typo='+$('#route01').val()+'&pageno='+$('#pageCant').val());	
	first();
}else{
	$('#pageCant').val(next);
	$('.plist').load('<?php echo burengoBaseUrl; ?>ajax/burengo_select_acc.php?typo='+$('#route01').val()+'&pageno='+$('#pageCant').val());	
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
 
/* Filtro Vehiculos / Inmuhebles */
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
	$('.plist').load('<?php echo burengoBaseUrl; ?>ajax/burengo_select_acc.php?typo='+$('#route01').val()+'&pageno='+$('#pageCant').val());		
	getopPages();
});
 
$('.plist').on("click", "div.itemSelection", function(){ 
	var id = $(this).attr('itemId');
	var cat = $(this).attr('itemCat');
	
	switch(cat){
		case '1': location.href="vehiculos.php?dtcd="+id; break;
		case '2': location.href="inmuebles.php?dtcd="+id; break;
	} 
}); 


$('.plist').on("click","li.page-item",function(){
	$('.plist').load('<?php echo burengoBaseUrl; ?>ajax/burengo_select_acc.php?typo='+$('#route01').val()+'&pageno='+$(this).attr('pg'));		
	getopPages();	
});


$('#btnCompras').click(function(){
var rt = $('#route01').val();
switch(rt){
	case '1': location.href="vehiculos/filtro.php?cat=1"; break;
	case '2': location.href="inmuebles/filtro.php?cat=1"; break;
	default:  $('#modalTriggerComprar').click(); break;
}	
});

$('#btnRentas').click(function(){
var rt = $('#route01').val();
switch(rt){
	case '1': location.href="vehiculos/filtro.php?cat=2"; break;
	case '2': location.href="inmuebles/filtro.php?cat=2"; break;
	default: $('#modalTriggerRentar').click(); break;
}	
});

$('#btnBuyVh').click(function(){ location.href="vehiculos/filtro.php?cat=1"; });
$('#btnRentVh').click(function(){location.href="vehiculos/filtro.php?cat=2"; });
$('#btnBuyIm').click(function(){ location.href="inmuebles/filtro.php?cat=1"; });
$('#btnRentIm').click(function(){ location.href="inmuebles/filtro.php?cat=2"; });

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


</script>
</body>
</html>