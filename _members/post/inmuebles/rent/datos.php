<?php 
session_start();
date_default_timezone_set("America/Santo_Domingo");
require_once "../../../../modelos/data.php";
$postCode = 'BGS'.date('YmdHis').rand(1000,9999); /* Codigo de 20 caracteres */
$codeFake = $_REQUEST["ccdt"];
$cat = 2;
$subcat = 2;
$strcat = "Renta";	

if(isset($_SESSION['bgo_userId'])){   
}else{
  header('Location: ../../../../acceder.php'); 
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
<style>
 
@media only screen and (min-width: 992px) {	
	.bgo-wrapper{width: 600px;  height: 100px;  padding-left:100px;}
	.bgo-margin-area {position: relative;  text-align: center;  font-family: "Trebuchet", sans-serif;  font-size: 14px;  margin: 0 20px;}
	.bgo-dot {height: 30px; width: 30px; position: absolute; background: #000; border-radius: 50%; top: 10px; color: #fff; line-height: 30px; z-index: 9999;}
	.bgo-dot.bgo-one {left: 35px; background: #0C84D9;}
	.bgo-dot.bgo-two {left: 180px; background: #bbb;}
	.bgo-dot.bgo-three {left: 330px; background: #bbb; color: #fff; }
	.bgo-progress-bar { position: absolute;  height: 10px;  width: 35%;  top: 20px;  left: 10%;  background: #bbb;}
	.bgo-progress-bar.bgo-first {background: #bbb;}
	.bgo-progress-bar.bgo-second {left: 40%;}
	.bgo-message{position: absolute; height: 60px; width: 170px; padding: 10px; margin: 0; left: -50px; top: 0; color: #000;}
	.bgo-message.bgo-message-1 {top: 40px; color: #000;}
	.bgo-message.bgo-message-2 {left: 160px;}
	.bgo-message.bgo-message-3 {left: 160px;color: #000;}
}


/*  Vista celulares y tablet portrait */
@media screen and (max-width: 700px) {
	.bgo-wrapper{ padding-left:10px; width: 450px; height: 100px; }
	.bgo-margin-area {position: relative;  text-align: center;  font-family: "Trebuchet", sans-serif;  font-size: 14px;  margin: 0 20px;}
	
	.bgo-dot {height: 30px; width: 30px; position: absolute; background: #000; border-radius: 50%; top: 10px; color: #fff; line-height: 30px; z-index: 9999;}
	.bgo-dot.bgo-one {left: 35px; background: #0C84D9;}
	.bgo-dot.bgo-two {left: 180px; background: #bbb;}
	.bgo-dot.bgo-three {left: 330px; background: #bbb; color: #fff; }
	
	.bgo-progress-bar { position: absolute;  height: 10px;  width: 45%;  top: 20px;  left: 10%;  background: #bbb;}
	.bgo-progress-bar.bgo-first {background: #bbb;}
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
	.bgo-dot.bgo-two {left: 180px; background: #bbb;}
	.bgo-dot.bgo-three {left: 330px; background: #bbb; color: #fff; }
	
	.bgo-progress-bar { position: absolute;  height: 10px;  width: 45%;  top: 20px;  left: 10%;  background: #bbb;}
	.bgo-progress-bar.bgo-first {background: #bbb;}
	.bgo-progress-bar.bgo-second {left: 40%;}
	.bgo-message{position: absolute; height: 60px; width: 170px; padding: 10px; margin: 0; left: -50px; top: 0; color: #000;}
	.bgo-message.bgo-message-1 {top: 40px; color: #000;}
	.bgo-message.bgo-message-2 {left: 160px;}
	.bgo-message.bgo-message-3 {left: 160px;color: #000;}
}
</style>
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">
 <nav class="main-header navbar navbar-expand-md navbar-dark bg-navy"> 
    <div class="container">
      <a href="<?php echo burengoBaseUrl; ?>members/inicio.php" class="navbar-brand">
	     <img src="<?php echo burengoBaseUrl; ?>dist/img/burengo.png" alt="Burengo Logo" class="brand-image   elevation-0" style="opacity: .8">  
      </a>
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
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
 <section class="content">
      <div class="container-fluid">
        <div class="row">
         <div class="col-md-12">
	<!------------------------------> 
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
			<div class="bgo-message bgo-message-3"> <?php echo burengo_confirmData; ?> <div>
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
<h3 class="card-title"><i class="fas fa-home"></i>  <?php echo burengo_rentHouseTitle; ?>  </h3>
<input id="pcode" type="hidden" value="<?php echo $postCode; ?>">
<input id="cat" type="hidden" value="<?php echo $cat; ?>">
<input id="subcat" type="hidden" value="<?php echo $subcat; ?>">
<input id="userId" type="hidden" value="<?php echo $_SESSION['bgo_userId']; ?>">
<input id="userProfile" type="hidden" value="<?php echo $_SESSION['bgo_perfil']; ?>">
</div>
<div class="card-body">
<div class="row">
<div class="col-sm-12">
<div class="form-group">
<input id="title" maxlength="25" type="text" class="form-control" placeholder="<?php echo burengo_saleHouseT1a; ?>">
</div>
</div>
</div>
			
<div class="row">
<div class="col-sm-6">
<div class="form-group">
<select id="types" class="form-control"> 
<option value="0">  <?php echo burengo_ptype; ?> </option>
<option value="13"> <?php echo burengo_homes; ?>  </option>
<option value="14"> <?php echo burengo_apartment; ?> </option>
<option value="15"> <?php echo burengo_villas; ?> </option>
<option value="16"> <?php echo burengo_solares; ?> </option>
<option value="17"> <?php echo burengo_finca; ?> </option>
<option value="18"> <?php echo burengo_naves; ?> </option>
<option value="19"> <?php echo burengo_oficinas; ?> </option>
<option value="20"> <?php echo burengo_edf; ?> </option>
<option value="21"> <?php echo burengo_penthouse; ?> </option>
<option value="22"> <?php echo burengo_comercial; ?> </option>
<option value="23"> <?php echo burengo_events; ?> </option>
<option value="24"> <?php echo burengo_otros; ?> </option>								
</select> 
</div>
</div>

<div class="col-sm-6">
<div class="form-group">
<select id="niveles" class="form-control">
<option value="0"> <?php echo burengo_levels; ?> </option>
<option value="1"> 1 </option>
<option value="2"> 2 </option>
<option value="3"> 3 </option>
<option value="4"> 4 </option>
<option value="5"> 5 </option>
<option value="6"> 6 </option>
<option value="7"> 7 </option>
<option value="8"> 8 </option>
<option value="9"> 9 </option>
<option value="10"> 10 </option>
<option value="11"> 11 </option>
<option value="12"> 12 </option>
</select>                    
</div>
</div>
</div>

<div class="row">
<div class="col-sm-6">
<div class="form-group">
<select id="place" class="form-control">
  <option value="0"> <?php echo burengo_place; ?> </option>
</select> 
</div>
</div>
<div class="col-sm-6"><div class="form-group">
<input id="addrs" type="text" class="form-control" placeholder="<?php echo burengo_addr; ?>">
</div>
</div>
</div>

<div class="row">
<div class="col-sm-6">
<div class="form-group"><input id="price" type="text" class="form-control" placeholder="<?php echo burengo_price; ?>"></div>
</div>				
<div class="col-sm-6">
<div class="form-group">
<select id="uom" class="form-control"> 
	<option value="0"> <?php echo burengo_rentPeriod; ?> </option>
	<option value="1"> <?php echo burengo_day; ?>  </option>
	<option value="2"> <?php echo burengo_night; ?>  </option>
	<option value="3"> <?php echo burengo_hour; ?>  </option>
	<option value="4"> <?php echo burengo_week; ?>  </option>
	<option value="5"> <?php echo burengo_month; ?>  </option>	
</select>
</div>
</div>
</div>
		 
			<!-- Transmision / Traccion -->			 	
			<div class="row">
					<div class="col-sm-6">
             	<div class="form-group">
						<select id="currency" class="form-control"> 
							<option value="0"> <?php echo burengo_currencyType; ?> </option>
						</select>
					</div>
                    </div>					
					
					<div class="col-sm-6">
                      <div class="form-group"> 
						<input id="rooms" type="number" class="form-control" placeholder="<?php echo burengo_roomQty; ?>" />               
					</div>
                    </div>
                  </div>
			<!-- Color -->		
			<div class="row">
					<div class="col-sm-6">
                      <div class="form-group">
                      		<input id="baths" type="number" class="form-control" placeholder="<?php echo burengo_bathQty; ?>" />
                    
					</div>
                    </div>					
					
					<div class="col-sm-6">
                      <div class="form-group">
					   <div class="input-group mb-3">
						<input id="garage" type="number" class="form-control" placeholder="<?php echo burengo_parkQty; ?>" /> 
                  
                </div>                     
					</div>
                    </div>
                  </div>			
				  
				  <div class="row">
					<div class="col-sm-6">
                      <div class="form-group">
                      		<input id="terreno" class="form-control" placeholder="<?php echo burengo_landQty; ?>" />
                    
					</div>
                    </div>					
					
					<div class="col-sm-6">
                      <div class="form-group">
					   <div class="input-group mb-3">
						<input id="construccion" class="form-control" placeholder="<?php echo burengo_constructionQty ?>" /> 
                  
                </div>                     
					</div>
                    </div>
                  </div>
				  
				  	<div class="row">
				  	<div class="col-md-12">
                     
					  <textarea id="notes" class="form-control" rows="7" placeholder="<?php echo burengo_description; ?>"></textarea>
                  </div>
                  </div>
		 					
		   
			<!-- Ubicacion --> 	
			<div class="row">
				 <div class="col-sm-12">
					<div class="form-group">
                                           
					</div>
                </div>					 
			</div> 
			<div class='row'>
			<div class="col-sm-12">
				 <div class="card-header">
                <h3 class="card-title">    </h3>
              </div>
            </div>
            </div>
	 </div> <!-- Card Body -->
          <div class="card-footer">
              <button id="cancel" type="button" class="btn btn-danger"> <i class="fas fa-times-circle"></i> <?php echo burengo_cancel; ?> </button>
              <button id="next" type="button" class="btn btn-primary float-right"> <?php echo burengo_next; ?> <i class="fas fa-arrow-alt-circle-right"></i> </button>
          </div>	 
   </div>
 </div>
 <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  </div>
<!-- /.content-wrapper -->
  <footer class="main-footer"> Burengo &copy; 2020 - <?php echo burengo_copyright; ?>   </footer>
</div>
<!-- ./wrapper -->

<script src="<?php echo burengoBaseUrl; ?>plugins/jquery/jquery.min.js"></script>
<script src="<?php echo burengoBaseUrl; ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo burengoBaseUrl; ?>dist/js/adminlte.min.js"></script>
<script src="<?php echo burengoBaseUrl; ?>plugins/toastr/toastr.min.js"></script>
<script src="<?php echo burengoBaseUrl; ?>dist/js/demo.js"></script>
<script src="<?php echo burengoBaseUrl; ?>/plugins/jquery-number/jquery.number.js"></script>
<script type="text/javascript"> 
$('#place').load('<?php echo burengoBaseUrl; ?>ajax/burengo_select_places.php');
$('#currency').load('<?php echo burengoBaseUrl; ?>ajax/bgo_select_currency.php')
$('#price').number(true,0); 

$('#cancel').click(function(){ location.href="../../../inicio.php"; });

/* BTN Next  */
$('#next').click(function(){
if( !isEmpty($('#title').val()) ){
if( $('#types').val() != 0 ){ 
if( $('#place').val() != 0 ){ 
if( !isEmpty($('#addrs').val()) ){
if( $('#uom').val() != 0 ){
if( $('#currency').val() != 0 ){ 	
		save_data();
}else{ toastr.error('Debe seleccionar el tipo de moneda'); }
}else{ toastr.error('Debe seleccionar el periodo de Renta'); }	
}else{ toastr.error('Debe colocar la direccion de la propiedad'); }	
}else{ toastr.error('Debe seleccionar la Provincia'); }
}else{ toastr.error('Debe seleccionar el tipo de Prodiedad'); }
}else{ $('#title').focus();  toastr.error('Debe completar todos los campos'); }	
});


function save_data(){
var rooms = 0;	
var baths = 0;	
var garage = 0;	
var terreain = '-';	
var cons = '-';	
var notes = '';

if( !isEmpty($('#rooms').val()) ){ var rooms =  $('#rooms').val();}
if( !isEmpty($('#baths').val()) ){ var baths =  $('#baths').val();}
if( !isEmpty($('#garage').val()) ){ var garage =  $('#garage').val();}
if( !isEmpty($('#terreno').val()) ){ var terreain = $('#terreno').val();}
if( !isEmpty($('#construccion').val()) ){ var cons = $('#construccion').val();}
if( !isEmpty($('#notes').val()) ){ var notes = $('#notes').val();}

$.getJSON('<?php echo burengoBaseUrl; ?>ajax/burengo_insert_inmueble.php',{
	code: $('#pcode').val(),
	usercode: $('#userId').val(),
	cat: $('#cat').val(),
	subcat: $('#subcat').val(),
	title: $('#title').val(),
	type: $('#types').val(),
	niveles: $('#niveles').val(),
	lugar: $('#place').val(),
	addr: $('#addrs').val(),
	price: $('#price').val(),
	uom: $('#uom').val(),
	currency: $('#currency').val(),	
	rooms: rooms,
	baths: baths,
	garage: garage,
	terreno: terreain,
	construccion: cons, 
	destacado: $('#userProfile').val(),		
	notes: notes
  },function(data){
		switch(data['ok']){
			case 0: toastr.error('ERROR! No se pudo almacenar los datos: '+ data['err']); break;
			case 1: location.href="fotos.php?ccdt="+data['ccdt']; break;
		}
	});	
}

function isEmpty(str) {
    return (!str || 0 === str.length);
}

</script>
</body>
</html>
