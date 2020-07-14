<?php 
session_start();
date_default_timezone_set("America/Santo_Domingo");
require_once "../../../modelos/data.php";
$postCode = 'BGS'.date('YmdHis').rand(1000,9999); /*Codigo de 20 caracteres */
$codeFake = $_REQUEST["ccdt"];
 
$cat = 2;
$subcat = 1;
$strcat = "Renta";	
 
if(isset($_SESSION['bgo_userId'])){   
}else{
  header('Location: ../../../acceder.php'); 
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
      <a href="<?php echo burengoBaseUrl; ?>" class="navbar-brand">
	   <img src="<?php echo burengoBaseUrl; ?>dist/img/burengo.png" alt="Burengo Logo" class="brand-image   elevation-0" style="opacity: .8">  
      </a>
      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <ul class="navbar-nav"> </ul>
      </div>

     <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <li class="nav-item"><a class="nav-link" href="<?php echo burengoBaseUrl; ?>profile.php">
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
                <h3 class="card-title"><i class="fas fa-car"></i> <?php echo burengo_rentCarTitle; ?> </h3>
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
						<input id="title" maxlength="120" type="text" class="form-control" 
						placeholder="<?php echo burengo_saleCarT1a; ?>">
                      </div>
                    </div>
            </div>
 			
			<div class="row">
                 <div class="col-sm-6">
					<div class="form-group">
						<select id="brands" class="form-control"> 
							<option value="0"> <?php echo burengo_marca; ?> </option> 
						</select> 
					</div>
				 </div>
				 
                 <div class="col-sm-6">
					<div class="form-group">
						<select id="models" class="form-control"> 
							<option value="0">  <?php echo burengo_carModels; ?> </option> 
						</select>
					</div>
				</div>
             </div>
			<!-- Anio / Condicion -->
			<div class="row">
                   <div class="col-sm-6"> 
						<div class="form-group">
							<select id="activeYears" class="form-control"> 
								<option value="0"> <?php echo burengo_selectedYear; ?> </option> 
							</select> 
						</div>
					 </div>
					<div class="col-sm-6">
          <div class="form-group">
					   <div class="input-group mb-3">
                  <select id="cartype" class="form-control">
                        <option value="0"> <?php echo burengo_carType; ?>  </option>
						<option value="1"> <?php echo burengo_sedan; ?>   </option>
						<option value="2"> <?php echo burengo_jeepeta; ?>  </option> 
						<option value="3"> <?php echo burengo_camioneta; ?>  </option>
						<option value="4"> <?php echo  burengo_limo; ?>    </option>
						<option value="5"> <?php echo  burengo_coupe; ?>    </option>
						<option value="6"> <?php echo  burengo_moto; ?>  </option>
						<option value="7"> <?php echo  burengo_bus; ?>  </option>
						<option value="8"> <?php echo  burengo_boat; ?>  </option>
						<option value="9"> <?php echo  burengo_jetski; ?>  </option>
						<option value="10"> <?php echo  burengo_truck; ?>  </option>
						<option value="11"> <?php echo  burengo_pesados; ?>  </option>
						<option value="12"> <?php echo  burengo_otros; ?>  </option>
                    </select> 
                </div>                     
					</div>
                    </div>
                  </div>
			<!-- Precio / Tipo de Moneda -->	
			 
				 
			<!---- UOM  --------->	 
				 	<div class="row">
                    <div class="col-sm-6">
						<div class="form-group">
							<input id="price" type="text" class="form-control" placeholder="Precio">
						</div>
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
				 
				 
			<!-- Combustible / Tipo de Vehiculo -->					
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
							<select id="fuel" class="form-control">
								<option value="0"> Combustible </option>
							  </select>
							</div>
                    </div>
                  </div>
			<!-- Transmision / Traccion -->			 	
			<div class="row">
					<div class="col-sm-6">
                      <div class="form-group">
                        <select id="trasnmision" class="form-control">
                        <option value="0"> <?php echo burengo_transmition; ?> </option>
						<option value="1"> <?php echo burengo_gas; ?> </option>
						<option value="2"> <?php echo burengo_glp; ?> </option>
						<option value="3"> <?php echo burengo_diessel; ?> </option>	
                        </select>                    
					</div>
                    </div>					
					
					<div class="col-sm-6">
                      <div class="form-group"> 
						<select id="traccion" class="form-control">
                          <option value="0"> Traccion </option>
              
                        </select>                
					</div>
                    </div>
                  </div>
			<!-- Color -->		
			<div class="row">
					<div class="col-sm-6">
                      <div class="form-group">
                        <select id="color" class="form-control">
						 <option value="0"> Color </option>
                        </select>                    
					</div>
                    </div>					
					
					<div class="col-sm-6">
                      <div class="form-group">
					   <div class="input-group mb-3">
						<select id="interior" class="form-control">
                          <option value="0"> Color Interior </option>
  
                        </select> 
                  
                </div>                     
					</div>
                    </div>
                  </div>
			<!-- Puertas / Pasajeros --> 					
			<div class="row">
    			<div class="col-sm-6">
                      <div class="form-group">
                        <select id="doors" class="form-control">
                          <option value="0"> <?php echo burengo_doorQty; ?> </option>
                          <option value="0">0</option>
						  <option value="2">2</option>
						  <option value="3">3</option>
						  <option value="4">4</option>
						  <option value="5">5</option>
						</select>                    
					</div>
				</div>					 
				<div class="col-sm-6"><div class="form-group">
					<input id="passengers" type="text"  class="form-control" placeholder="<?php echo burengo_passengerQty; ?>"> 
					</div>
					</div>	
			</div>  
			<!-- Ubicacion --> 	
			<div class="row"><div class="col-sm-12"><div class="form-group"><input id="addrs" type="text" 
			class="form-control" placeholder="<?php echo burengo_addr; ?>"></div></div></div>
			<div class="row">
				 <div class="col-sm-12">
					<div class="form-group">
                        <select id="place" class="form-control">
                          <option value="0"> <?php echo burengo_place; ?> </option>
					 
						</select>                    
					</div>
                </div>					 
			</div> 
			<div class='row'>
			<div class="col-sm-12">
				 <div class="card-header">
                <h3 class="card-title"> <i class="fas fa-list"></i> <?php echo burengo_Acc_Observation; ?>  </h3>
              </div>
            </div>
            </div>
			<div class="row carAcc">
				<div class="col-md-4 p-4">
					<div class="form-group">
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input opAcc" type="checkbox" id="acc-1"  vldt="3ra Fila de asientos" pos="0">
                          <label for="acc-1" class="custom-control-label"> <?php echo burengo_3row; ?> </label>
                        </div>
						
						<div class="custom-control custom-checkbox pt-2">
                          <input class="custom-control-input opAcc" type="checkbox" id="acc-2" vldt="Asientos Leather" pos="1" >
                          <label for="acc-2" class="custom-control-label"> <?php echo burengo_leather; ?> </label>
                        </div>
						
						<div class="custom-control custom-checkbox pt-2">
                          <input class="custom-control-input opAcc" type="checkbox" id="acc-3" vldt="Baul eléctrico" pos="2" >
                          <label for="acc-3" class="custom-control-label"> <?php echo burengo_trunk; ?> </label>
                        </div>						
						
						<div class="custom-control custom-checkbox pt-2">
                          <input class="custom-control-input opAcc" type="checkbox" id="acc-4" vldt="Bolsa de Aire conductor" pos="3" >
                          <label for="acc-4" class="custom-control-label"> <?php echo burengo_airBag1; ?> </label>
                        </div>						
						
						<div class="custom-control custom-checkbox pt-2">
                          <input class="custom-control-input opAcc" type="checkbox" id="acc-5" vldt="<?php echo burengo_airBag2; ?>" pos="4" >
                          <label for="acc-5" class="custom-control-label"> <?php echo burengo_airBag2; ?> </label>
                        </div>						
						
						<div class="custom-control custom-checkbox pt-2">
                          <input class="custom-control-input opAcc" type="checkbox" id="acc-6" vldt="Cámara Reversa" pos="5" >
                          <label for="acc-6" class="custom-control-label"> <?php echo burengo_reverseCam; ?> </label>
                        </div>						
 
                      </div>                    
                  </div>
                <div class="col-md-4 p-4">
                <div class="form-group">
					<div class="custom-control custom-checkbox pt-2">
                          <input class="custom-control-input opAcc" type="checkbox" id="acc-7" vldt="Faros LED" pos="6" >
                          <label for="acc-7" class="custom-control-label"> <?php echo burengo_led; ?> </label>
                        </div>		
						
						<div class="custom-control custom-checkbox pt-2">
                          <input class="custom-control-input opAcc" type="checkbox" id="acc-8" vldt="Llave Inteligente/Encendido Botón" pos="7" >
                          <label for="acc-8" class="custom-control-label"> <?php echo burengo_smartKey; ?>  </label>
                        </div>						
						<div class="custom-control custom-checkbox pt-2">
                          <input class="custom-control-input opAcc" type="checkbox" id="acc-9" vldt="Radio Multimedia" pos="8" >
                          <label for="acc-9" class="custom-control-label"> <?php echo burengo_carRadio; ?>  </label>
                        </div>						
						<div class="custom-control custom-checkbox pt-2">
                          <input class="custom-control-input opAcc" type="checkbox" id="acc-10" vldt="Seguros eléctricos" pos="9" >
                          <label for="acc-10" class="custom-control-label"> <?php echo burengo_carLock; ?>   </label>
                        </div>						
						<div class="custom-control custom-checkbox pt-2">
                          <input class="custom-control-input opAcc" type="checkbox" id="acc-11" vldt="Sunroof" pos="10" >
                          <label for="acc-11" class="custom-control-label"> <?php echo burengo_sunroof; ?>   </label>
                        </div>						
						<div class="custom-control custom-checkbox pt-2">
                          <input class="custom-control-input opAcc" type="checkbox" id="acc-12" vldt="Vidrios eléctricos" pos="11" >
                          <label for="acc-12" class="custom-control-label"> <?php echo burengo_electric; ?>    </label>
                        </div>					 
					 
					 </div>
                  </div>
				<div class="col-md-4 p-4">
                      <input id="accesories" type="hidden"  />
					  <textarea id="notes" class="form-control" rows="7" placeholder="<?php echo burengo_description_dteails; ?>"></textarea>
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
var listaItems = [0,0,0,0,0,0,0,0,0,0,0,0];	
 
$('#price').number(true,0);  
 
$('#brands').load('<?php echo burengoBaseUrl; ?>ajax/bgo_select_car_brands.php');
$('#activeYears').load('<?php echo burengoBaseUrl; ?>ajax/bgo_select_active_years.php');
$('#currency').load('<?php echo burengoBaseUrl; ?>ajax/bgo_select_currency.php');
$('#color').load('<?php echo burengoBaseUrl; ?>ajax/burengo_select_color.php');
$('#interior').load('<?php echo burengoBaseUrl; ?>ajax/burengo_select_color_interior.php');
$('#place').load('<?php echo burengoBaseUrl; ?>ajax/burengo_select_places.php');
$('#fuel').load('<?php echo burengoBaseUrl; ?>ajax/burengo_select_fuel.php');
$('#traccion').load('<?php echo burengoBaseUrl; ?>ajax/burengo_select_traccion.php');
$('#trasnmision').load('<?php echo burengoBaseUrl; ?>ajax/burengo_select_trasnmision.php');
$('#brands').change(function(){$('#models').load('<?php echo burengoBaseUrl; ?>ajax/bgo_select_car_models.php?id='+$('#brands').val()); });
$('#cancel').click(function(){ location.href="<?php echo burengoBaseUrl; ?>members/inicio.php"; });

$('.carAcc').on("change","input.opAcc",function(){
	var value = $(this).attr('vldt');
	var p = $(this).attr('pos');
		if($(this).is(':checked')){
			  listaItems[p] = value;
			 $('#accesories').val(JSON.stringify(listaItems));
		}else{
			listaItems[p] = 0;
			 $('#accesories').val(JSON.stringify(listaItems));
		}
	
});

/* BTN Next  */
$('#next').click(function(){
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
 $.getJSON('<?php echo burengoBaseUrl; ?>ajax/burengo_insert_vehicle.php',{
	code: $('#pcode').val(),
	usercode: $('#userId').val(),
	cat: $('#cat').val(),
	subcat: $('#subcat').val(),
	title: $('#title').val(),
	price: $('#price').val(),
	lugar: $('#place').val(),
	uom: $('#uom').val(),
	marca: $('#brands').val(),
	modelo: $('#models').val(),
	year: $('#activeYears').val(),
	condicion: cond,
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
	accesories: $('#accesories').val(), 
	destacado: $('#userProfile').val(),  	
	notes: $('#notes').val()	
  },function(data){
		switch(data['ok']){
			case 0: toastr.error('ERROR! No se pudo almacenar los datos: '+ data['err']); break;
			case 1:  location.href="fotos.php?ccdt="+data['ccdt']; break;
		}
	});		
	
}

function isEmpty(str) {
    return (!str || 0 === str.length);
}
</script>
</body>
</html>