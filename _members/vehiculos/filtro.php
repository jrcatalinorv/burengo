<?php 
session_start();
date_default_timezone_set("America/Santo_Domingo");
require_once "../../modelos/conexion.php";
require_once "../../modelos/data.php";
require_once "../../modelos/settings.php";
$tp = $_REQUEST['cat'];


if(isset($_SESSION['bgo_userId'])){   
}else{
  header('Location: '.burengoBaseUrl.'vehiculos/filtro.php?cat='.$tp); 
} 

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="icon" type="image/png" href="<?php echo burengoBaseUrl; ?>favicon.ico"/>
  <title>Burengo - Compra, renta o vende vehículos e inmuebles</title>
  <link rel="stylesheet" href="<?php echo burengoBaseUrl; ?>plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?php echo burengoBaseUrl; ?>plugins/bootstrap-slider/css/bootstrap-slider.min.css">
  <link rel="stylesheet" href="<?php echo burengoBaseUrl; ?>dist/css/adminlte.css">
  <link rel="stylesheet" href="<?php echo burengoBaseUrl; ?>dist/css/burengo-min.css"> 
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">
 <nav class="main-header navbar navbar-expand-md navbar-dark bg-navy"> 
    <div class="container">
      <a href="../inicio.php" class="navbar-brand">
          <img src="<?php echo burengoBaseUrl; ?>dist/img/burengo.png" alt="Burengo Logo" class="brand-image   elevation-0" style="opacity: .8">  
      </a>
      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <ul class="navbar-nav"> </ul>
      </div>

      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
              <li class="nav-item"><a class="nav-link" href="../profile.php">
			 <img alt="Avatar"  class="user-image" src="<?php echo burengoBaseUrl; ?>media/users/<?php echo $_SESSION['bgo_userImg']; ?>">
			 <?php echo $_SESSION['bgo_user']; ?></a>
		</li>	
		
	<li class="nav-item dropdown show">
        <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="true">
          <i class="fas fa-bars fa-lg"></i> </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">	  
		  <div class="dropdown-divider"></div>	
		  <a href="../inicio.php" class="dropdown-item">
            <i class="fas fa-th mr-2"></i> <?php echo burengo_portada; ?>
          </a>
          <div class="dropdown-divider"></div>		  
          <a href="../publicaciones.php" class="dropdown-item">
            <i class="far fa-list-alt mr-2"></i><?php echo burengo_Mypost; ?> 
          </a>
          <div class="dropdown-divider"></div>
          <a href="../profile.php" class="dropdown-item">
            <i class="far fa-id-badge mr-2"></i> <?php echo burengo_Account; ?>    
          </a>
          <div class="dropdown-divider"></div>
          <a href="../mensajes-recibidos.php" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> <?php echo burengo_msg; ?>
          </a>
          <div class="dropdown-divider"></div>
          <a href="../salir.php" class="dropdown-item"> <i class="fas fa-sign-out-alt text-danger mr-2"></i> <?php echo burengo_logout; ?> </a>
        </div>
      </li>
		
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->

  <div class="content-wrapper bg-white">
    <div class="content ">
      <div class=" ">
        <div class="row pt-2 ">
          <div class="col-lg-3 ">
		  <input id="oldSelected" value="0" type="hidden" />
		  <input id="tpm2" value="<?php echo $tp; ?>"  type="hidden" />
		  <input id="tipocarro"  type="hidden" value="0" />
		  <input id="string"     type="hidden" />
		  <input id="getCat"       type="hidden" value="<?php echo $tp; ?>" />
		  	<div class="card">
              <div class="card-body p-1 opFilters">
			       <div class="pt-2">
			    <div class="btn-group col-lg-12 p-0 viewFilter">
				  <button id="btn1" class="btn btn-lg btn-default"><i class="fas fa-car"></i> <?php echo burengo_buy; ?> </button>
				  <button id="btn2" class="btn btn-lg btn-default"><i class="fas fa-car"></i> <?php echo burengo_rent; ?></button>
               </div>                                       
					</div>
			  
			  
                  <div class="pt-2">
                        <select id="condition" class="form-control opSelector" variable="condition">
                          <option value="0"><?php echo burengo_carCondition; ?> </option>
                          <option value="0"> <?php echo burengo_all; ?> </option>
                          <option value="Nuevo"><?php echo burengo_new; ?> </option>
                          <option value="Usado"> <?php echo burengo_used; ?> </option>
                        </select>                    
					</div>
				  <div class="pt-2">
						<select id="brands" class="form-control opSelector" variable="marca"> 
						<option value="0"> <?php echo burengo_carBrands; ?> </option> </select>
						</select> 
				</div> 
                <div class="pt-2"><select id="models" class="form-control"> 
					<option value="0"> <?php echo burengo_carModels; ?> </option> </select></div> 
             	
				<div class="card-header">
            <h3 class="card-title"> <?php echo burengo_carType; ?> </h3>

            <div class="card-tools">
              <a id="ctpBtn" href="#" class="btn-tool" optp="show" ></a>
            </div>
          </div>
			 
	<div id="ctp"  class="row pt-0 Hideme">
		
				<div class="col-sm-4 border-right border-top carTypeTxt ch1" cttlabel="1">
                    <div class="description-block">
                      <h5 class="description-header"><img class="img-circle" style="width:50px;" src="<?php echo burengoBaseUrl; ?>media/icons/sedan.png" alt="User Image"> </h5>
                      <span class="description-text"><?php echo burengo_sedan; ?></span>
                    </div>             
                  </div>				
				  
				  <div class="col-sm-4 border-right border-top carTypeTxt ch2" cttlabel="2">
                    <div class="description-block">
                      <h5 class="description-header"><img class="" style="width:50px;" src="<?php echo burengoBaseUrl; ?>media/icons/todoterreno.png" alt="User Image"> </h5>
                      <span class="description-text"><?php echo  burengo_jeepeta; ?></span>
                    </div>         
                  </div>				  
				  
				  <div class="col-sm-4 border-top carTypeTxt ch3" cttlabel="3">
                    <div class="description-block ">
                      <h5 class="description-header"><img class="" style="width:50px;" src="<?php echo burengoBaseUrl; ?>media/icons/camioneta.png" alt="User Image"> </h5>
                      <span class="description-text"><?php echo  burengo_camioneta; ?></span>
                    </div>
                  </div>				  
				  <!------ Row 2-------->
				  <div class="col-sm-4 border-right border-top carTypeTxt ch4" cttlabel="4">
                    <div class="description-block">
                      <h5 class="description-header"><img style="width:50px;" src="<?php echo burengoBaseUrl; ?>media/icons/limusina.png" alt="User Image"> </h5>
                      <span class="description-text"><?php echo  burengo_limo; ?></span>
                    </div>
                  </div>				  
				  
				  <div class="col-sm-4 border-right border-top carTypeTxt ch5" cttlabel="5">
                    <div class="description-block">
                      <h5 class="description-header"><img style="width:50px;" src="<?php echo burengoBaseUrl; ?>media/icons/sport-car.png" alt="User Image"> </h5>
                      <span class="description-text"><?php echo  burengo_coupe; ?></span>
                    </div>
                  </div>				  
				  
				  <div class="col-sm-4 border-top carTypeTxt ch6" cttlabel="6">
                    <div class="description-block">
                      <h5 class="description-header"><img style="width:50px;" src="<?php echo burengoBaseUrl; ?>media/icons/motocicleta.png" alt="User Image"> </h5>
                      <span class="description-text"> <?php echo  burengo_moto; ?> </span>
                    </div>
                  </div>
				  	  <!------ Row 3 -------->
				  <div class="col-sm-4 border-right border-top carTypeTxt ch7" cttlabel="7">
                    <div class="description-block">
                      <h5 class="description-header"><img style="width:50px;" src="<?php echo burengoBaseUrl; ?>media/icons/bus-electrico.png" alt="User Image"> </h5>
                      <span class="description-text"><?php echo  burengo_bus; ?></span>
                    </div>
                  </div>				  
				  
				  <div class="col-sm-4 border-right border-top carTypeTxt ch8" cttlabel="8">
                    <div class="description-block">
                      <h5 class="description-header"><img style="width:50px;" src="../../media/icons/barco.png" alt="User Image"> </h5>
                      <span class="description-text"><?php echo  burengo_boat; ?> </span>
                    </div>
                  </div>				  
				  
				  <div class="col-sm-4 border-top carTypeTxt ch9" cttlabel="9">
                    <div class="description-block">
                      <h5 class="description-header"><img style="width:50px;" src="<?php echo burengoBaseUrl; ?>media/icons/moto-acuatica.png" alt="User Image"> </h5>
                      <span class="description-text"> <?php echo  burengo_jetski; ?> </span>
                    </div>
                  </div>
				  
				  <!------ Row 4-------->
				  <div class="col-sm-4 border-right border-top border-bottom carTypeTxt ch10" cttlabel="10">
                    <div class="description-block">
                      <h5 class="description-header"><img class="img-circle" style="width:50px;" src="<?php echo burengoBaseUrl; ?>media/icons/camion.png" alt="User Image"> </h5>
                      <span class="description-text"><?php echo  burengo_truck; ?></span>
                    </div>
                  </div>				  
				  
				  <div class="col-sm-4 border-right border-top border-bottom carTypeTxt ch11" cttlabel="11">
                    <div class="description-block">
                      <h5 class="description-header"><img style="width:50px;" src="<?php echo burengoBaseUrl; ?>media/icons/mezclador.png" alt="User Image"> </h5>
                      <span class="description-text"><?php echo  burengo_pesados; ?> </span>
                    </div>
                  </div>				  
				  
				  <div class="col-sm-4 border-top border-bottom carTypeTxt ch12" cttlabel="12">
                    <div class="description-block">
                      <h5 class="description-header"><img style="width:50px;" src="<?php echo burengoBaseUrl; ?>media/icons/generador.png" alt="User Image"> </h5>
                      <span class="description-text"> <?php echo  burengo_otros; ?> </span>
                    </div>
                  </div>
           </div>
				<div class="row pt-2">
                 
                  <div class="col-6">
                    <select id="pricefrom" class="form-control">
						<option value="0"> <?php echo burengo_precioMin; ?>  </option>
					</select>
                  </div>
                  <div class="col-6">
					<select id="priceto" class="form-control">
						<option value="9000000"> <?php echo burengo_precioMax; ?>   </option>
					</select>
                  </div>
                </div>				
				
				<div class="row pt-2">
                  <div class="col-6">
                    <select id="yearfrom" class="form-control">
						 <option value="0"> <?php echo burengo_yearfrom; ?> </option>
                    </select>
                  </div>
                  <div class="col-6">
                       <select id="yearto" class="form-control">
						 <option value="0"> <?php echo burengo_yearto; ?> </option>
                    </select>
                  </div>
                </div>
				 
               <div class="pt-2">
					<select id="fuel" class="form-control"> 
						<option value="0"> <?php echo burengo_fuel; ?> </option>
						<option value="1"> <?php echo burengo_gas; ?> </option>
						<option value="2"> <?php echo burengo_glp; ?> </option>
						<option value="3"> <?php echo burengo_diessel; ?> </option>						
					</select>
				</div> 
				
               <div class="pt-2">
					<select id="color" class="form-control"> 
							<option value="0"> <?php echo burengo_color; ?> </option> 
					</select>
				</div> 
               
			   <div class="pt-2">
			   <select id="transmision" class="form-control"> 
					<option value="0"> <?php echo burengo_transmition; ?> </option>
                    <option value="1"> <?php echo burengo_auto; ?> </option>
                    <option value="2"> <?php echo burengo_manual; ?> </option>
                    <option value="3"> <?php echo burengo_triptonic; ?> </option>
					</select>
				</div> 
               <div class="pt-2">
					<select id="place" class="form-control"> 
							<option value="0"> <?php echo burengo_place; ?> </option> 
					</select>
			   </div> 
              </div>
            </div> 
          </div>
          <!-- /.col-md-6 -->
<div class="col-lg-9">
<div class="p-0">
 <div class="card-body p-0">
	<div class="row plist">
 	</div>
   </div>
  </div>  
</div>
        </div>
      </div> 
    </div>
  </div> 

  <!-- Main Footer -->
  <footer class="main-footer">   Burengo &copy; 2020 - <?php echo burengo_copyright; ?>   </footer>
</div>
<!-- ./wrapper -->

<script src="<?php echo burengoBaseUrl; ?>plugins/jquery/jquery.min.js"></script>
<script src="<?php echo burengoBaseUrl; ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo burengoBaseUrl; ?>dist/js/adminlte.min.js"></script>
<script src="<?php echo burengoBaseUrl; ?>dist/js/demo.js"></script>
<script src="<?php echo burengoBaseUrl; ?>plugins/bootstrap-slider/bootstrap-slider.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$('#brands').load('<?php echo burengoBaseUrl; ?>ajax/bgo_select_car_brands.php');	
$('#yearfrom').load('<?php echo burengoBaseUrl; ?>ajax/bgo_select_active_years2.php');	
$('#yearto').load('<?php echo burengoBaseUrl; ?>ajax/bgo_select_active_years3.php');
$('#color').load('<?php echo burengoBaseUrl; ?>ajax/burengo_select_color.php');
$('#place').load('<?php echo burengoBaseUrl; ?>ajax/burengo_select_places.php');

$('#pricefrom').load('<?php echo burengoBaseUrl; ?>ajax/burengo_select_pricefrom.php');
$('#priceto').load('<?php echo burengoBaseUrl; ?>ajax/burengo_select_priceto.php');

SendData(1);
$("#ctp").hide();
document.getElementById('ctpBtn').innerHTML='<i class="fas fa-plus"></i>';

$('.plist').load("<?php echo burengoBaseUrl; ?>ajax/burengo_select_conditionals_acc.php?t0="+$('#getCat').val()+"&t1="+$('#string').val()+"&t2="
					+$('#pricefrom').val()+"&t3="+$('#priceto').val()+"&t4="
					+$('#yearfrom').val()+"&t5="+$('#yearto').val()+"&pageno=1");


switch($('#tpm2').val()){
 case '1': $('#btn1').addClass("bg-default"); $('#btn1').addClass("bg-warning"); break;
 case '2': $('#btn2').addClass("bg-default"); $('#btn2').addClass("bg-warning"); break;
}


});


$('#btn1').click(function(){ $('#btn2').removeClass("bg-warning"); $('#btn1').addClass("bg-warning"); location.href="?cat=1";  });
$('#btn2').click(function(){ $('#btn1').removeClass("bg-warning"); $('#btn2').addClass("bg-warning"); location.href="?cat=2"; });
 

$('#condition').change(function(){SendData(1);});
$('#brands').change(function(){SendData(1);});
$('#brands').change(function(){SendData(1);});
$('#models').change(function(){SendData(1);});
$('#fuel').change(function(){SendData(1);});
$('#color').change(function(){SendData(1);});
$('#transmision').change(function(){SendData(1);});
$('#place').change(function(){SendData(1);});
$('#yearfrom').change(function(){SendData(1);});
$('#yearto').change(function(){SendData(1);});
$('#pricefrom').change(function(){SendData(1);});
$('#priceto').change(function(){SendData(1);});
 
$('#brands').change(function(){$('#models').load('<?php echo burengoBaseUrl; ?>ajax/bgo_select_car_models.php?id='+$('#brands').val()); });
 
 
 
$('.plist').on("click", "div.itemSelection", function(){ 
	var id = $(this).attr('itemId');
//	location.href="itemview.php?dtcd="+id; 
}); 


$('#ctp').on("click","div.carTypeTxt", function(){
	var myVal = $(this).attr("cttlabel");
	var old = $('#oldSelected').val();
	if(old==0){ /* Do Nothing */ }else{  $('.ch'+old).removeClass('bg-warning'); }
	$(this).addClass('bg-warning');	
	$('#oldSelected').val(myVal); 	
	$('#tipocarro').val(myVal);
	 SendData(1);
});

$("#ctpBtn").click(function(){
  var op = $(this).attr('optp');
  
switch(op){
	case 'show': 
		$("#ctp").show();
		document.getElementById('ctpBtn').innerHTML='<i class="fas fa-minus"></i>';
		$("#ctpBtn").attr('optp','hide');
	break;
	case 'hide': 
	   $("#ctp").hide();
	   document.getElementById('ctpBtn').innerHTML='<i class="fas fa-plus"></i>';
	   $("#ctpBtn").attr('optp','show');	
	 break;
} 
});
 
function SendData($pageno){
var condition = $('#condition').val();
var brand = $('#brands').val();
var brand = $('#brands').val();
var model = $('#models').val();
var tipocarro = $('#tipocarro').val();
var fuel = $('#fuel').val();
var color = $('#color').val();
var transmision = $('#transmision').val();
var place = $('#place').val();
	
var Mydats = [['condicion',condition],
			  ['marca',brand],
			  ['modelo',model],
			  ['vtype',tipocarro],
			  ['fuel',fuel],
			  ['color',color],
			  ['transmision',transmision],
			  ['lugar',place]];		

$("#string").val(JSON.stringify(Mydats)); 
$('.plist').load("<?php echo burengoBaseUrl; ?>ajax/burengo_select_conditionals_acc.php?t0="+$('#getCat').val()+"&t1="+$('#string').val()+"&t2="+$('#pricefrom').val()+"&t3="+$('#priceto').val()+"&t4="+$('#yearfrom').val()+"&t5="+$('#yearto').val()+"&pageno="+$pageno+"");
}
 

$('.plist').on("click", "div.itemSelection", function(){ 
	var id = $(this).attr('itemId');
	var cat = $(this).attr('itemCat');
	
	switch(cat){
		case '1': location.href="../vehiculos.php?dtcd="+id; break;
		case '2': location.href="../inmuebles.php?dtcd="+id; break;
	} 
}); 



$('.plist').on("click","li.page-item",function(){
SendData($(this).attr('pg'));	 	
});



</script>
</body>
</html>
