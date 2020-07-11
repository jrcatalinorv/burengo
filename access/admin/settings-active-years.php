<?php  
session_start(); 
date_default_timezone_set("America/Santo_Domingo");
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
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark bg-navy">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
	  <li class="nav-item d-none d-sm-inline-block"><a href="settings.php" class="nav-link"> Menú Configuración  </a></li>
      
    </ul>
  <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
 	<!-- <li class="nav-item dropdown" data-toggle="modal" data-target="#catmodal"><a class="nav-link"  href="#"><i class="fas fa-plus-circle"></i>  Modelos </a></li>
	 -->
    </ul>
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
          <li class="nav-item"><a href="members.php?tp=all" class="nav-link"><i class="nav-icon fas fa-users"></i><p> Miembros </p></a></li>
          <li class="nav-item"><a href="publications.php?tp=all" class="nav-link"><i class="nav-icon fas fa-list-alt"></i><p> Publicaciones </p></a></li>
          <li class="nav-item"><a href="planes.php" class="nav-link"><i class="nav-icon fas fa-list"></i><p> Planes </p></a></li>
          <li class="nav-item"><a href="settings.php" class="nav-link active"><i class="nav-icon fas fa-cogs"></i><p> Configuración </p></a></li>
		  <li class="nav-header"></li>
		  <li class="nav-item"><a href="salir.php" class="nav-link"><i class="nav-icon fas fa-sign-out-alt text-danger"></i><p> Salir</p></a></li>
		</ul>
      </nav>
    </div> <!-- /.sidebar -->
  </aside>

  <div class="content-wrapper">
    <div class="content">
      <div class="container-fluid">
	  <div class="row pt-2">
	        <div class="col-md-6">
   <div class="card">
              <div class="card-header">
                <h3 class="card-title"> <i class="fas fa-car"></i> Modelos </h3>
              </div>

              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Año</th>
                      <th>Estatus</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody id="categoryBody">                  
			
                  </tbody>
                </table>
              </div>
            </div>
   
          </div>
 
	 </div>  
    </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper --> 

  <!-- Main Footer -->
  <footer class="main-footer"><strong>Burengo &copy; 2020 </footer>
</div>
<!-- ./wrapper -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../dist/js/adminlte.min.js"></script>
<script src="../../plugins/toastr/toastr.min.js"></script>
<script type="text/javascript">
$( document ).ready(function() {
$('#categoryBody').load('ajax/burengo_years_lista.php'); 	   
$('#modalMarcaEdit').load('ajax/bgo_select_car_brands.php'); 	   
});

$('#categoryBody').on("click","button.changeStatus",function(){
  var id = $(this).attr("nxid");
  var st = $(this).attr("nxt");
$.getJSON('ajax/burengo_update_stYears.php',{
		pid: id,
	 status: st
	},function(data){
		switch(data['ok']){
			case 0: toastr.error('ERROR! No se guardaron los cambios los datos: '+ data['err']); break;
			case 1: location.href=""; break;
		}
	});	
});


/* Guardar un nuevo record */
$('#modalSaveCategory').click(function(){
	$.getJSON('ajax/burengo_insert_modelo.php',{
		modelo: $('#modalNewCategory').val(),
		marca: $('#modalMarca').val()
	},function(data){
		switch(data['ok']){
			case 0: toastr.error('ERROR! No se pudo almacenar los datos: '+ data['err']); break;
			case 1: 
				toastr.success('El modelo fue añadido con exito!'); 
				$('#categoryBody').load('ajax/burengo_modelos_lista.php');
				document.getElementById('closeModalBtn').click();
				$('#modalNewCategory').val("");	
			break;
		}
	}); 
});

$('#categoryBody').on("click","button.changeStatus",function(){
  var id = $(this).attr("catId");
  var st = $(this).attr("nextCatState");
$.getJSON('ajax/burengo_update_modeloSt.php',{
		pid: id,
	 status: st
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
