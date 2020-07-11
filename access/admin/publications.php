<?php  
session_start(); 
date_default_timezone_set("America/Santo_Domingo");
require_once "../modelos/conexion.php";

$tp = $_REQUEST["tp"];

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
  <link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
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
          <li class="nav-item"><a href="publications.php?tp=all" class="nav-link active"><i class="nav-icon fas fa-list-alt"></i><p> Publicaciones </p></a></li>
          <li class="nav-item"><a href="planes.php" class="nav-link "><i class="nav-icon fas fa-list"></i><p> Planes </p></a></li>
          <li class="nav-item"><a href="settings.php" class="nav-link"><i class="nav-icon fas fa-cogs"></i><p> Configuración </p></a></li>
		  <li class="nav-header"></li>
		  <li class="nav-item"><a href="salir.php" class="nav-link"><i class="nav-icon fas fa-sign-out-alt text-danger"></i><p> Salir</p></a></li>	  
		</ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div> <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
	  <div class="row pt-2">
	        <div class="col-md-12">
			<input id="getCountryCode" type="hidden" value="<?php echo $tp; ?>" />			
			<input id="getType" type="hidden" value="<?php echo $tp; ?>" type="text" />
			<div class="btn-group">
                    <button type="button" class="btn btn-info btn-flat"> <i class="fas fa-filter"></i> <span id="tyMM"> Todos </span> </button>
                    <button type="button" class="btn btn-info btn-flat dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                      <span class="sr-only">Toggle Dropdown</span>
                      <div class="dropdown-menu ctType" role="menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-1px, 37px, 0px);">
                        <a class="dropdown-item cpSelect" tdi="all" tnm="Todos"> Todos </a>
                        <a class="dropdown-item cpSelect" tdi="1" tnm="Vehículos"> Vehículos </a>
                        <a class="dropdown-item cpSelect" tdi="2" tnm="Inmnuebles"> Inmnuebles </a>
                    </div></button>
                  </div>
				  
				<!-- <div class="btn-group">
                   <button type="button" class="btn btn-success btn-flat dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                   <span class="sr-only">Toggle Dropdown</span> <i class="fas fa-filter"></i> <span id="tpm"> Todos los Paises  </span>
                   <div class="dropdown-menu ctList" role="menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-1px, 37px, 0px);">
                      <a class="dropdown-item"> Todos </a>
                    </div></button>
                  </div> -->

			<!--	<div id="searchProvince" class="input-group mb-3 pt-2">
                  <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span></div>
                  <select id="ctProvince" class="form-control"> 
					<option value="0"> Todas las Provincias </option>
				  </select>
                </div>	 -->			  
			
<div class="">
  <div class="card-body pb-0 ">
		<div class="row plist">  </div>
  </div>
</div>


    </div>
	 </div>  
    </div> 
    </div>
  </div>
  <!-- /.content-wrapper -->
<div id="modalTriggerDelete" data-toggle="modal" data-target="#modal-delete"></div>
<div class="modal fade" id="modal-delete">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"> Confirmación  </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
				<input id="modalPostID" class="form-control" type="hidden" />
				<input id="modalPostCountry" class="form-control" type="hidden" />
				<h3 class="text-info text-center"> ¿Está seguro que desea borrar esta publicación? </h3>
			
            </div>
			 <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-danger" data-dismiss="modal"> Cancelar </button>
              <button id="proccedDelete" type="button" class="btn btn-success"> Aceptar   </button>
            </div>
			
          </div>
        </div>
</div>

<footer class="main-footer"><strong>Burengo &copy; 2020 </footer>
</div>
<!-- ./wrapper -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../dist/js/adminlte.min.js"></script>
<script src="../../plugins/toastr/toastr.min.js"></script>
<script type="text/javascript">
$('.plist').load("ajax/burengo_publications.php?tp="+$('#getType').val());
//$('.ctList').load("ajax/burengo_countryList.php");
$('#searchProvince').hide();

$('.ctType').on("click","a.cpSelect",function(){
	var code = $(this).attr("tdi");
	var name = $(this).attr("tnm");
	$('#getType').val(code);
	$('#tyMM').text(name);
	$('.plist').load("ajax/burengo_publications.php?tp="+code);	
});

$('.ctList').on("click","a.ctSelect", function(){
	   var code = $(this).attr("ctid");
	   var name = $(this).attr("ctName");
	   
	   $('#tpm').text(name);
	   
	if(code=='all'){	
		$('#getCountryCode').val(code);    
		$('#getplaceCode').val(0);
		$('#searchProvince').hide();	
//		$('.userList').load("ajax/burengo_miembros.php?tp="+code+"&cp="+$('#getplanCode').val()+"&vp="+$('#getplaceCode').val());
		 
	}else{
		$('#getCountryCode').val(code);
		$('#searchProvince').show();
		//$('.userList').load("ajax/burengo_miembros.php?tp="+code+"&cp="+$('#getplanCode').val()+"&vp="+$('#getplaceCode').val());
		$('#ctProvince').load("ajax/burengo_placesCond.php?cty="+code);	
	 }
   });




$('.plist').on("click", "button.changeStatus", function(){
	var id = $(this).attr('itemId');
	var st  = $(this).attr('ns');
$.getJSON('ajax/burengo_update_stp.php',{
		pid: id,
	 status: st
	},function(data){
		switch(data['ok']){
			case 0: toastr.error('ERROR! No se guardaron los cambios los datos: '+ data['err']); break;
			case 1: location.href=""; break;
		}
	});	
});

$('.plist').on("click","button.deletePost", function(){
  var id= $(this).attr("itemId");
  var ct= $(this).attr("countryCode");
  $('#modalPostID').val(id);
  $('#modalPostCountry').val(ct);
  $('#modalTriggerDelete').click();
});

$('#proccedDelete').click(function(){
 
$.getJSON('ajax/burengo_delete_post.php',{
		pid: $('#modalPostID').val(),
		ctc: $('#modalPostCountry').val()
	},function(data){
		switch(data['ok']){
			case 0: toastr.error('ERROR! No se guardaron los cambios los datos: '+ data['err']); break;
			case 1: location.href=""; break;
		}
	});		
	
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
