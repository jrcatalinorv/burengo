<?php 
session_start();
date_default_timezone_set("America/Santo_Domingo");
require_once "../../../modelos/conexion.php";
require_once "../../../modelos/data.php";

$code = $_REQUEST["ccdt"];
$src = $_REQUEST["pth"];

if(isset($_SESSION['bgo_userId'])){   
}else{
   header('Location: '.burengoBaseUrl.'acceder.php'); 
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
	$mc = $results['bgo_marca'];
	$md = $results['bgo_modelo'];
	
	$modelo = $results['mvd_modelo'];
	$fullbrand = $results['mv_marca'] ; 
	$motor = 'N/A';
	$color =$results['clrs_name'];
	$color2 =$results['clrs_int_name'];
	$cc1 = $results['bgo_color'];
	$cc2 = $results['bgo_color_interior'];	
	$vtype = $results['bgo_vtype'];
	$tipo = $results['inncat_name'];
	$fuelc = $results['bgo_fuel'];
	$fuel = $results['fstr'];
	$uom = $results['bgo_uom'];
	$transmissionc = $results['bgo_transmision']; 
	$transmission = $results['tsvstr']; 
	$tracsionc = $results['bgo_traccion'];
	$tracsion = $results['tv_name'];
	$condition = $results['bgo_condicion'];
	$passengers = $results['bgo_pasajeros_cantidad'];
	$doors = $results['bgo_puertas_cantidad']; 
	$addr = $results['bgo_addr']; 
	$placec = $results['bgo_lugar']; 
	$place = $results['pcstr']; 
	$totalPhotos = intval($results['bgo_comp_img']); 
	$thumpnail = "../../../media/thumbnails/".$results['bgo_thumbnail'];
	$subcat = intval($results['bgo_cat']);
	$tcp = $results['bgo_uom'];
	$currencyC = $results['bgo_currency']; /* Tipo de moneda */
	$currency = $results['cur_str']." (".$results['cur_code'].")"; /* Tipo de moneda */
	$img = array($thumpnail,'0000.jpg','0000.jpg','0000.jpg','0000.jpg');
	$notes = $results['bgo_notes'];
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
  <link rel="stylesheet" href="<?php echo burengoBaseUrl; ?>dist/css/adminlte.css">
  <link rel="stylesheet" href="<?php echo burengoBaseUrl; ?>plugins/toastr/toastr.min.css">  
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">
 <nav class="main-header navbar navbar-expand-md navbar-dark bg-navy"> 
    <div class="container">
      <a href="<?php echo burengoBaseUrl; ?>members/inicio.php" class="navbar-brand"><img src="<?php echo burengoBaseUrl; ?>dist/img/burengo.png" alt="Burengo Logo" class="brand-image   elevation-0" style="opacity: .8"></a>
      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <ul class="navbar-nav"> </ul>
      </div>

     <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <li class="nav-item"><a class="nav-link" href="">
			 <img alt="Avatar"  class="user-image" src="<?php echo burengoBaseUrl; ?>media/users/<?php echo $_SESSION['bgo_userImg']; ?>">
			 <?php echo $_SESSION['bgo_user']; ?></a>
		</li>
	 </ul>
    </div>
  </nav>
  <div class="content-wrapper">
    <!-- Main content -->
 <section class="content">
      <div class="container-fluid">	
		<div class="row pt-3">	

 <div class="col-md-12">
     <div class="card">
			 <div class="card-header">
                <h3 class="card-title"><i class="fas fa-car"></i> <?php echo burengo_editPost; ?> </h3>
				<input id="pcode" type="hidden" value="<?php echo $code; ?>">
				<input id="userId" type="hidden" value="<?php echo $user; ?>">
				<input id="url" type="hidden" value="<?php echo $src; ?>">
              </div>
            <div class="card-body">
		    <div class="row">
             <div class="col-sm-12">
              <div class="form-group"><label> <?php echo burengo_tittle; ?> </label><input id="title" maxlength="25" type="text" class="form-control" value="<?php echo $desc; ?>"></div>
            </div>
            </div>		
			<div class="row">
                 <div class="col-sm-6">
					<div class="form-group"><label> <?php echo burengo_carBrands; ?> </label>
						<select id="brands" class="form-control"> 
							<option value="0"> <?php echo burengo_carBrands; ?> </option>
<?php 
$stmt = Conexion::conectar()->prepare("SELECT * FROM bgo_marcas_vehiculos WHERE mv_status = 1 ORDER BY mv_marca");
$stmt -> execute();
while( $resultado = $stmt -> fetch()){
	if($mc==$resultado['mv_id']){
		echo '<option selected value="'.$resultado['mv_id'].'"> '.$resultado['mv_marca'].' </option>';
	}else{
		echo '<option value="'.$resultado['mv_id'].'"> '.$resultado['mv_marca'].' </option>';
	}		
}	
?>							
						</select> 
					</div>
				 </div>
				 
                 <div class="col-sm-6">
					<div class="form-group"> <label> <?php echo burengo_carModels; ?>  </label>
						<select id="models" class="form-control"> 
							<option value="0"> <?php echo burengo_carModels; ?> </option>
<?php 


$stmt = Conexion::conectar()->prepare("SELECT * FROM bgo_modelos_vehiculos WHERE mvd_status = 1 and mvd_marca = ".$mc." ORDER BY mvd_modelo");
$stmt -> execute();

while( $resultado = $stmt -> fetch()){
	if($md==$resultado['mvd_id']){
		echo '<option selected value="'.$resultado['mvd_id'].'"> '.$resultado['mvd_modelo'].' </option>';
	}else{
	   echo '<option value="'.$resultado['mvd_id'].'"> '.$resultado['mvd_modelo'].' </option>';		
	}
}	
?>							
						</select>
					</div>
				</div>
             </div>
			<div class="row">
                   <div class="col-sm-6"> 
						<div class="form-group"> <label>   <?php echo burengo_carYear; ?>  </label>  
							<select id="activeYears" class="form-control"> 
								<option value="0"> <?php echo burengo_selectedYear; ?>  </option> 					
<?php 
$stmt = Conexion::conectar()->prepare("SELECT * FROM bgo_active_years WHERE yr_status = 1 ORDER BY yr_id DESC");
$stmt -> execute();
while( $resultado = $stmt -> fetch()){
	if($year==$resultado['yr_str']){
		echo '<option selected value="'.$resultado['yr_str'].'"> '.$resultado['yr_str'].' </option>';
	}else{
		echo '<option value="'.$resultado['yr_str'].'"> '.$resultado['yr_str'].' </option>';
	}		
}	
?>
</select> 
</div>
</div>

<div class="col-sm-6">
   <div class="form-group">  <label> <?php echo burengo_carTypeSingle; ?>   </label>
		<div class="input-group mb-3">
                  <select id="cartype" class="form-control">
                        <option <?php if($vtype==0){ echo "selected"; } ?>  value="0"> <?php echo burengo_carTypeSingle; ?> </option>
						<option <?php if($vtype==1){ echo "selected"; } ?>  value="1"> <?php echo burengo_sedan; ?> </option>
						<option <?php if($vtype==2){ echo "selected"; } ?>  value="2"> <?php echo burengo_jeepeta;?> </option>
						<option <?php if($vtype==3){ echo "selected"; } ?>  value="3"> <?php echo burengo_camioneta;?> </option>
						<option <?php if($vtype==4){ echo "selected"; } ?>  value="4"> <?php echo burengo_limo;?> </option>
						<option <?php if($vtype==5){ echo "selected"; } ?>  value="5"> <?php echo burengo_coupe;?> </option>
						<option <?php if($vtype==6){ echo "selected"; } ?>  value="6"> <?php echo burengo_moto;?>  </option>
						<option <?php if($vtype==7){ echo "selected"; } ?>  value="7"> <?php echo burengo_bus;?> </option>
						<option <?php if($vtype==8){ echo "selected"; } ?>  value="8"> <?php echo burengo_boat;?> </option>
						<option <?php if($vtype==9){ echo "selected"; } ?>  value="9"> <?php echo burengo_jetski;?> </option>
						<option <?php if($vtype==10){ echo "selected"; } ?> value="10"> <?php echo burengo_truck;?> </option>
						<option <?php if($vtype==11){ echo "selected"; } ?> value="11"> <?php echo burengo_pesados;?> </option>
						<option <?php if($vtype==12){ echo "selected"; } ?> value="12"> <?php echo burengo_otros;?> </option>
                    </select> 
                </div>                     
					</div>
                    </div>
                  </div>
			<div class="row">
                    <div class="col-sm-6">
						<div class="form-group">  <label> <?php echo burengo_price; ?>  </label>
							<input id="price" type="text" class="form-control" value="<?php echo $precio; ?>">
						</div>
					</div>		

		<div class="col-sm-6">
						<div class="form-group">  <label> <?php echo burengo_rentPeriod; ; ?>  </label>
							<select id="uom" class="form-control"> 
	<option <?php if($uom == 0 ){ echo "selected"; } ?> value="0"> <?php echo burengo_rentPeriod; ?> </option>
	<option <?php if($uom == 1 ){ echo "selected"; } ?> value="1"> <?php echo burengo_day; ?>  </option>
	<option <?php if($uom == 2 ){ echo "selected"; } ?> value="2"> <?php echo burengo_night; ?>  </option>
	<option <?php if($uom == 3 ){ echo "selected"; } ?> value="3"> <?php echo burengo_hour; ?>  </option>
	<option <?php if($uom == 4 ){ echo "selected"; } ?> value="4"> <?php echo burengo_week; ?>  </option>
	<option <?php if($uom == 5 ){ echo "selected"; } ?> value="5"> <?php echo burengo_month; ?>  </option>	
		
							</select>
						</div>
					</div>
					
		
                 </div>
			<div class="row">
						<div class="col-sm-6">
						<div class="form-group"> <label> <?php echo burengo_currencyType; ?> </label>
							<select id="currency" class="form-control"> 
								<option value="0"> <?php echo burengo_currencyType; ?> </option>
								<?php 
$stmt = Conexion::conectar()->prepare("SELECT * FROM bgo_currency WHERE cur_status = 1");
$stmt -> execute();
while( $resultado = $stmt -> fetch()){
	
	if($currencyC==$resultado['cur_id']){
		echo '<option selected value="'.$resultado['cur_id'].'"> '.$resultado['cur_str'].' </option>';
	}else{
		echo '<option value="'.$resultado['cur_id'].'"> '.$resultado['cur_str'].' </option>';
	}
	}	
?>
								
							</select>
						</div>
					</div>
			
			
<div class="col-sm-6">
<div class="form-group"> <label> <?php echo burengo_fuel; ?> </label>
<select id="fuel" class="form-control">
<option value="0"> <?php echo burengo_fuel; ?> </option>
<?php 
$stmt = Conexion::conectar()->prepare("SELECT * FROM bgo_fuel WHERE fstatus = 1");
$stmt -> execute();
while( $resultado = $stmt -> fetch()){
	
	if($fuelc==$resultado['fid']){
		echo '<option selected value="'.$resultado['fid'].'"> '.$resultado['fstr'].' </option>';
	}else{
	echo '<option value="'.$resultado['fid'].'"> '.$resultado['fstr'].' </option>';	
	}
	
			
	}	
?>
 </select>
</div>
</div>					
</div>
			<div class="row">
					<div class="col-sm-6">
                      <div class="form-group"> <label> <?php echo burengo_transmition; ?> </label>
                        <select id="trasnmision" class="form-control">
                          <option <?php if($transmissionc==0){ echo "selected"; } ?> value="0"> <?php echo burengo_transmition; ?> </option>
                          <option <?php if($transmissionc==1){ echo "selected"; } ?> value="1"> <?php echo burengo_auto; ?> </option>
                          <option <?php if($transmissionc==2){ echo "selected"; } ?> value="2"> <?php echo burengo_manual; ?> </option>
                          <option <?php if($transmissionc==3){ echo "selected"; } ?> value="3"> <?php echo burengo_triptonic; ?> </option>
                        </select>                    
					</div>
                    </div>					
					
					<div class="col-sm-6">
                      <div class="form-group"> <label> <?php echo burengo_tranccion; ?> </label>
						<select id="traccion" class="form-control">
                          <option value="0"> <?php echo burengo_tranccion; ?> </option>
<?php 
$stmt = Conexion::conectar()->prepare("SELECT * FROM bgo_traccion_vehiculo WHERE tv_status = 1");
$stmt -> execute();
while( $resultado = $stmt -> fetch()){
   if($tracsionc==$resultado['tv_id']){
	   echo '<option selected value="'.$resultado['tv_id'].'"> '.$resultado['tv_name'].' </option>';		
   }else{
	 echo '<option value="'.$resultado['tv_id'].'"> '.$resultado['tv_name'].' </option>';		
   
   }
}	
?>
              
                        </select>                
					</div>
                    </div>
                  </div>	
			<div class="row">
					<div class="col-sm-6">
                      <div class="form-group">  <label><?php echo burengo_color; ?> </label>
                        <select id="color" class="form-control"> 
						 <option value="0"> <?php echo burengo_color; ?> </option>
<?php 
$stmt = Conexion::conectar()->prepare("SELECT * FROM bgo_colores WHERE clrs_status = 1");
$stmt -> execute();
while( $resultado = $stmt -> fetch()){
  if($cc1==$resultado['clrs_id']){
	  echo '<option selected value="'.$resultado['clrs_id'].'"> '.$resultado['clrs_name'].' </option>';
  }else{
	echo '<option value="'.$resultado['clrs_id'].'"> '.$resultado['clrs_name'].' </option>';  
  }
}	
?>
	</select>                    
					</div>
                    </div>					
					
					<div class="col-sm-6">
                      <div class="form-group"> <label> <?php echo burengo_intColor; ?> </label> 
					   <div class="input-group mb-3"> 
						<select id="interior" class="form-control">
                          <option value="0"> <?php echo burengo_intColor; ?> </option>
<?php 
$stmt = Conexion::conectar()->prepare("SELECT * FROM bgo_colores_int WHERE clrs_int_status = 1");
$stmt -> execute();
while( $resultado = $stmt -> fetch()){
   if($cc2==$resultado['clrs_int_id']){
	 echo '<option selected value="'.$resultado['clrs_int_id'].'"> '.$resultado['clrs_int_name'].' </option>';  
   }else{
	 echo '<option value="'.$resultado['clrs_int_id'].'"> '.$resultado['clrs_int_name'].' </option>';   
   }
}	
?>  
</select> 
	</div>                     
		</div>
             </div>
                 </div>				
			<div class="row">
    			<div class="col-sm-6">
                      <div class="form-group">  <label> <?php echo burengo_doorQty; ?> </label>
                        <select id="doors" class="form-control">
                          <option <?php if($doors==0){ echo "selected"; } ?> value="0"> <?php echo burengo_doorQty; ?> </option>
                          <option <?php if($doors==1){ echo "selected"; } ?>  value="0">0</option>
						  <option <?php if($doors==2){ echo "selected"; } ?>  value="2">2</option>
						  <option <?php if($doors==3){ echo "selected"; } ?>  value="3">3</option>
						  <option <?php if($doors==4){ echo "selected"; } ?>  value="4">4</option>
						  <option <?php if($doors==5){ echo "selected"; } ?>  value="5">5</option>
						</select>                    
					</div>
				</div>					 
				<div class="col-sm-6"><div class="form-group"> <label> <?php echo burengo_passengerQty; ?> </label>
					<input id="passengers" type="number" min="1" class="form-control" value="<?php echo $passengers; ?>" > 
					</div>
					</div>	
			</div>   
			<div class="row">
			<div class="col-sm-6"> <label> <?php echo burengo_place; ?> </label>
				<div class="form-group"> 
					<select id="place" class="form-control">
                         <option value="0">  <?php echo burengo_place; ?> </option>
						 <?php 
							$stmt2 = Conexion::conectar()->prepare("SELECT * FROM bgo_places WHERE pcstatus = 1");
							$stmt2 -> execute();
							while( $resulta2 = $stmt2 -> fetch()){		
								if($placec==$resulta2['pcid']){
									echo '<option selected value="'.$resulta2['pcid'].'"> '.$resulta2['pcstr'].' </option>';	
								}else{
									echo '<option value="'.$resulta2['pcid'].'"> '.$resulta2['pcstr'].' </option>';	
								}
							}	
						?>
						</select> 
						</div>
						</div>	
							<div class="col-sm-6"><div class="form-group">  <label> <?php echo burengo_addr; ?>   </label>
							<input id="addrs" type="text" class="form-control" value="<?php echo $addr; ?>">
					</div>
			</div>

						
			</div> 
			<div class='row'>
			<div class="col-sm-12">
				 <div class="card-header">
                <h3 class="card-title"> <i class="fas fa-list"></i> <?php echo burengo_description; ?> </h3>
              </div>
            </div>
            </div>
			<div class="row carAcc">
			 
				<div class="col-md-12">
                      <input id="accesories" type="hidden"  />
					  <textarea id="notes" class="form-control" rows="3" placeholder="">
					  <?php echo $notes; ?>
					  </textarea>
                  </div>
            </div>
		</div> <!-- Card Body -->
          <div class="card-footer">
              <button id="cancel" type="button" class="btn btn-danger"> <i class="fas fa-times-circle"></i> <?php echo burengo_cancel; ?> </button>
   <div class="float-right">
	 <button id="updPic" type="button" class="btn btn-info"> <i class="far fa-edit"> <?php echo burengo_changeImg; ?> </i> </button>
	 <button id="updateData" type="button" class="btn btn-warning"> <i class="fas fa-retweet"> <?php echo burengo_update; ?> </i> </button>
	 
	</div></div>	 
   </div>
</div>
 </div><!-- /.container-fluid -->
    </section>
  </div>
<!-- /.content-wrapper -->
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
<li class="pt-2"><a href="../../../contacto.php" class="btn-link text-white"> <i class="fas fa-envelope-open-text fa-1x text-info"></i> Preguntas y Sugerencias      </a></li>
               
              </ul>		
		
	</div>
<div class="col-md-12 pt-4 " style="bottom:0;"> 	<h6 class="mb-2">Burengo.com &copy; 2020 - <?php echo burengo_copyright; ?> </h6> </div>	
</div>
	
</footer>
</div>
<script src="<?php echo burengoBaseUrl; ?>plugins/jquery/jquery.min.js"></script>
<script src="<?php echo burengoBaseUrl; ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo burengoBaseUrl; ?>dist/js/adminlte.min.js"></script>
<script src="<?php echo burengoBaseUrl; ?>plugins/toastr/toastr.min.js"></script>
<script src="<?php echo burengoBaseUrl; ?>dist/js/demo.js"></script>
<script src="<?php echo burengoBaseUrl; ?>plugins/jquery-number/jquery.number.js"></script>
<script type="text/javascript"> 
$('#price').number(true,0); 
$('#brands').change(function(){$('#models').load('<?php echo burengoBaseUrl; ?>ajax/bgo_select_car_models.php?id='+$('#brands').val()); });
 
$('#cancel').click(function(){ 
var ch = $('#url').val();
switch(ch){
	case '1': location.href="confirmacion.php?ccdt="+$('#pcode').val();  break;
	case '2': location.href="<?php echo burengoBaseUrl; ?>mis-publicaciones.php"; break;
	default: location.href="<?php echo burengoBaseUrl; ?>";  break; 
}
});


/* BTN Next  */
$('#updateData').click(function(){
 if( !isEmpty($('#title').val()) ){
if( $('#brands').val() != 0 ){ 
if( $('#models').val() != 0){
if( $('#activeYears').val() != 0){
if( $('#uom').val() != 0){
if( !isEmpty($('#price').val()) ){	
if( $('#currency').val() != 0){
if( $('#fuel').val() != 0){
if( $('#cartype').val() != 0){
if( $('#trasnmision').val() != 0){
if( $('#color').val() != 0){
if( !isEmpty($('#addrs').val()) ){	 
if( $('#place').val() != 0){
	save_data();
}else{ toastr.error('Debe colocar la provincia donde se encuentra el vehículo'); }
}else{ toastr.error('Debe colocar la direccion donde se encuentra el vehículo'); }
}else{ toastr.error('Debe seleccionar el color del vehículo'); }
}else{ toastr.error('Debe seleccionar el tipo de Transmision del vehículo'); }
}else{ toastr.error('Debe seleccionar el tipo de vehículo'); }
}else{ toastr.error('Debe seleccionar el tipo de Combustible del vehículo'); }
}else{ toastr.error('Debe seleccionar el tipo de moneda para la venta'); }
}else{ toastr.error('Debe colocar el Precio del vehículo'); }
}else{ toastr.error('Debe seleccionar el periodo de Renta del vehículo '); }
}else{ toastr.error('Debe seleccionar el Año del vehículo'); }
}else{ toastr.error('Debe seleccionar el Moldelo del vehículo'); }
}else{ toastr.error('Debe seleccionar la Marca del vehículo'); }
}else{ $('#title').focus();  toastr.error('Debe completar todos los campos'); }
});


function save_data(){
 var cond = "Usado";
 
 $.getJSON('<?php echo burengoBaseUrl; ?>ajax/burengo_update_vehicle.php',{
	code: $('#pcode').val(),
	title: $('#title').val(),
	price: $('#price').val(),
	lugar: $('#place').val(),
	uom: $('#uom').val(),
	condition: cond,
	marca: $('#brands').val(),
	modelo: $('#models').val(),
	year: $('#activeYears').val(),
	currency: $('#currency').val(),
	fuel: $('#fuel').val(),
	vtype: $('#cartype').val(),
	transmision: $('#trasnmision').val(),
	traccion: $('#traccion').val(),
	color: $('#color').val(),
	color_interior: $('#interior').val(),
	puertas_cantidad: $('#doors').val(),
	pasajeros_cantidad: $('#passengers').val(),
	addr: $('#addrs').val(),  
	notes: $('#notes').val()	
  },function(data){
		switch(data['ok']){
			case 0: toastr.error('ERROR! No se pudo almacenar los datos: '+ data['err']); break;
			case 1:  location.href="fotos-edit.php?ccdt=" + $('#pcode').val()+"&pth="+$('#url').val(); break;
		}
	});		
	
}

function isEmpty(str) {
    return (!str || 0 === str.length);
}


$('#updPic').click(function(){ location.href="fotos-edit.php?ccdt="+$('#pcode').val()+"&pth="+$('#url').val(); });
</script>
</body>
</html>
