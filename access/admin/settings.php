<?php  
session_start(); 
date_default_timezone_set("America/Santo_Domingo");

 if($_SESSION["bgoSesion"] != "ok"){
	header('location: salir.php'); 
 }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
        <link rel="icon" type="image/png" href="../../favicon.ico"/>
  <title>Burengo</title>
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="../../dist/css/adminlte.css">
  <link rel="stylesheet" href="../../plugins/toastr/toastr.min.css"> 
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <nav class="main-header navbar navbar-expand navbar-dark bg-navy">
    <ul class="navbar-nav">
      <li class="nav-item"><a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a></li>  
    </ul>
    <ul class="navbar-nav ml-auto"></ul>
  </nav>

<aside class="main-sidebar sidebar-dark-danger elevation-4">
<a href="" class="brand-link">
  <img src="../../dist/img/burengoLogo.png" alt="Campus CODEVI Logo" class="brand-image img-circle elevation-0" style="opacity: .8">  
  <span class="brand-text font-weight-light text-danger"> Burengo </span>
</a>

<div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image"><img src="media/users/<?php echo $_SESSION['bgo_userImg']; ?>" class="img-circle elevation-2" alt="User Image"></div>
        <div class="info"><a href="#" class="d-block"> <?php echo $_SESSION['bgo_user']; ?> </a></div>
      </div>
<nav class="mt-2">
	<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <li class="nav-item"><a href="dashboard.php" class="nav-link"><i class="nav-icon fas fa-tachometer-alt"></i><p> Dashboard </p></a></li>
      <li class="nav-item"><a href="members.php?tp=all" class="nav-link"><i class="nav-icon fas fa-users"></i><p> Miembros </p></a></li>
      <li class="nav-item"><a href="publications.php?tp=all" class="nav-link"><i class="nav-icon fas fa-list-alt"></i><p> Publicaciones </p></a></li>
      <li class="nav-item"><a href="planes.php" class="nav-link"><i class="nav-icon fas fa-list"></i><p> Planes </p></a></li>
      <li class="nav-item"><a href="settings.php" class="nav-link active"><i class="nav-icon fas fa-cogs"></i><p> Configuracion</p></a></li>
	  <li class="nav-header"></li>
	  <li class="nav-item"><a href="salir.php" class="nav-link"><i class="nav-icon fas fa-sign-out-alt text-danger"></i><p> Salir</p></a></li> 
	</ul>
</nav>
</div> 
</aside>
<div class="content-wrapper">
 <div class="content">
  <div class="container-fluid">
  <div class="row pt-2">
  <div class="col-md-12">
  <div class="">
<div class="card-body pb-0 ">
		
<div class="row d-flex align-items-stretch userList">
<div class="col-md-3">
  <div id="mv_marcas" class="card">
    <div class="card-body box-profile">
    <div class="text-center"><i class="fas fa-car fa-3x text-info"></i></div><h3 class="profile-username text-center"> Marcas </h3></div>
  </div>      
</div>

<div id="mv_modelos" class="col-md-3">
   <div class="card">
     <div class="card-body box-profile">
     <div class="text-center"><i class="fas fa-car fa-3x text-info"></i></div><h3 class="profile-username text-center"> Modelos </h3></div>
   </div>      
</div>

<div id="mv_years" class="col-md-3">
  <div class="card">
     <div class="card-body box-profile">
     <div class="text-center"><i class="fas fa-calendar-alt fa-3x text-info"></i></div><h3 class="profile-username text-center"> Años </h3></div>
  </div>      
</div>
		  
<div id="mv_fuel" class="col-md-3">
  <div class="card">
    <div class="card-body box-profile"> 
    <div class="text-center"><i class="fas fa-gas-pump fa-3x text-info"></i></div><h3 class="profile-username text-center"> Combustible </h3></div>
  </div>      
</div>	 
		  
<div id="mv_trans" class="col-md-3">  
   <div class="card">
     <div class="card-body box-profile"> 
     <div class="text-center"><i class="fas fa-oil-can fa-3x text-info"></i></div><h3 class="profile-username text-center"> Transmisión </h3></div>
   </div>      
</div>	

<div id="mv_tracc" class="col-md-3">  
   <div class="card">
     <div class="card-body box-profile"> 
     <div class="text-center"><i class="fas fa-cogs fa-3x text-info"></i></div><h3 class="profile-username text-center"> Tracción  </h3></div>
   </div>      
</div>		   

<div id="mv_places" class="col-md-3">
   <div class="card">
      <div class="card-body box-profile">
      <div class="text-center"><i class="fas fa-map-marked-alt fa-3x text-info"></i></div><h3 class="profile-username text-center"> Provincias </h3></div>
   </div>      
</div>
 
<div id="mv_colors" class="col-md-3">
   <div class="card">
     <div class="card-body box-profile">
     <div class="text-center"><i class="fas fa-palette fa-3x text-info"></i></div><h3 class="profile-username text-center"> Colores </h3></div>
   </div>      
</div>

<div id="business-info" class="col-md-3">
  <div class="card">
     <div class="card-body box-profile">
     <div class="text-center"><i class="fas fa-building fa-3x text-info"></i></div><h3 class="profile-username text-center"> Info Empresa </h3></div>
  </div>      
</div>


<div class="col-md-3">
  <div id="settings-mail-server" class="card">
    <div class="card-body box-profile">
    <div class="text-center"><i class="fas fa-envelope fa-3x text-info"></i></div><h3 class="profile-username text-center"> Servidor de Correo </h3></div>
  </div>      
</div>

<div id="settings-paypal" class="col-md-3">
   <div class="card">
     <div class="card-body box-profile">
     <div class="text-center"><i class="fab fa-paypal fa-3x text-info"></i></div><h3 class="profile-username text-center"> Paypal </h3></div>
   </div>      
</div>


<div id="settings-currency" class="col-md-3">
   <div class="card">
     <div class="card-body box-profile">
     <div class="text-center">
	 <i class="fas fa-money-bill-wave fa-3x text-info"></i>
	  </div><h3 class="profile-username  text-center"> Monedas </h3></div>
   </div>      
</div>

 
<div class="col-md-3" data-toggle="modal" data-target="#modal-pass">
   <div class="card">
     <div class="card-body box-profile">
     <div class="text-center"><i class="fas fa-lock fa-3x text-info"></i></div><h3 class="profile-username text-center"> Cambiar Contraseña </h3></div>
   </div>      
</div>

 
</div>
</div>
</div>
</div>
</div>  
</div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->


   <div class="modal fade" id="modal-pass">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"> Cambiar contraseña  </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body"> 
				<div class="form-group"><input type="password" class="form-control" id="password0" placeholder="Contraseña Actual"></div>
				<div class="form-group"><input type="password" class="form-control" id="password1" placeholder="Nueva contraseña"></div>
				<div class="form-group"><input type="password" class="form-control" id="password2" placeholder="Confirmar contraseña"></div> 
            </div>
			 <div class="modal-footer justify-content-between">
              <button id="closeMeBtn" type="button" class="btn btn-danger" data-dismiss="modal"> Cerrar </button>
              <button id="changePass" type="button" class="btn btn-success"> Aceptar  </button>
            </div>
          </div>
        </div>
      </div>
   <!-- /.modal -->

<!-- Main Footer -->
<footer class="main-footer"><strong>Burengo &copy; 2020 </footer>
</div>
<!-- ./wrapper -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../dist/js/adminlte.min.js"></script>
<script src="../../plugins/toastr/toastr.min.js"></script>
<script type="text/javascript">
$('#mv_marcas').click(function(){location.href="settings-marcas.php";});
$('#mv_modelos').click(function(){location.href="settings-modelos.php";});
$('#mv_fuel').click(function(){location.href="settings-fuel.php";});
$('#mv_trans').click(function(){location.href="settings-transmition.php";});
$('#mv_tracc').click(function(){location.href="settings-traccion.php";});
$('#mv_places').click(function(){location.href="settings-places-menu.php";});
$('#mv_colors').click(function(){location.href="settings-colors.php";});
$('#mv_years').click(function(){location.href="settings-active-years.php";});
$('#business-info').click(function(){location.href="business-info.php";});
$('#settings-mail-server').click(function(){location.href="settings-mail-server.php";});
$('#settings-paypal').click(function(){location.href="settings-paypal.php";});
$('#settings-currency').click(function(){location.href="settings-currency-menu.php";});



function isEmpty(str) {
    return (!str || 0 === str.length);
}

function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}

$('#changePass').click(function(){
if( !isEmpty($("#password0").val())){ 
  if( !isEmpty($("#password1").val())){
	if( !isEmpty($("#password2").val())){
	var newpass  = $("#password1").val();
	var conpass  = $("#password2").val(); 
	var pr = newpass.localeCompare(conpass);
	
	if(pr==0){
			$.getJSON('ajax/burengo_update_account_pass.php',{
		 pass: $("#password0").val(),
		 npass: newpass
  },function(data){
		switch(data['ok']){
			case 0: toastr.error('ERROR! No se pudo almacenar los datos: '+ data['err']); break;
			case 1: toastr.success('Los Datos fueron actualizados de forma correcta.'); $('#closeMeBtn').click(); break;
			case 2: $('#password0').val(""); $('#password0').focus(); toastr.error('La clave actual no es correcta! '); break;
		}
	});
		
	}else{
		$('#password1').val(""); 
		$('#password2').val(""); 
		$('#password1').focus(); 
		toastr.error('Las Claves no coinciden');
	}
}else{ $('#password2').focus();	toastr.error('Las Claves no coinciden'); }
}else{ $('#password1').focus();	toastr.error('Las Claves no coinciden'); }
}else{ $('#password0').focus(); toastr.error('La clave actual no es correcta! '); }

 
});


</script>
</body>
</html>
