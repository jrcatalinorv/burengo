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
      <li class="nav-item"><a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a></li>
	  <li class="nav-item d-none d-sm-inline-block"><a href="settings.php" class="nav-link"> Menú Configuración </a></li>
    </ul>
  <!-- Right navbar links -->
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
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image"><img src="media/users/<?php echo $_SESSION['bgo_userImg']; ?>" class="img-circle elevation-2" alt="User Image"></div>
        <div class="info"><a href="#" class="d-block"> <?php echo $_SESSION['bgo_user']; ?> </a></div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item"><a href="dashboard.php" class="nav-link"><i class="nav-icon fas fa-tachometer-alt"></i><p> Dashboard </p></a></li>
          <li class="nav-item"><a href="members.php" class="nav-link"><i class="nav-icon fas fa-users"></i><p> Miembros </p></a></li>
          <li class="nav-item"><a href="all-publications.php" class="nav-link"><i class="nav-icon fas fa-list-alt"></i><p> Publicaciones </p></a></li>
          <li class="nav-item"><a href="planes.php" class="nav-link"><i class="nav-icon fas fa-list"></i><p> Planes </p></a></li>
          <li class="nav-item"><a href="settings.php" class="nav-link active"><i class="nav-icon fas fa-cogs"></i><p> Configuracion</p></a></li>
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
	 <div class="col-md-4">
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
				<h3 class="profile-username text-center"> Colores Externos </h3>
				<p class="text-muted text-center"> Vehiculos </p>
				<br>
				<button type="button" class="btn btn-block bg-gradient-info  " data-toggle="modal" data-target="#color"> <i class="fas fa-plus"></i> Agregar Color </button>
                <ul class="list-group list-group-unbordered mb-3 ext-colors">
				</ul>
              </div>
            </div>      
          </div>

	 <div class="col-md-4">
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
				<h3 class="profile-username text-center"> Colores Internos </h3>
				<p class="text-muted text-center"> Vehiculos </p>
				<br>
				<button type="button" class="btn btn-block bg-gradient-info  " data-toggle="modal" data-target="#color-int"> <i class="fas fa-plus"></i> Agregar Color </button>
                <ul class="list-group list-group-unbordered mb-3 int-colors">
                 
                             
				 
                </ul>

                
              </div>
            </div>      
          </div>
 
	<!-- <div class="col-md-4">
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
				<h3 class="profile-username text-center"> Colores </h3>
				<p class="text-muted text-center"> Inmuebles  </p>
				<br>
				<button type="button" class="btn btn-block bg-gradient-info  " data-toggle="modal" data-target="#color-in"> <i class="fas fa-plus"></i> Agregar Color </button>
                <ul class="list-group list-group-unbordered mb-3 snd-colors">
              
                </ul>
              </div>
            </div>      
          </div> -->
   
 
 
	 </div>  
    </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 <!----  Modal Categorias ------->
      <div class="modal fade" id="color">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"> Agregar Color Exterior  </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
          <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-car"></i></span>
                  </div>
                  <input id="modalNewCategory" type="text" class="form-control" maxlength="25" placeholder="Digite el nombre del Color">
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button id="closeModalBtn" type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fas fa-times"></i> Cancelar </button>
              <button id="modalSaveColor1" type="button" class="btn btn-success"> <i class="fas fa-save"></i> Guardar </button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->	  
 
 
 <!----  Modal Categorias ------->
      <div class="modal fade" id="color-int">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"> Agregar Color Interior  </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
          <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-car"></i></span>
                  </div>
                  <input id="txtColor2" type="text" class="form-control" maxlength="25" placeholder="Digite el nombre del Color">
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button id="closeModalBtn2" type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fas fa-times"></i> Cancelar </button>
              <button id="modalSaveColor2" type="button" class="btn btn-success"> <i class="fas fa-save"></i> Guardar </button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->	  
 
<div id="triggerEditExtmodal" data-toggle="modal" data-target="#editExtmodal"></div> 
<div id="triggerEditIntmodal" data-toggle="modal" data-target="#editIntmodal"></div> 
 
<div class="modal fade" id="editExtmodal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"> Editar Color Exterior </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
          <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-car"></i></span>
                  </div>
                  <input id="editModalExtId"  type="hidden" class="form-control" readonly />
                  <input id="editModalExtColor" type="text" class="form-control" />
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button id="closeModalEditExtBtn" type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fas fa-times"></i> Cancelar </button>
              <button id="modalSaveEditExtColor" type="button" class="btn btn-success"> <i class="fas fa-save"></i> Guardar </button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->	
  

<div class="modal fade" id="editIntmodal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"> Editar Color Interior </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
          <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-car"></i></span>
                  </div>
                  <input id="editModalIntId"  type="hidden" class="form-control" readonly />
                  <input id="editModalIntColor" type="text" class="form-control" />
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button id="closeModalEditIntBtn" type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fas fa-times"></i> Cancelar </button>
              <button id="modalSaveEditIntColor" type="button" class="btn btn-success"> <i class="fas fa-save"></i> Guardar </button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
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
 $( document ).ready(function() {
$('.int-colors').load('ajax/burengo_int_colors_lista.php'); 	   
$('.ext-colors').load('ajax/burengo_ext_colors_lista.php'); 	    	   
});


/* Guardar un nuevo record */
$('#modalSaveColor1').click(function(){
	$.getJSON('ajax/burengo_insert_color1.php',{
		color: $('#modalNewCategory').val()
	},function(data){
		switch(data['ok']){
			case 0: toastr.error('ERROR! No se pudo almacenar los datos: '+ data['err']); break;
			case 1: 
				toastr.success('El Color fue añadido con exito!'); 
				$('.ext-colors').load('ajax/burengo_ext_colors_lista.php'); 	    	   
				document.getElementById('closeModalBtn').click();
				$('#modalNewCategory').val("");	
			break;
		}
	}); 
});


$('.ext-colors').on("click","a.editarCategoria",function(){
  $('#editModalExtId').val($(this).attr("catId"));
  $('#editModalExtColor').val($(this).attr("catStr"));
  $('#triggerEditExtmodal').click();
});


$('.int-colors').on("click","a.changeStatus",function(){
 var id = $(this).attr("nxid");
  var st = $(this).attr("nxt");
$.getJSON('ajax/burengo_update_stcolor2.php',{
		pid: id,
	 status: st
	},function(data){
		switch(data['ok']){
			case 0: toastr.error('ERROR! No se guardaron los cambios los datos: '+ data['err']); break;
			case 1: $('.int-colors').load('ajax/burengo_int_colors_lista.php');   	 break;
		}
	});	  
  
});


$('.ext-colors').on("click","a.changeStatus",function(){
 var id = $(this).attr("nxid");
  var st = $(this).attr("nxt");
$.getJSON('ajax/burengo_update_stcolor1.php',{
		pid: id,
	 status: st
	},function(data){
		switch(data['ok']){
			case 0: toastr.error('ERROR! No se guardaron los cambios los datos: '+ data['err']); break;
			case 1: $('.ext-colors').load('ajax/burengo_ext_colors_lista.php');   	 break;
		}
	});	  
  
});



$('#modalSaveEditExtColor').click(function(){
$.getJSON('ajax/burengo_update_color1.php',{
	 pid: $('#editModalExtId').val(),
	 str: $('#editModalExtColor').val()
	},function(data){
		switch(data['ok']){
			case 0: toastr.error('ERROR! No se guardaron los cambios los datos: '+ data['err']); break;
			case 1:  
			    $('.ext-colors').load('ajax/burengo_ext_colors_lista.php'); 
				$('#closeModalEditExtBtn').click();
				toastr.success('El Color fue actualizado con exito!'); 
			break;	
		}
	});	
});


 
/* Guardar un nuevo record */
$('#modalSaveColor2').click(function(){
	$.getJSON('ajax/burengo_insert_color2.php',{
		color: $('#txtColor2').val()
	},function(data){
		switch(data['ok']){
			case 0: toastr.error('ERROR! No se pudo almacenar los datos: '+ data['err']); break;
			case 1: 
				toastr.success('El Color fue añadido con exito!'); 
				$('.int-colors').load('ajax/burengo_int_colors_lista.php');  
				document.getElementById('closeModalBtn2').click();
				$('#txtColor2').val("");	
			break;
		}
	}); 
}); 


$('.int-colors').on("click","a.editarCategoria",function(){
  $('#editModalIntId').val($(this).attr("catId"));
  $('#editModalIntColor').val($(this).attr("catStr"));
  $('#triggerEditIntmodal').click();
});



$('#modalSaveEditIntColor').click(function(){
$.getJSON('ajax/burengo_update_color2.php',{
	 pid: $('#editModalIntId').val(),
	 str: $('#editModalIntColor').val()
	},function(data){
		switch(data['ok']){
			case 0: toastr.error('ERROR! No se guardaron los cambios los datos: '+ data['err']); break;
			case 1:  
		   		$('.int-colors').load('ajax/burengo_int_colors_lista.php');  
				$('#closeModalEditIntBtn').click();
				toastr.success('El Color fue actualizado con exito!'); 
			break;	
		}
	});	
});



</script>
</body>
</html>
