       <?php  
session_start(); 
date_default_timezone_set("America/Santo_Domingo");
require_once "../modelos/conexion.php";

$uid = $_REQUEST["uid"];

 if($_SESSION["bgoSesion"] != "ok"){
	header('location: salir.php'); 
 }

 
$fsDt = date("Y-m-d", strtotime("first day of this month")); 
$lsDt = date("Y-m-d", strtotime("last day of this month")); 
 
/* Total Publicaciones */
$stmt2 = Conexion::conectar()->prepare(" SELECT COUNT(bgo_code) as totalp 
FROM bgo_posts WHERE bgo_status = 1 and bgo_usercode = '".$uid."'");
$stmt2 -> execute();
$results = $stmt2 -> fetch();
$total_post = $results['totalp'];

/* Vehiculos */
$stmt2 = Conexion::conectar()->prepare(" SELECT COUNT(bgo_code) as totalpv FROM 
bgo_posts WHERE bgo_status = 1 and bgo_usercode = '".$uid."' and bgo_subcat = 1");
$stmt2 -> execute();
$results = $stmt2 -> fetch();
$total_postv = number_format($results['totalpv']);
 
/* Inmnuebles */ 
$stmt2 = Conexion::conectar()->prepare(" SELECT COUNT(bgo_code) as totalpin FROM 
bgo_posts WHERE bgo_status = 1 and bgo_usercode = '".$uid."' and bgo_subcat = 2");
$stmt2 -> execute();
$results = $stmt2 -> fetch();
$total_postin = number_format($results['totalpin']);

/* Visitas del mes */
$stmt4 = Conexion::conectar()->prepare("SELECT COUNT(vstid) as visits FROM bgo_visits WHERE vstdate  
BETWEEN '".$fsDt."' AND '".$lsDt."' AND vst_usercode = '".$uid."'");
$stmt4 -> execute();
$rest4 = $stmt4 -> fetch(); 


$stmt5 = Conexion::conectar()->prepare("SELECT u.*, p.*, pl.* FROM bgo_users u 
INNER JOIN bgo_places p  ON u.provinvia = p.pcid 
INNER JOIN bgo_planes pl ON u.profile = pl.planid AND u.uid = '".$uid."'");
$stmt5 -> execute();
$rest5 = $stmt5 -> fetch(); 

$stmt6 = Conexion::conectar()->prepare("SELECT * FROM bgo_user_plan WHERE up_uid = '".$rest5["uid"]."'"); 
$stmt6 -> execute();
$rest6 = $stmt6 -> fetch();


$pu_rest = intval($rest6["up_maxp"]) - intval($total_post) ;  

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
	  	  <li class="nav-item d-none d-sm-inline-block"><a href="members.php?tp=all" class="nav-link">Menú Miembros </a></li> 
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
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="media/users/<?php echo $_SESSION['bgo_userImg']; ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"> <?php echo $_SESSION['bgo_user']; ?> </a>
		 
        </div>
      </div>

      <!-- Sidebar Menu -->
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
      <!-- /.sidebar-menu -->
    </div> <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
	  <div class="row pt-2">
          <div class="col-md-3">
			<input id="getUserCodeId" type="hidden" value="<?php echo $rest5["uid"]; ?>" />
		 
            <div class="card">
              <div class="card-body box-profile">
                <div class="text-center"><img class="profile-user-img img-fluid img-circle" src="../../<?php echo $rest5["bgo_country"]; ?>/media/users/<?php echo $rest5["img"]; ?>" alt="User profile picture"></div>
                <h3 class="profile-username text-center"> <?php echo $rest5["name"]; ?>  </h3>
                <p class="text-muted text-center">  
				<?php 
					if($rest5["profile"] > 1){
						if($rest5["profile"] == 4){
							 echo '<i class="fas fa-trophy fa-2x text-success"></i>'; 
						  }else{
							  echo '<i class="fas fa-trophy fa-2x text-primary"></i>';
							}
						}else{
							echo '<i class="far fa-flag fa-2x text-primary"></i>'; 
						}
					?>
				</p>
                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item"><b>Total Publicaciones </b> <a class="float-right"> <?php echo $total_post; ?></a></li>
				  <li class="list-group-item"><b>Vehículos  </b> <a class="float-right"><?php echo $total_postv; ?></a></li>                     
				  <li class="list-group-item"><b>Inmnuebles </b> <a class="float-right"><?php echo $total_postin; ?></a></li>                  
				  <li class="list-group-item"><b> Visitas del mes </b> <a class="float-right"> <?php echo number_format($rest4['visits']); ?>  </a></li>
				  <li class="list-group-item"><b> Plan </b> <a class="float-right"> <?php echo $rest5["planname"]; ?>  </a></li>
				  <li class="list-group-item"><b> Fecha de Expiración </b> <a class="float-right"> <?php echo $rest6["up_expdate"]; ?>  </a></li>
                </ul>
			   </div>
            </div>
          
	  
		  </div>	 
		   <div class="col-md-8">
		   		<div class="card">
        <div class="card-body" style="display: block;">
          <div class="row">
            <div class="col-12 col-md-12 col-lg-8 order-1 order-md-1">
              <h5 class=""> Datos Personales </h5>
              <div class="text-muted">
                <p class="text-sm">Usuario: <b class="d-block"> <?php echo $rest5["user"]; ?></b></p>
                <p class="text-sm">Nombre Completo:<b class="d-block"> <?php echo $rest5["name"]; ?></b></p>
                <p class="text-sm">Cédula<b class="d-block"> <?php echo $rest5["ced"]; ?></b></p>                
				<p class="text-sm">Teléfono Principal <b class="d-block"> <?php echo $rest5["phone"]; ?></b></p>                
				<p class="text-sm">Dirección
                  <b class="d-block"> <?php echo $rest5["addr"]; ?> </b>
                  <b class="d-block"> <?php echo $rest5["pcstr"].', Republica Dominicana '; ?> </b>
                </p>				
				<p class="text-sm">Email<b class="d-block"> <?php echo $rest5["email"]; ?></b></p>
				<p class="text-sm"><i class="fab fa-lg fa-whatsapp"></i> Whatsapp <b class="d-block"><?php echo $rest5["bgo_whatsapp"]; ?></b></p>
				<p class="text-sm"><i class="fab fa-lg fa-instagram"></i> Instagram <b class="d-block"><?php echo $rest5["bgo_instagram"]; ?></b></p>
				<p class="text-sm"><i class="fab fa-lg fa-facebook"></i> Facebook <b class="d-block"><?php echo $rest5["bgo_facebook"]; ?></b></p>
              </div>
          </div>
		
	 
			
          </div>
        </div>
        <!-- /.card-body -->
		
		
		<div class="card-footer">
			<?php if($rest5["status"]==1){
				echo '<button id="activate" type="button" class="btn btn-warning btn-sm" nst="0"> <i class="fas fa-power-off"></i> Inactivar Usuario  </button>';
			}else{
				echo '<button id="activate" type="button" class="btn btn-success btn-sm"  nst="1"> <i class="fas fa-power-off"></i> Activar Usuario  </button>';
			}?>
			
		<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-chplan"> <i class="fas fa-trophy"></i> Cambiar Plan </button>	
		
		
		
		<!-- 
		<button  type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-delete" > <i class="fas fa-trash-alt"></i> Borrar Usuario </button>
-->		
		</div>
      </div> 
	</div>	
	 </div>  
    </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
      <div class="modal fade" id="modal-delete">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"> </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
               <h4 class="text-info text-center"> ¿Está seguro que desea eliminar esta cuenta? </h4>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal"> Cerrar </button>
              <button id="btnDelete" type="button" class="btn btn-danger"> <i class="fas fa-trash" ></i> Aceptar </button>
            </div>
          </div>
         </div>
      </div>
      
	  
	        <div class="modal fade" id="modal-chplan">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"> </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
               <h5 class="text-info text-center"> Seleccione el plan que desea agregar al usuario   </h5>
			   <hr/><center>
			   <?php 
				$stmt7 = Conexion::conectar()->prepare("SELECT * FROM bgo_planes WHERE planstatus = 1 AND plantypo = 1"); 
				$stmt7 -> execute();
				while($rest7 = $stmt7 -> fetch()){
					
					if($rest5["profile"]==$rest7["planid"]){
						echo ' <a style="width:150px; " class="btn btn-app">  <i class="fas fa-trophy text-success"></i>  '.$rest7["planname"].'  </a>';
					}else{
						echo ' <a style="width:150px; " class="btn btn-app choseplanid" pnid="'.$rest7["planid"].'">  <i class="fas fa-trophy text-primary"></i>  '.$rest7["planname"].'  </a>';
					}
					
				}
			   
			   ?>
			  </center>
			   <hr/>
			   
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
$('.plist').on("click", "button.changeStatus", function(){
	var id = $(this).attr('itemId');
	var st  = $(this).attr('ns');
$.getJSON('../ajax/burengo_update_stp.php',{
		pid: id,
	 status: st
	},function(data){
		switch(data['ok']){
			case 0: toastr.error('ERROR! No se guardaron los cambios los datos: '+ data['err']); break;
			case 1: location.href=""; break;
		}
	});	
});


$('#activate').click(function(){
 var nmt = $('#activate').attr("nst");

$.getJSON('ajax/burengo_update_usrStatus.php',{
		 user : $('#getUserCodeId').val(),
		 state: nmt
  },function(data){
		switch(data['ok']){
			case 0: toastr.error('ERROR! No se pudo almacenar los datos: '+ data['err']); break;
			case 1: location.href=""; break;
		}
	});
});

$('#btnDelete').click(function(){
	$.getJSON('ajax/burengo_delete_usr.php',{
		 user : $('#getUserCodeId').val()
  },function(data){
		switch(data['ok']){
			case 0: toastr.error('ERROR! No se pudo almacenar los datos: '+ data['err']); break;
			case 1: location.href="members.php?tp=all"; break;
		}
	});	
	
});

$('.choseplanid').click(function(){
	var idPlan = $(this).attr('pnid');
$.getJSON('ajax/burengo_update_planuser.php',{
		 user  : $('#getUserCodeId').val(),
		 planid: idPlan 
  },function(data){
		switch(data['ok']){
			case 0: toastr.error('ERROR! No se pudo realizar los cambios: '+ data['err']); break;
			case 1: location.href=""; break;
		}
	});	
	
	
 
	
});

</script>
</body>
</html>
