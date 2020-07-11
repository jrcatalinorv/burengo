       <?php  
session_start(); 
date_default_timezone_set("America/Santo_Domingo");
$tp = 'do'; //$_REQUEST["tp"];
 
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
  <link rel="stylesheet" href="../../dist/css/adminlte.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark bg-navy">
    <ul class="navbar-nav">
      <li class="nav-item"><a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a></li>
    </ul>
    <ul class="navbar-nav ml-auto"></ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-danger elevation-4">
    <a href="" class="brand-link">
       <img src="../../dist/img/burengoLogo.png" alt="Campus CODEVI Logo" class="brand-image img-circle elevation-0" style="opacity: .8">  
      <span class="brand-text font-weight-light text-danger"> Burengo </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image"><img src="media/users/<?php echo $_SESSION['bgo_userImg']; ?>" class="img-circle elevation-2" alt="User Image"></div>
        <div class="info"><a href="#" class="d-block"> <?php echo $_SESSION['bgo_user']; ?> </a></div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item"><a href="dashboard.php" class="nav-link"><i class="nav-icon fas fa-tachometer-alt"></i><p> Dashboard </p></a></li>
          <li class="nav-item"><a href="members.php?tp=all" class="nav-link active"><i class="nav-icon fas fa-users"></i><p> Miembros </p></a></li>
          <li class="nav-item"><a href="publications.php?tp=all" class="nav-link"><i class="nav-icon fas fa-list-alt"></i><p> Publicaciones </p></a></li>
          <li class="nav-item"><a href="planes.php" class="nav-link"><i class="nav-icon fas fa-list"></i><p> Planes </p></a></li>
          <li class="nav-item"><a href="settings.php" class="nav-link"><i class="nav-icon fas fa-cogs"></i><p> Configuración  </p></a></li>
		  <li class="nav-header"></li>
		  <li class="nav-item"><a href="salir.php" class="nav-link"><i class="nav-icon fas fa-sign-out-alt text-danger"></i><p> Salir</p></a></li>
		</ul>
      </nav>
    </div>  
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
	  <div class="row pt-2">
	        <div class="col-md-12">
			<input id="getCountryCode" type="hidden" value="<?php echo $tp; ?>" />
			<input id="getplanCode" type="hidden" value="0" />
			<input id="getplaceCode" type="hidden" value="0" />
			<div class="btn-group">
                    <button type="button" class="btn btn-info btn-flat dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                      <span class="sr-only">Toggle Dropdown</span> <i class="fas fa-filter"></i> <span id="pname"> Todos los Planes </span>
                      <div class="dropdown-menu plList" role="menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-1px, 37px, 0px);">
                      <a class="dropdown-item"> Todos </a>
                    </div></button>
                  </div>
				  
			<!-- <div class="btn-group">
                   <button type="button" class="btn btn-success btn-flat dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                   <span class="sr-only">Toggle Dropdown</span> <i class="fas fa-filter"></i> <span id="tpm"> Todos los Países   </span>
                   <div class="dropdown-menu ctList" role="menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-1px, 37px, 0px);">
                      <a class="dropdown-item"> Todos </a>
                    </div></button>
                  </div> -->
				
				<div id="searchProvince" class="input-group mb-3 pt-2">
                  <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span></div>
                  <select id="ctProvince" class="form-control"> 
					<option value="0"> Todas las Provincias </option>
				  </select>
                </div>
				
            <div class="">
				<div class="card-body pb-0">
						<div class="row d-flex align-items-stretch userList">
						</div>
				</div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
	 </div>  
    </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer"><strong>Burengo &copy; 2020 </footer>
</div>
<!-- ./wrapper -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../dist/js/adminlte.min.js"></script>
<script src="../../plugins/toastr/toastr.min.js"></script>
<script type="text/javascript">
 $( document ).ready(function() {
   $('#searchProvince').hide();	 
   $('.userList').load("ajax/burengo_miembros.php?tp="+$('#getCountryCode').val()+"&cp="+$('#getplanCode').val()+"&vp="+$('#getplaceCode').val());   
   $('.ctList').load("ajax/burengo_countryList.php");
   $('.plList').load("ajax/burengo_planList.php");
   
   
   $('.ctList').on("click","a.ctSelect", function(){
	   var code = $(this).attr("ctid");
	   var name = $(this).attr("ctName");
	   
	   $('#tpm').text(name);
	   
	if(code=='all'){	
		$('#getCountryCode').val('code');    
		$('#getplaceCode').val(0);
		$('#searchProvince').hide();	
		$('.userList').load("ajax/burengo_miembros.php?tp="+code+"&cp="+$('#getplanCode').val()+"&vp="+$('#getplaceCode').val());
		 
	}else{
		$('#getCountryCode').val(code);
		$('#searchProvince').show();
		$('.userList').load("ajax/burengo_miembros.php?tp="+code+"&cp="+$('#getplanCode').val()+"&vp="+$('#getplaceCode').val());
		$('#ctProvince').load("ajax/burengo_placesCond.php?cty="+code);	
	 }
   });

   $('#searchProvince').change(function(){
		var code = $('#ctProvince').val();
		$('#getplaceCode').val(code);   
	    $('.userList').load("ajax/burengo_miembros.php?tp="+code+"&cp="+$('#getplanCode').val()+"&vp="+$('#getplaceCode').val());   
	});   
   
   $('.plList').on("click","a.plSelect", function(){
	   var code = $(this).attr("plid");
	   var nm = $(this).attr("pnm");
	   $('#pname').text(nm);	
	   $('#getplanCode').val(code);
	   $('.userList').load("ajax/burengo_miembros.php?tp="+$('#getCountryCode').val()+"&cp="+$('#getplanCode').val()+"&vp="+$('#getplaceCode').val());
   });
   
   $('.userList').on("click","div.usrProfile",function(){
	   var uid = $(this).attr("uid");
	   location.href="profile.php?uid="+uid;
   });
   
});
</script>
</body>
</html>
