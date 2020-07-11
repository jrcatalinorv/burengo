<?php  
session_start(); 
date_default_timezone_set("America/Santo_Domingo");

 if($_SESSION["bgoSesion"] != "ok"){
	header('location: salir.php'); 
 }


header('location: settings-currency.php?ct=do');

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
  <link rel="stylesheet" href="../../plugins/flag-icon-css-master/css/flag-icon.css" > 
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <nav class="main-header navbar navbar-expand navbar-dark bg-navy">
    <ul class="navbar-nav">
      <li class="nav-item"><a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a></li>
	  <li class="nav-item d-none d-sm-inline-block"><a href="settings.php" class="nav-link"> Menú Configuración </a></li>	  
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
      <li class="nav-item"><a href="settings.php" class="nav-link active"><i class="nav-icon fas fa-cogs"></i><p> Configuración </p></a></li>
	  <li class="nav-header"></li>
	  <li class="nav-item"><a href="salir.php" class="nav-link"><i class="nav-icon fas fa-sign-out-alt text-danger"></i><p> Salir</p></a></li> 
	</ul>
</nav>
</div> 
</aside>
<div class="content-wrapper">
<section class="content-header">
      <div class="container-fluid">
        <div class="row  ">
          <div class="col-sm-6">
            <h4 class="text-info"> <i class="fas fa-money-bill-wave   "></i> Monedas</h4>
          </div>
         
        </div>
      </div><!-- /.container-fluid -->
    </section>


 <div class="content">
  <div class="container-fluid">
  <div class="row">
  <div class="col-md-12">
  <div class="">
<div class="card-body pb-0 ">

<div class="row placesList">
 <div class="col-12 col-sm-6 col-md-3 chooseMe" ctid="ar"><div class="info-box">
 <span class="info-box-icon bg-white elevation-0"><i class="flag-icon flag-icon-ar elevation-1"></i></span>
 <div class="info-box-content"><span class="info-box-number pt-3"> Argentina </span></div>
 </div></div>

 <div class="col-12 col-sm-6 col-md-3 chooseMe" ctid="bo"><div class="info-box">
 <span class="info-box-icon bg-white elevation-0"><i class="flag-icon flag-icon-bo  elevation-1"></i></span>
 <div class="info-box-content"><span class="info-box-number pt-3"> Bolivia </span></div>
 </div></div>   

<!-- fix for small devices only -->
<div class="clearfix hidden-md-up"></div>

 <div class="col-12 col-sm-6 col-md-3 chooseMe" ctid="br"><div class="info-box">
 <span class="info-box-icon bg-white elevation-0"><i class="flag-icon flag-icon-br  elevation-1"></i></span>
 <div class="info-box-content"><span class="info-box-number pt-3"> Brasil </span></div>
 </div></div>

 <div class="col-12 col-sm-6 col-md-3 chooseMe" ctid="cl"><div class="info-box">
 <span class="info-box-icon bg-white elevation-0"><i class="flag-icon flag-icon-cl  elevation-1"></i></span>
 <div class="info-box-content"><span class="info-box-number pt-3"> Chile </span></div>
 </div></div>   

<!-- fix for small devices only -->
<div class="clearfix hidden-md-up"></div>
  
  <div class="col-12 col-sm-6 col-md-3 chooseMe" ctid="co"><div class="info-box">
 <span class="info-box-icon bg-white elevation-0"><i class="flag-icon flag-icon-co  elevation-1"></i></span>
 <div class="info-box-content"><span class="info-box-number pt-3"> Colombia  </span></div>
 </div></div>

 <div class="col-12 col-sm-6 col-md-3 chooseMe" ctid="cr"><div class="info-box">
 <span class="info-box-icon bg-white elevation-0"><i class="flag-icon flag-icon-cr  elevation-1"></i></span>
 <div class="info-box-content"><span class="info-box-number pt-3"> Costa Rica  </span></div>
 </div></div>   

<!-- fix for small devices only -->
<div class="clearfix hidden-md-up"></div> 
 
 <div class="col-12 col-sm-6 col-md-3 chooseMe" ctid="cu"><div class="info-box">
 <span class="info-box-icon bg-white elevation-0"><i class="flag-icon flag-icon-cu  elevation-1"></i></span>
 <div class="info-box-content"><span class="info-box-number pt-3"> Cuba </span></div>
 </div></div>

 <div class="col-12 col-sm-6 col-md-3 chooseMe" ctid="do"><div class="info-box">
 <span class="info-box-icon bg-white elevation-0"><i class="flag-icon flag-icon-do  elevation-1"></i></span>
 <div class="info-box-content"><span class="info-box-number pt-3"> Dominicana </span></div>
 </div></div>   

<!-- fix for small devices only -->
<div class="clearfix hidden-md-up"></div>


 <div class="col-12 col-sm-6 col-md-3 chooseMe" ctid="ec"><div class="info-box">
 <span class="info-box-icon bg-white elevation-0"><i class="flag-icon flag-icon-ec  elevation-1"></i></span>
 <div class="info-box-content"><span class="info-box-number pt-3"> Ecuador </span></div>
 </div></div>

 <div class="col-12 col-sm-6 col-md-3 chooseMe" ctid="gt"><div class="info-box">
 <span class="info-box-icon bg-white elevation-0"><i class="flag-icon flag-icon-gt  elevation-1"></i></span>
 <div class="info-box-content"><span class="info-box-number pt-3"> Guatemala </span></div>
 </div></div>   

<!-- fix for small devices only -->
<div class="clearfix hidden-md-up"></div>


 <div class="col-12 col-sm-6 col-md-3 chooseMe" ctid="hn"><div class="info-box">
 <span class="info-box-icon bg-white elevation-0"><i class="flag-icon flag-icon-hn  elevation-1"></i></span>
 <div class="info-box-content"><span class="info-box-number pt-3"> Honduras </span></div>
 </div></div>

 <div class="col-12 col-sm-6 col-md-3 chooseMe" ctid="mx"><div class="info-box">
 <span class="info-box-icon bg-white elevation-0"><i class="flag-icon flag-icon-mx  elevation-1"></i></span>
 <div class="info-box-content"><span class="info-box-number pt-3"> México </span></div>
 </div></div>   

<!-- fix for small devices only -->
<div class="clearfix hidden-md-up"></div>


 <div class="col-12 col-sm-6 col-md-3 chooseMe" ctid="ni"><div class="info-box">
 <span class="info-box-icon bg-white elevation-0"><i class="flag-icon flag-icon-ni elevation-1"></i></span>
 <div class="info-box-content"><span class="info-box-number pt-3"> Nicaragua </span></div>
 </div></div>

 <div class="col-12 col-sm-6 col-md-3 chooseMe" ctid="pa"><div class="info-box">
 <span class="info-box-icon bg-white elevation-0"><i class="flag-icon flag-icon-pa elevation-1"></i></span>
 <div class="info-box-content"><span class="info-box-number pt-3"> Panamá  </span></div>
 </div></div>   

<!-- fix for small devices only -->
<div class="clearfix hidden-md-up"></div>

 <div class="col-12 col-sm-6 col-md-3 chooseMe" ctid="py"><div class="info-box">
 <span class="info-box-icon bg-white elevation-0"><i class="flag-icon flag-icon-py elevation-1"></i></span>
 <div class="info-box-content"><span class="info-box-number pt-3"> Paraguay </span></div>
 </div></div>

 <div class="col-12 col-sm-6 col-md-3 chooseMe" ctid="pe"><div class="info-box">
 <span class="info-box-icon bg-white elevation-0"><i class="flag-icon flag-icon-pe elevation-1"></i></span>
 <div class="info-box-content"><span class="info-box-number pt-3"> Perú </span></div>
 </div></div>   

<!-- fix for small devices only -->
<div class="clearfix hidden-md-up"></div>


 <div class="col-12 col-sm-6 col-md-3 chooseMe" ctid="pr"><div class="info-box">
 <span class="info-box-icon bg-white elevation-0"><i class="flag-icon flag-icon-pr elevation-1"></i></span>
 <div class="info-box-content"><span class="info-box-number pt-3"> Puerto Rico </span></div>
 </div></div>

 <div class="col-12 col-sm-6 col-md-3 chooseMe" ctid="sv"><div class="info-box">
 <span class="info-box-icon bg-white elevation-0"><i class="flag-icon flag-icon-sv elevation-1"></i></span>
 <div class="info-box-content"><span class="info-box-number pt-3"> Salvador </span></div>
 </div></div>   

<!-- fix for small devices only -->
<div class="clearfix hidden-md-up"></div>

 <div class="col-12 col-sm-6 col-md-3 chooseMe" ctid="uy"><div class="info-box">
 <span class="info-box-icon bg-white elevation-0"><i class="flag-icon flag-icon-uy elevation-1"></i></span>
 <div class="info-box-content"><span class="info-box-number pt-3"> Uruguay </span></div>
 </div></div>

 <div class="col-12 col-sm-6 col-md-3 chooseMe" ctid="ve"><div class="info-box">
 <span class="info-box-icon bg-white elevation-0"><i class="flag-icon flag-icon-ve elevation-1"></i></span>
 <div class="info-box-content"><span class="info-box-number pt-3"> Venezuela </span></div>
 </div></div>   

<!-- fix for small devices only -->
<div class="clearfix hidden-md-up"></div>


 <!-- /.col -->
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
<!-- Main Footer -->
<footer class="main-footer"><strong>Burengo &copy; 2020 </footer>
</div>
<!-- ./wrapper -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../dist/js/adminlte.min.js"></script>
<script src="../../plugins/toastr/toastr.min.js"></script>
<script type="text/javascript">
$('.placesList').on("click","div.chooseMe",function(){
 var cd = $(this).attr("ctid");
 location.href="settings-currency.php?ct="+cd;		
});
</script>
</body>
</html>
