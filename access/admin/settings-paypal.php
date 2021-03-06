<?php  
session_start(); 
date_default_timezone_set("America/Santo_Domingo");
require_once "../modelos/conexion.php";

 if($_SESSION["bgoSesion"] != "ok"){
	header('location: salir.php'); 
 }


$stmt2 = Conexion::conectar()->prepare("SELECT * FROM bgo_cpinfo WHERE cpcode = 'bgo'");
$stmt2 -> execute(); 
$results = $stmt2 -> fetch(); 

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
	  <li class="nav-item d-none d-sm-inline-block"><a href="settings.php" class="nav-link"> Menú Configuración  </a></li>  
	  
    </ul>
    <ul class="navbar-nav ml-auto">
	
	
	</ul>
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
      <li class="nav-item"><a href="settings.php" class="nav-link active"><i class="nav-icon fas fa-cogs"></i><p> Configuración </p></a></li>
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
<div class="col-md-8">

<div class="card">
  <div class="card-header">
  <h3 class="card-title"> <i class="fab fa-paypal"></i> Datos de Pago </h3>
  </div>
  <!-- form start -->
  <div class="card-body">
   <div class="form-group">
      <label for="phone">  ID de Cuenta  </label>
         <input type="text" class="form-control" id="ppcode" value="<?php echo $results["paypal_code"]; ?>" />
   </div>
   </div>
   <!-- /.card-body -->
   <div class="card-footer">
     <button id="save-changes" type="button" class="btn btn-success float-right"> <i class="fas fa-save"></i> Guardar Cambios </button>
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
<script src="../../plugins/moment/moment.min.js"></script>
<script src="../../plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<script type="text/javascript">
$('[data-mask]').inputmask();

$('#save-changes').click(function(){
$.getJSON('ajax/burengo_update_ppcode.php',{
		url: $('#ppcode').val()
	},function(data){
		switch(data['ok']){
			case 0: toastr.error('ERROR! No se guardaron los cambios los datos: '+ data['err']); break;
			case 1: toastr.success('¡Los datos fueron actualizados con éxito!'); break;
		}
	});	
});

</script>
</body>
</html>
