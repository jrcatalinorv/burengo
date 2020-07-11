<?php 
date_default_timezone_set("America/Santo_Domingo");
require_once "modelos/conexion.php";
require_once "modelos/data.php";

$code = $_REQUEST["dtcd"];
$cdate = date('Y-m-d');


$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
 

$stmt = Conexion::conectar()->prepare("SELECT p.*, t.*, cr.*, l.* FROM bgo_posts p
INNER JOIN bgo_innercategoires t ON p.bgo_tipolocal = t.inncat 
INNER JOIN bgo_places l ON p.bgo_lugar = l.pcid 
INNER JOIN bgo_currency cr ON p.bgo_currency = cr.cur_id  
AND p.bgo_code = '".$code."'");

$stmt -> execute();

if($results = $stmt -> fetch()){
	$user = $results['bgo_usercode'];
	$desc = $results['bgo_title'];
	$precio =  $results['bgo_price'];
	$tipo = $results['inncat_name'];
	$subcat = intval($results['bgo_cat']);
	$subcat2 = intval($results['bgo_subcat']);
	if($subcat==1){
		$mod = "Venta";
	}else{
		$mod = "Renta";
	}
	
	$addr = $results['bgo_addr']; 
	 
	$thumpnail = "../../media/thumbnails/".$results['bgo_thumbnail'];
	$tcp = $results['bgo_uom'];
	$currency = $results['cur_str']." (".$results['cur_code'].")"; /* Tipo de moneda */
	$totalPhotos = intval($results['bgo_comp_img']); 
	$img = array($thumpnail,'0000.jpg','0000.jpg','0000.jpg','0000.jpg');
	$addr = $results['bgo_addr']; 
	$place = $results['pcstr']; 
	$terreno = $results['bgo_terreno'];
	$construccion = $results['bgo_construccion'];
	$niveles = $results['bgo_niveles'];
	$rooms = $results['bgo_rooms'];
	$baths = $results['bgo_bath'];
	$garage = $results['bgo_parqueos'];
	$cur_sign = $results["cur_sign"];
		
	$pr_low  = intval($precio) - ( intval($precio) * 0.30 ); 
	$pr_high = intval($precio) + ( intval($precio) * 0.50 );  
  }


$dest="";
$iconDesc="";
if( $results['bgo_stdesc'] == 9 ){ $dest = 'style="border: solid 4px #ffc926"'; $iconDesc=' <span class="text-warning"> <i class="fas fa-star"></i> </span>';  }
  
/*Buscar datos del Usuario */
$stmt2 = Conexion::conectar()->prepare("SELECT * FROM bgo_users WHERE uid = '".$user."'"); 
$stmt2 -> execute();  
$rslts = $stmt2 -> fetch();
$use_img    = $rslts["img"];
$use_nombre = $rslts["name"];
$use_phone = $rslts["phone"]; 
$email = $rslts["email"]; 
$whatsapp = "".$rslts["bgo_whatsapp"]; 
$instagram ="".$rslts["bgo_instagram"]; 
$facebook = "".$rslts["bgo_facebook"];  
  
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <!------Meta share ----->
  <link rel="canonical" href="<?php echo $url; ?>" />
  <meta name="description" content="<?php echo $desc.' en '.$cur_sign.' '.number_format($precio,2).''.convert($tcp);?>" />
  <meta itemprop="name" content="<?php echo $desc; ?>- Burengo.com">
  <meta itemprop="description" content="<?php echo $desc.' en '.$cur_sign.' '.number_format($precio,2).''.convert($tcp);?>"> 
  <meta itemprop="image" content="<?php echo burengoBaseUrl; ?>media/vehiculos/<?php echo $img[0]; ?>" />
  <meta property="og:title" content="<?php echo $desc; ?>- Burengo.com" />  
  <meta property="og:type" content="website" />
  <meta property="og:url" content="<?php echo $url; ?>" />  
  <meta property="og:image" content="<?php echo burengoBaseUrl; ?>media/vehiculos/<?php echo $img[0]; ?>" />
  <meta property="og:image:width" content="800" />
  <meta property="og:image:height" content="600" />    
  <meta property="og:description" content="<?php echo $desc.' en '.$cur_sign.' '.number_format($precio,2).''.convert($tcp);?>" /> 
  <meta property="og:site_name" content="Burengo.com" />
  <!------Meta share ----->  
  
  <link rel="icon" type="image/png" href="favicon.ico"/>
  <title><?php echo $desc; ?></title>
  <link rel="stylesheet" href="<?php echo burengoBaseUrl; ?>plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?php echo burengoBaseUrl; ?>dist/css/adminlte.css">
  <link rel="stylesheet" href="<?php echo burengoBaseUrl; ?>plugins/toastr/toastr.min.css">
<style>
@media only screen and (min-width: 992px) {	
.burengo-img-grid{
	width: 250px; 
	height:130px;
  }
 
.burengo-img-grid-mate{
	max-height:450px;
	height:430px;
	width:auto;
  display: block;
  margin-left: auto;
  margin-right: auto;
} 
  
.bgo_font{
	font-size:1vW;
}
.bgo_mfont{
   font-size:0.8vW;
}
}

@media only screen and (max-width: 600px) {
.linkWeb{
	display:none;
}
</style>   
</head>
<body class="hold-transition layout-top-nav layout-navbar-fixed">
<div class="wrapper">
<!-- Navbar -->
 <nav class="main-header navbar navbar-expand-md navbar-dark bg-navy"> 
    <div class="container">
      <a href="<?php echo burengoBaseUrl; ?>" class="navbar-brand">
          <img src="dist/img/burengo.png" alt="Burengo Logo" class="brand-image   elevation-0" style="opacity: .8"> 
      </a>
	  <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <ul class="navbar-nav"> </ul>
      </div>
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <li class="nav-item"><a class="nav-link" href="<?php echo burengoBaseUrl; ?>"> <?php echo burengo_portada; ?> </a></li>
        <li class="nav-item"><a class="nav-link" href="acceder.php"> <?php echo burengo_login; ?> </a></li>
      </ul>
    </div>
  </nav>

  <div class="content-wrapper">
    <!-- Main content -->
    <div class="content pt-1">
      <div class=" ">
        <div class="row">
		<input id="getMe"   type="hidden" value="<?php echo $code; ?>" />
		<input id="getLow"  type="hidden" value="<?php echo $pr_low; ?>" />
		<input id="getHigh" type="hidden" value="<?php echo $pr_high; ?>" />
		<input id="getsubCat" type="hidden" value="<?php echo $subcat2; ?>" />
		<input id="getCat" type="hidden" value="<?php echo $subcat; ?>" />
		<input id="getUsrCode" type="hidden" value="<?php echo $user; ?>" />
		<input id="postTitle" type="hidden" value="<?php echo $desc; ?>" />		
      <div class="card card-solid col-12">
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-sm-6">
              <h3 class="d-inline-block d-sm-none"> </h3>
              <div class="col-12" style="height: 430px; overflow:hidden; border: solid 1px #F1F1F1; background-color: rgb(240, 240, 240, 0.7);">
		 
		 <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
			<?php $extraImages = json_decode($results['bgo_extrapics'], true); ?>         
				<ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                  	<?php for($i=0; $i < count($extraImages); $i++){
					  echo '<li data-target="#carouselExampleIndicators" data-slide-to="'.($i+1).'"></li>';
				   }?>
                 </ol>
                  <div class="carousel-inner">
                 
					<div class="carousel-item active">
                      <img style="display:block;" src="<?php echo burengoBaseUrl; ?>media/vehiculos/<?php echo $img[0]; ?>" class="product-image burengo-img-grid-mate" alt="Product Image">
                    </div>
                  	<?php for($i=0; $i < count($extraImages); $i++){
						$y=$i;
					  echo '
					  	<div class="carousel-item">
					  <img style="display:block;" <img src="'.burengoBaseUrl.'media/images/'.$code.'/'.$extraImages[$y].'" class="product-image burengo-img-grid-mate" alt="Product Image">
					   </div>
					  ';
				   }?>
                 
 
                   
                  </div>
                  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>
		 

			  </div>
            <div class="col-12 product-image-thumbs">
                <div class="product-image-thumb imgChoose"  imgPos="0"><img src="<?php echo burengoBaseUrl; ?>media/vehiculos/<?php echo $img[0]; ?>" alt="Product Image"></div>
                <?php 		  
  				   
					for($i=0; $i < count($extraImages); $i++){
					  echo '<div class="product-image-thumb imgChoose" imgPos="'.($i+1).'"  ><img src="'.burengoBaseUrl.'media/images/'.$code.'/'.$extraImages[$i].'" alt="Product Image"></div>';
				   }
				?>
              </div>
            </div>
            <div class="col-12 col-sm-6">
              <h3 class="my-3"> <?php echo $iconDesc.' '.$desc; ?> </h3>
              <p>  </p>
 
			 <div class="p-0">
			<div class="p-0">
					<table class="table table-sm">
                         <tbody>
							<tr>
                                <td><label> <?php echo burengo_property; ?>:</label></td>
                                <td> <?php echo $tipo; ?></td> 
								<td><label> <?php echo burengo_modalidad; ?>: </label></td>
                                <td><?php echo $mod; ?></td> 											
                            </tr>
							<tr>
                               <td><label><?php echo burengo_place; ?>:</label></td>
                               <td><?php echo $place; ?></td>   
                               <td><label><?php echo burengo_addr; ?>:</label></td>
                               <td><?php echo $addr; ?></td>                                
                            </tr>							
							<tr>
                                <td><label> <?php echo burengo_construccion; ?>:</label></td>
                                <td> <?php echo $construccion; ?></td> 
								<td><label> <?php echo burengo_terreno; ?>:</label></td>
                                <td><?php echo $terreno; ?></td> 											
                            </tr>							
							<tr>
                                <td><label> <?php echo burengo_levels; ?>:</label></td>
                                <td> <?php echo $niveles; ?></td> 
								<td><label> <?php echo burengo_rooms; ?>:</label></td>
                                <td><?php echo $rooms; ?></td> 											
                            </tr>							
							<tr>
                                <td><label> <?php echo burengo_baths; ?>:</label></td>
                                <td> <?php echo $baths; ?></td> 
								<td><label> <?php echo burengo_parks; ?>:</label></td>
                                <td><?php echo $garage; ?></td> 											
                            </tr>							
						    <tr>
                              <td><label><?php echo burengo_price; ?>:</label></td>
                              <td><?php echo number_format($precio,2);  ?></td>   
                              <td><label><?php echo burengo_currency; ?>:</label></td>
                              <td><?php echo $currency; ?></td>                                
                            </tr>
						 </tbody>
					</table>
				</div>
			</div>

              <div class="bg-gray py-2 px-3 mt-4">
                <h2 class="mb-0"> <?php echo $cur_sign; ?> <?php echo number_format($precio,2).' '.convert($tcp); ?> </h2>
                <h4 class="mt-0">
                  <small> </small>
                </h4>
              </div>


           <?php 
				if($subcat==1){
				echo '
			  <div class="mt-4">
                <div class="btn btn-success btn-lg btn-flat buyItem">
                  <i class="fas fa-cart-plus fa-lg mr-2"></i> 
                  '.burengo_buy.'
                </div>

                <div class="btn btn-info btn-lg btn-flat whishList">
                  <i class="fas fa-heart fa-lg mr-2 text-white"></i> 
                  '.burengo_fav.'
                </div>
              </div>';
				}else{
				echo '
			  <div class="mt-4">
                <div class="btn btn-warning btn-lg btn-flat buyItem">
                  <i class="far fa-calendar-alt fa-lg mr-2"></i> 
                  '.burengo_rent.' 
                </div>

                <div class="btn btn-info btn-lg btn-flat whishList">
                  <i class="fas fa-heart fa-lg mr-2 text-white"></i> 
                  '.burengo_fav.'
                </div>
              </div>';					
		} 	  
?>

<div class="mt-4 product-share">
 <h5><small class="text-muted"> Compartir este anuncio: </small></h5>
	<i class="fab fa-facebook-square fa-2x text-primary" data-js="facebook-share"></i>
    <i class="fab fa-twitter-square fa-2x text-info" data-js="twitter-share"></i>
	<i class="fab fa-whatsapp-square fa-2x text-success" data-js="whatsapp-share"></i>
	<i class="fas fa-envelope-square fa-2x text-secondary" data-js="email-share"></i> 
</div>

            </div>
          </div>
     
        </div>
        
		<div class="card-body pt-4">
			<h4><?php echo burengo_similars; ?> </h4>
			<hr/>
		   <div class="row similars">
		   </div>
		</div>
		
		<!-- /.card-solid -->
      </div>


 

        </div>
      </div> 
    </div>
    <!-- /.content -->
  </div>
  
  
<div id="triggerBtnModal" data-toggle="modal" data-target="#modal-default"></div>
<div id="triggerBtnModal2" data-toggle="modal" data-target="#modal-default2"></div>
 
<div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"> <?php echo burengo_sellerInfo; ?>  </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
			<div class="row">
				<div class="col-md-6"> 
				<h2 class="lead"><b><?php echo $use_nombre; ?></b></h2> 
					 <ul class="ml-4 mb-0 fa-ul text-muted pt-1">
                       <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span><span style="font-size:1.3em;" /> <?php echo $use_phone; ?></span> </li>
                       <li class="small"><span class="fa-li"><i class="fas fa-lg fa-envelope"></i></span><span style="font-size:1.2em;"> <?php echo $email; ?> </span></li>
					   <li class="small"><span class="fa-li"><i class="fab fa-lg fa-whatsapp"></i></span><span style="font-size:1.3em;"> <?php echo $whatsapp; ?> </span></li>
					   <li class="small"><span class="fa-li"><i class="fab fa-lg fa-instagram"></i></span><span style="font-size:1.3em;">  <?php echo $instagram; ?>    </span></li>					   
					   <li class="small"><span class="fa-li"><i class="fab fa-lg fa-facebook"></i></span><span style="font-size:1.3em;">  <?php echo $facebook; ?>   </span></li>
                        
					  </ul>
				</div>
				<div class="col-md-6 text-center">  <img src="media/users/<?php echo $use_img; ?>" alt="" class="img-circle img-fluid">  </div>
				<div class="col-md-12 pt-4"> <h6 class="text-info"> <?php echo burengo_mustSignIn; ?> </h6> </div>
			</div>
     
 
            </div>
			
			            <div class="modal-footer">
              <button disabled style="display:none;" type="button" class="btn btn-success" data-dismiss="modal"><i class="fas fa-comments"></i>   <?php echo burengo_usrMsgSend; ?> </button>
                <a href="publicaciones.php?user=<?php echo $user; ?>" type="button" class="btn btn-info"> 
				<i class="fas fa-th"></i> <?php echo burengo_allPost; ?>  </a>
            </div>
			
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
</div>
<!-- /.modal -->  

<div class="modal fade" id="modal-default2">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
             
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
			<div class="row">
				<div class="col-md-12 pt-4"> 
				<h2 class="text-info text-center"> <i class="far fa-file-alt fa-2x"></i> </h2>
				<h5 class="text-info text-center"> <?php echo burengo_warning1; ?> </h5> 
				
				<br/>
				<br/>
				</div>
				
			</div>
     
 
            </div>
		</div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
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

 
<?php include_once "burengo-footer.php"; ?>

</div>
<!-- ./wrapper -->
<script src="<?php echo burengoBaseUrl; ?>plugins/jquery/jquery.min.js"></script>
<script src="<?php echo burengoBaseUrl; ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo burengoBaseUrl; ?>dist/js/adminlte.min.js"></script>
<script src="<?php echo burengoBaseUrl; ?>plugins/toastr/toastr.min.js"></script>
<script src="<?php echo burengoBaseUrl; ?>dist/js/demo.js"></script>
<script src="<?php echo burengoBaseUrl; ?>dist/js/burengo.min.js"></script>
<script type="text/javascript">
visits();

$('.buyItem').click(function(){ $('#triggerBtnModal').click(); });
$('.whishList').click(function(){ $('#triggerBtnModal2').click(); }); 
$('.similars').load("<?php echo burengoBaseUrl; ?>ajax/burengo_select_similars.php?sp="+$('#getsubCat').val()+"&tp="+$('#getCat').val()+"&lw="+$('#getLow').val()+"&hg="+$('#getHigh').val()+"&me="+$('#getMe').val()); 
$('.similars').on("click", "div.itemSelection", function(){ 
	var id = $(this).attr('itemId');
	var cat = $(this).attr('itemCat');
	
  switch(cat){
		case '1': location.href="vehiculos.php?dtcd="+id; break;
		case '2': location.href="inmuebles.php?dtcd="+id; break;
	} 
}); 


$('.product-image-thumbs').on('click','div.imgChoose',function(){
	document.querySelector('[data-slide-to="'+$(this).attr('imgPos')+'"]').click();
});


/* Funcion guardar visitas */
function visits(){
 $.getJSON('<?php echo burengoBaseUrl; ?>ajax/burengo_insert_visit.php',{
	code: $('#getMe').val()	
  },function(data){
		switch(data['ok']){
			case 0: toastr.error('ERROR! No se pudo almacenar los datos: '+ data['err']); break;
			case 1: break;
		}
	});
}
</script>
</body>
</html>
<?php 
function convert($id){
	switch($id){
		case 0: return ""; break;
		case 1: return " x ".burengo_day; break;
		case 2: return " x ".burengo_night; break;
		case 3: return " x ".burengo_hour; break;
		case 4: return " - ".burengo_week; break;
		case 5: return " - ".burengo_month; break;
		default: return ""; break;
	}
}
?>