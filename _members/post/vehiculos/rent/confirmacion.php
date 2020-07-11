<?php 
session_start();
date_default_timezone_set("America/Santo_Domingo");
$code = $_REQUEST["ccdt"];
require_once "../../../../modelos/conexion.php";
require_once "../../../../modelos/data.php";

if(isset($_SESSION['bgo_userId'])){   
}else{
  header('Location: '.burengoBaseUrl.'members/acceder.php'); 
} 

$stmt = Conexion::conectar()->prepare("SELECT p.*, c.*, i.*, m.*,n.*, l.*, cr.*, ts.*, tc.*, fl.*, vt.* FROM bgo_posts p 
INNER JOIN bgo_colores c ON p.bgo_color = c.clrs_id
INNER JOIN bgo_colores_int i ON p.bgo_color_interior = i.clrs_int_id
INNER JOIN bgo_marcas_vehiculos m ON p.bgo_marca = m.mv_id   
INNER JOIN bgo_modelos_vehiculos n ON p.bgo_modelo = n.mvd_id      
INNER JOIN bgo_places l ON p.bgo_lugar = l.pcid      
INNER JOIN bgo_currency cr ON p.bgo_currency = cr.cur_id  
INNER JOIN bgo_transmision_vehiculo ts ON p.bgo_transmision = ts.tsvid    
INNER JOIN bgo_traccion_vehiculo tc ON p.bgo_traccion = tc.tv_id    
INNER JOIN bgo_fuel fl ON p.bgo_fuel = fl.fid   
INNER JOIN bgo_innercategoires vt ON p.bgo_vtype = vt.inncat  
AND p.bgo_code = '".$code."'");

$stmt -> execute();

if($results = $stmt -> fetch()){
	$user = $results['bgo_usercode'];
	$desc = $results['bgo_title'];
	$precio =  $results['bgo_price'];
	$year = $results['bgo_year']; 
	$modelo = $results['mvd_modelo'];
	$fullbrand = $results['mv_marca'] ; 
	$motor = 'N/A';
	$color =$results['clrs_name'];
	$color2 =$results['clrs_int_name'];
	$tipo = $results['inncat_name'];
	$fuel = $results['fstr'];
	$transmission = $results['tsvstr']; 
	$tracsion = $results['tv_name'];
	$condition = $results['bgo_condicion'];
	$passengers = $results['bgo_pasajeros_cantidad'];
	$doors = $results['bgo_puertas_cantidad']; 
	$addr = $results['bgo_addr']; 
	$place = $results['pcstr']; 
	$totalPhotos = intval($results['bgo_comp_img']); 
	$thumpnail = "../../../../media/thumbnails/".$results['bgo_thumbnail'];
	$subcat = intval($results['bgo_cat']);
	$tcp = $results['bgo_uom'];
	$currency = $results['cur_str']." (".$results['cur_code'].")"; /* Tipo de moneda */
	$img = array($thumpnail,'0000.jpg','0000.jpg','0000.jpg','0000.jpg');
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="icon" type="image/png" href="<?php echo burengoBaseUrl; ?>favicon.ico"/>
  <title>Burengo</title>
  <link rel="stylesheet" href="<?php echo burengoBaseUrl; ?>plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?php echo burengoBaseUrl; ?>plugins/toastr/toastr.min.css">
  <link rel="stylesheet" href="<?php echo burengoBaseUrl; ?>dist/css/adminlte.css">
  <style type="text/css">
.burengo-img-grid-mate{
	maheight:450px;
	height:430px;
	width:auto;
  display: block;
  margin-left: auto;
  margin-right: auto;
} 
 /*  Vista celulares y tablet portrait */
@media screen and (max-width: 700px) {
	.bgo-wrapper{ padding-left:10px; width: 450px; height: 100px; }
	.bgo-margin-area {position: relative;  text-align: center;  font-family: "Trebuchet", sans-serif;  font-size: 14px;  margin: 0 20px;}	
	.bgo-dot {height: 30px; width: 30px; position: absolute; background: #000; border-radius: 50%; top: 10px; color: #fff; line-height: 30px; z-index: 9999;}
	.bgo-dot.bgo-one {left: 35px; background: #0C84D9;}
	.bgo-dot.bgo-two {left: 180px; background: #0C84D9;}
	.bgo-dot.bgo-three {left: 330px; background: #0C84D9; color: #fff; }
	.bgo-progress-bar { position: absolute;  height: 10px;  width: 45%;  top: 20px;  left: 10%;  background: #0C84D9;}
	.bgo-progress-bar.bgo-first {background: #0C84D9;}
	.bgo-progress-bar.bgo-second {left: 40%;}
	.bgo-message{position: absolute; height: 60px; width: 170px; padding: 10px; margin: 0; left: -50px; top: 0; color: #000;}
	.bgo-message.bgo-message-1 { display: none;}
	.bgo-message.bgo-message-2 {display: none;}
	.bgo-message.bgo-message-3 {display: none;}
}
 
@media screen and (max-width: 1000px) {
	.bgo-wrapper{ padding-left:10px; width: 450px; height: 100px; }
	.bgo-margin-area {position: relative;  text-align: center;  font-family: "Trebuchet", sans-serif;  font-size: 14px;  margin: 0 20px;}
	.bgo-dot {height: 30px; width: 30px; position: absolute; background: #000; border-radius: 50%; top: 10px; color: #fff; line-height: 30px; z-index: 9999;}
	.bgo-dot.bgo-one {left: 35px; background: #0C84D9;}
	.bgo-dot.bgo-two {left: 180px; background: #0C84D9;}
	.bgo-dot.bgo-three {left: 330px; background: #0C84D9; color: #fff; }
	.bgo-progress-bar { position: absolute;  height: 10px;  width: 45%;  top: 20px;  left: 10%;  background: #0C84D9;}
	.bgo-progress-bar.bgo-first {background: #0C84D9;}
	.bgo-progress-bar.bgo-second {left: 45%;}
	.bgo-message{position: absolute; height: 60px; width: 170px; padding: 10px; margin: 0; left: -50px; top: 0; color: #000;}
	.bgo-message.bgo-message-1 {top: 40px; color: #000;}
	.bgo-message.bgo-message-2 {left: 160px;}
	.bgo-message.bgo-message-3 {left: 160px;color: #000;}	
}

@media only screen and (min-width: 992px) {
.bgo-wrapper{width: 600px;  height: 100px; padding-left:100px;}
.bgo-margin-area {  position: relative;  text-align: center;  font-family: "Trebuchet", sans-serif;  font-size: 14px;  margin: 0 20px;}
.bgo-dot {height: 30px; width: 30px; position: absolute; background: #000; border-radius: 50%; top: 10px; color: #fff; line-height: 30px; z-index: 9999;}
.bgo-dot.bgo-one {left: 35px; background: #0C84D9;}
.bgo-dot.bgo-two {left: 180px; background: #0C84D9;}
.bgo-dot.bgo-three {left: 330px; background: #0C84D9; color: #fff;}
.bgo-progress-bar { position: absolute;  height: 10px;  width: 35%;  top: 20px;  left: 10%;  background: #0C84D9;}
.bgo-progress-bar.bgo-first {background: #0C84D9;}
.bgo-progress-bar.bgo-second {left: 40%;}
.bgo-message{position: absolute;height: 60px;width: 170px;padding: 10px;margin: 0;left: -50px;top: 0;color: #000;}
.bgo-message.bgo-message-1 {top: 40px;color: #000;}
.bgo-message.bgo-message-2 {left: 160px;}
.bgo-message.bgo-message-3 {left: 160px;color: #000;}	
} 
		
			
   </style>
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">
 <nav class="main-header navbar navbar-expand-md navbar-dark bg-black"> 
    <div class="container">
      <a href="" class="navbar-brand"><span class="brand-text">
	            <img src="<?php echo burengoBaseUrl; ?>dist/img/burengo.png" alt="Burengo Logo" class="brand-image   elevation-0" style="opacity: .8">
	  </a>
      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <ul class="navbar-nav"> </ul>
      </div>
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
         <li class="nav-item"><a class="nav-link" href="#">
			 <img alt="Avatar"  class="user-image" src="<?php echo burengoBaseUrl; ?>media/users/<?php echo $_SESSION['bgo_userImg']; ?>">
			 <?php echo $_SESSION['bgo_user']; ?></a>
		</li>

	 </ul>
    </div>
  </nav>

<div class="content-wrapper">
 <section class="content">
      <div class="container-fluid">
	          <div class="row">
         <div class="col-md-12">
	<center>
			<div class="bgo-wrapper">
			<div class="bgo-margin-area">
			<div class="bgo-dot bgo-one">1</div>
			<div class="bgo-dot bgo-two">2</div>
			<div class="bgo-dot bgo-three">3</div>
			<div class="bgo-progress-bar bgo-first"></div>
			<div class="bgo-progress-bar bgo-second"></div>
			<div class="bgo-message bgo-message-1"> <?php echo burengo_gral; ?> <div>
			<div class="bgo-message bgo-message-2"> <?php echo burengo_upImg; ?>  <div>
			<div class="bgo-message bgo-message-3"> <?php echo burengo_confirmData; ?>  <div>
			</div></div></div></div></div></div>
			</div>
			</div>
	</center>			
			<!------------------------------>
		</div>
</div>
	  
    <div class="row">
	<div class="col-md-12">
            <div class="card">
			  <div class="card-header">
                <h3 class="card-title">  
				<i class="far fa-image"></i>
				
				  </h3>
              </div>
  <div class="card-body">
          <div class="row"> 	
            <div class="col-12 col-sm-6">
              <h3 class="d-inline-block d-sm-none"> <input id="getCode" type="hidden" value="<?php echo $code; ?>" /> </h3>
              <div class="col-12">
                <img src="<?php echo $thumpnail ?>" class="product-image burengo-img-grid-mate" alt="Product Image">
              </div>
              <div class="col-12 product-image-thumbs">
                <div class="product-image-thumb"><img src="<?php echo $thumpnail; ?>" alt="Product Image "></div>
                <?php 
				   $extraImages = json_decode($results['bgo_extrapics'], true);
					for($i=0; $i < count($extraImages); $i++){
					  echo '<div class="product-image-thumb" ><img src="'.burengoBaseUrl.'media/images/'.$code.'/'.$extraImages[$i].'" alt="Product Image"></div>';
				   }
				?>
              </div>
			  
			 
			  
            </div>
            <div class="col-12 col-sm-6">
              <h3 class="my-3"> <?php echo $desc; ?> </h3>
              <p>  </p>
				<div class="p-0">
					<table class="table table-sm">
                         <tbody>
							<tr>
                                <td><label> <?php echo burengo_marca;?>:</label></td><td> <?php echo $fullbrand; ?></td> 
								<td><label> <?php echo burengo_model;?>:</label></td><td><?php echo $modelo; ?></td> 											
                            </tr>							
							<tr>
                                <td><label> <?php echo burengo_condicion;?>:</label></td><td> <?php echo $condition; ?></td> 
								<td><label> <?php echo burengo_year;?>:</label></td><td><?php echo $year; ?></td> 											
                            </tr>
                            <tr>
                                <td><label><?php echo burengo_color;?>:</label></td><td><?php echo $color; ?></td> 
                                <td><label><?php echo burengo_tipo;?>:</label></td><td><?php echo $tipo; ?></td> 
                            </tr>
                            <tr>
                               <td><label><?php echo burengo_int;?>:</label></td><td><?php echo $color2; ?></td> 
                               <td><label><?php echo burengo_fuel;?>: </label></td><td><?php echo $fuel; ?></td>
                            </tr>
                            <tr>
                               <td><label><?php echo burengo_transmition;?>:</label></td><td><?php echo $transmission; ?></td> 
                               <td><label><?php echo burengo_doorQty;?>:</label></td><td><?php echo $doors; ?></td>
                           </tr>
                           <tr>
                               <td><label><?php echo burengo_tranccion;?>:</label></td><td><?php echo $tracsion; ?></td>   
                               <td><label><?php echo burengo_passengerQty;?>:</label></td><td><?php echo $passengers; ?></td>                                
                           </tr>                                        
							<tr>
                                <td><label><?php echo burengo_place;?>:</label></td><td><?php echo $place; ?></td>   
                                <td><label><?php echo burengo_addr;?>:</label></td><td><?php echo $addr; ?></td>                                
                            </tr>										
							<tr>
                               <td><label><?php echo burengo_price;?>:</label></td><td><?php echo number_format($precio,2).' '.convert($tcp);  ?></td>   
                               <td><label><?php echo burengo_currency;?>:</label></td><td><?php echo $currency; ?></td>                                
                             </tr>
                       </tbody>
					</table>
               </div>
            </div>
          </div>
       </div>
        
			
			<div class="card-footer clearfix">
                <button id="cancel" type="button" class="btn btn-danger"> <i class="fas fa-times-circle"></i> <?php echo burengo_cancel; ?> </button>
              	<div class="float-right" >
					<button id="btnEdit" type="button" class="btn btn-warning">  <i class="fas fa-edit"></i> <?php echo burengo_edit; ?>  </button>
					<button id="btnSave" type="button" class="btn btn-success">  <?php echo burengo_finish; ?> <i class="fas fa-check-circle"></i> </button>
                </div>
			  </div>
			
            </div>
          </div>
	  	

  </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  </div>
  <!-- Main Footer -->
  <footer class="main-footer"> Burengo &copy; 2020 - <?php echo burengo_copyright; ?> </footer>
</div>
<!-- ./wrapper -->

<script src="<?php echo burengoBaseUrl; ?>plugins/jquery/jquery.min.js"></script>
<script src="<?php echo burengoBaseUrl; ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo burengoBaseUrl; ?>plugins/toastr/toastr.min.js"></script>
<script src="<?php echo burengoBaseUrl; ?>dist/js/adminlte.min.js"></script>
<script src="<?php echo burengoBaseUrl; ?>dist/js/demo.js"></script>
<script type="text/javascript">
$('#cancel').click(function(){ 
var ch = $('#url').val();
switch(ch){
	case '1':  location.href="confirmacion.php?ccdt="+$('#pcode').val(); break;
	case '2': location.href="../../../publicaciones.php"; break;
	default: location.href="../../../inicio.php";  break; 
}
});



$('#btnEdit').click(function(){	location.href="edit-datos.php?ccdt="+$('#getCode').val()+"&pth=1"; });
$('#btnSave').click(function(){
 $.getJSON('<?php echo burengoBaseUrl; ?>ajax/burengo_update_vehicle_status.php',{
	code: $('#getCode').val()	
  },function(data){
		switch(data['ok']){
			case 0: toastr.error('ERROR! No se pudo almacenar los datos: '+ data['err']); break;
			case 1: location.href="<?php echo burengoBaseUrl; ?>members/publicaciones.php";   break;
		}
	});	
	
});
/*  */
$('.product-image-thumb').on('click', function() {
    const image_element = $(this).find('img');
    $('.product-image').prop('src', $(image_element).attr('src'))
    $('.product-image-thumb.active').removeClass('active');
    $(this).addClass('active');
}); 
</script>
</body>
</html>
<?php 
function convert($id){
	switch($id){
		case 0: return ""; break;
		case 1: return " x dia "; break;
		case 2: return " x Noche "; break;
		case 3: return " x Hora"; break;
		case 4: return " - Semanal"; break;
		case 5: return " - Mensual"; break;
		default: return ""; break;
	}
}
?>