<?php 
session_start();
date_default_timezone_set("America/Santo_Domingo");
require_once "../modelos/conexion.php";
require_once "../modelos/data.php";
$first  = $_REQUEST['ft'];
$second = $_REQUEST['sd']; 
$third  = $_REQUEST['th'];

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
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
<style>
* {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
.modalDialog {
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    background: rgba(0, 0, 0, 0.8);
    z-index: 99999;
    opacity:0;
    -webkit-transition: opacity 100ms ease-in;
    -moz-transition: opacity 100ms ease-in;
    transition: opacity 100ms ease-in;
    pointer-events: none;
}
.modalDialog:target {
    opacity:1;
    pointer-events: auto;
}
.modalDialog > div {
    max-width: 800px;
    width: 90%;
    position: relative;
    margin: 10% auto;
    padding: 20px;
    border-radius: 3px;
    background: #fff;
}
.close {
    font-family: Arial, Helvetica, sans-serif;
    background: #f26d7d;
    color: #fff;
    line-height: 25px;
    position: absolute;
    right: -12px;
    text-align: center;
    top: -10px;
    width: 34px;
    height: 34px;
    text-decoration: none;
    font-weight: bold;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    border-radius: 50%;
    -moz-box-shadow: 1px 1px 3px #000;
    -webkit-box-shadow: 1px 1px 3px #000;
    box-shadow: 1px 1px 3px #000;
    padding-top: 5px;
}
.close:hover {
    background: #fa3f6f;
}
</style> 
</head>
<body class="hold-transition layout-top-nav layout-navbar-fixed">
<div class="wrapper">
 <nav class="main-header navbar navbar-expand-md navbar-dark bg-navy"> 
    <div class="container">
      <a href="../../<?php echo COUNTRY_CODE; ?>" class="navbar-brand"><img src="../../dist/img/burengo.png" alt="Burengo Logo" class="brand-image   elevation-0" style="opacity: .8"></a>    
      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <ul class="navbar-nav"> </ul>
      </div>

     <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
         <li class="nav-item"><a class="nav-link" href="../../<?php echo COUNTRY_CODE; ?>"> <?php echo burengo_portada; ?> </a></li>
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->

 
  <div class="content-wrapper">
 
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
        </div> 
      </div> 
    </div>
 

    <!-- Main content -->
    <div class="content">
      <div class="container">
	 <center>
	 <div class="col-md-6">
  <div class="login-logo">
     
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body">
 
  <center>
  <?php 
  $stmt0 = Conexion::conectar()->prepare(" UPDATE bgo_users SET status = 1 WHERE uid = '".$second."'");
  $stmt0 -> execute();	 
  ?>
  <h3 class="text-info p-3"> <i class="fas fa-user fa-2x"></i> <br/><br/> <?php echo burengo_accOK; ?> </h3>
  <p class="pt-2"> <a href="../acceder.php"> <?php echo burengo_login; ?></a> </p>
  <p> <a class="nav-link" href="../../<?php echo COUNTRY_CODE; ?>"> <?php echo burengo_portada; ?> </a> </p>
  </center>

      
 
      </div>
    </div>
  </div>
</div>
 </center>
	 </div> 
    </div>
  </div>
  
 
<footer class="main-footer"> Burengo &copy; 2020 - <?php echo burengo_copyright; ?>   </footer>
</div>
<script src="../../plugins/jquery/jquery.min.js"></script>
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../plugins/toastr/toastr.min.js"></script>
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>