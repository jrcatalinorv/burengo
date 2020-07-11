<?php 
session_start();
date_default_timezone_set("America/Santo_Domingo");
require_once "../modelos/conexion.php";
require_once "../modelos/data.php";
 $date = date('Y-m-d'); 
 $plan = $_REQUEST["p"];
 $uid = $_REQUEST["acc"];
 
/* Colocar datos del plan */
$stmt2 = Conexion::conectar()->prepare("SELECT * FROM bgo_planes WHERE planid = ".$plan."");
$stmt2 -> execute();
if($results = $stmt2 -> fetch()){
$nombre_plan   = $results['planname'];
$precio_plan   = number_format($results['planprice'],2).' '.$results['plancurrency'];
$duracion_plan = $results['planduration'];
$max_fotos = $results['planmaxf'];
$max_post = $results['planmaxp'];

$_SESSION['bgo_maxP'] = $max_post;
$_SESSION['bgo_planName'] = $nombre_plan;
$_SESSION['bgo_perfil'] = $plan;


$up_expdate =  date('Y-m-d', strtotime($date. ' + 30 days'));

/* Actualizar los datos */
$stmt0 = Conexion::conectar()->prepare("UPDATE bgo_user_plan SET up_planid = ".$plan." , up_maxp =".$max_post." , up_maxf =".$max_fotos." , up_expdate = '".$up_expdate."' WHERE up_uid = '".$uid."'");
$stmt0 -> execute();

/* Insertar datos en la tabla usuarios */ 
$stmt = Conexion::conectar()->prepare(" UPDATE bgo_users SET profile = ".$plan.", status = 1 WHERE uid = '".$uid."'");
$stmt -> execute();
}else{
	print_r($stmt2->errorInfo());
	print_r($stmt0->errorInfo());
	print_r($stmt->errorInfo());
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="icon" type="image/png" href="favicon.ico"/>
  <title>Burengo</title>
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
 <nav class="main-header navbar navbar-expand-md navbar-dark bg-navy"> 
    <div class="container">
      <a href="index.php" class="navbar-brand"> <img src="../../dist/img/burengo.png" alt="Burengo Logo" class="brand-image   elevation-0" style="opacity: .8"> </a>
      <div class="collapse navbar-collapse order-3" id="navbarCollapse"><ul class="navbar-nav"> </ul></div>
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto"> </ul>
    </div>
  </nav>
  <!-- /.navbar -->

  <div class="content-wrapper">
 <section class="content pt-3">
      <div class="container-fluid">
        <div class="row">
		<input id="getUserCode" type="hidden" value="<?php echo $uid; ?>"/>
          <div class="col-12">
<?php 		  
if(intval($results['planprice'])){
		  
echo '<div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fas fa-check"></i> '.burengo_paymentAlert.' </h5>        
                </div>'; 
}	?> 
			
<div class="card">
        <div class="card-header">
          <h3 class="card-title"><?php echo burengo_plantype; ?>: <?php echo $nombre_plan; ?> </h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-12 col-sm-3">
                  <div class="info-box bg-light">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted"> <?php echo burengo_price; ?> </span>
                      <span class="info-box-number text-center text-muted mb-0"> <?php echo $precio_plan; ?> </span>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-3">
                  <div class="info-box bg-light">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted"> <?php echo burengo_duration;?> </span>
                      <span class="info-box-number text-center text-muted mb-0"> <?php echo $duracion_plan; ?> <?php echo burengo_days; ?> </span>
                    </div>
                  </div>
                </div>                
				
				<div class="col-12 col-sm-3">
                  <div class="info-box bg-light">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted"> <?php echo burengo_maxp; ?> </span>
                      <span class="info-box-number text-center text-muted mb-0"> <?php if($max_post==0){ echo "Ilimitadas"; } else{ echo $max_post;  }; ?> </span>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-3">
                  <div class="info-box bg-light">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted"> <?php echo burengo_maxf; ?> </span>
                      <span class="info-box-number text-center text-muted mb-0"> <?php echo $max_fotos; ?> <span>
                    </span></span></div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <h5> <?php echo burengo_policy1; ?> </h5>
                    <div class="">
                      <div class=" " style="height:250px;   overflow-y: auto; overflow-x: hidden;">
					   <p class="justify-content-between"><?php echo burengo_contract2; ?></p>

						</div>
<div class="text-center mt-5 mb-3">
 <a href="inicio.php" class="btn btn-sm btn-primary"> <i class="fas fa-list-alt"></i> <?php echo burengo_mainPage; ?> </a>
 <a href="profile.php" type="button"  class="btn btn-sm btn-success"> <i class="fas fa-user"></i> <?php echo burengo_MyAccountBtn; ?> </a>
 </div>
</div>
 </div>
              </div>
            </div>
   
          </div>
        </div>
        <!-- /.card-body -->
      </div>

           
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  </div>
  
 
  
<footer class="main-footer"> Burengo &copy; 2020 - <?php echo burengo_copyright; ?> </footer>

 

</div>
<script src="../../plugins/jquery/jquery.min.js"></script>
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../dist/js/adminlte.min.js"></script>
<script src="../../plugins/toastr/toastr.min.js"></script>
<script type="text/javascript">
 

</script>
</body>
</html>
