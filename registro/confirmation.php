<?php 
date_default_timezone_set("America/Santo_Domingo");
require_once "../modelos/conexion.php";
require_once "../modelos/data.php";
require "../plugins/PHPMailer/src/Exception.php";
require "../plugins/PHPMailer/src/PHPMailer.php";
require "../plugins/PHPMailer/src/SMTP.php";

// def name spaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


$date = date('Y-m-d');
$plan = $_REQUEST["p"];
$uid = $_REQUEST["acc"];

/* Insertar datos en la tabla factura */ 
$stmt0 = Conexion::conectar()->prepare(" UPDATE bgo_users SET profile = ".$plan."  WHERE uid = '".$uid."'");
$stmt0 -> execute();	

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
$up_status = 1;
$up_planxtra = 0;

/* Insertar Datos en la tabla Plan User */
$stmt = Conexion::conectar()->prepare("INSERT INTO bgo_user_plan(up_uid,up_planid,up_planxtra,up_maxp,up_maxf,up_expdate,up_status)
VALUES(:up_uid,:up_planid,:up_planxtra,:up_maxp,:up_maxf,:up_expdate,:up_status)");

$stmt->bindParam(":up_uid",$uid, PDO::PARAM_STR);
$stmt->bindParam(":up_planid",$plan, PDO::PARAM_INT);
$stmt->bindParam(":up_planxtra",$up_planxtra, PDO::PARAM_INT);
$stmt->bindParam(":up_maxp",$max_post, PDO::PARAM_INT);
$stmt->bindParam(":up_maxf",$max_fotos, PDO::PARAM_INT);
$stmt->bindParam(":up_expdate",$up_expdate, PDO::PARAM_STR);
$stmt->bindParam(":up_status",$up_status, PDO::PARAM_INT);

$stmt->execute();

//--------------------------------------
//Enviar el email al usuario 
//--------------------------------------
/* Buscar el usuario si existe */

$stmt20 = Conexion::conectar()->prepare("SELECT * FROM bgo_users WHERE uid ='".$uid."' AND bgo_country ='".COUNTRY_CODE."'");
$stmt20 -> execute();
$results20 = $stmt20 -> fetch();


	

$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$first = substr(str_shuffle($permitted_chars), 0, 75);
$second = $uid;
$third = substr(str_shuffle($permitted_chars), 0, 35);
$email = $results20["email"];


$stmt44 = Conexion::conectar()->prepare("SELECT * FROM bgo_mail_server WHERE site_code = 'bgo'");
$stmt44 -> execute(); 
$rslt = $stmt44 -> fetch(); 
 
// create instance phpmailer
$mail = new PHPMailer();

$mail->isSMTP();

$mail->Host = $rslt["mail_host"];

$mail->Port = $rslt["mail_port"];
$mail->SMTPAuth = "true";
$mail->Username = $rslt["mail_user"];
$mail->Password = $rslt["mail_pass"]; 
$mail->SMTPSecure = "tls";
$mail->CharSet = "UTF-8";
$mail->isHTML(true);
$mail->setFrom("info@burengo.com");
$mail->Subject = burengo_mailSubject2;
$mail-> Body =  "<center>"
				."\n\n"
				."<h3> ".burengo_mailboddy2." </h3>"
				."https://burengo.com/".COUNTRY_CODE."/confirmation/account.php?ft=".$first."&th=".$third."&sd=".$second.""
				."</center>\n"
				."\n"
				."\n";
$mail->addAddress($email);
$mail->Send(); 
$mail->smtpClose();   
//--------------------------------------
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
  <link rel="icon" type="image/png" href="../favicon.ico"/>
  <title>Burengo</title>
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
 <nav class="main-header navbar navbar-expand-md navbar-dark bg-navy"> 
    <div class="container">
      <a href="<?php echo burengoBaseUrl; ?>" class="navbar-brand"> <img src="../dist/img/burengo.png" alt="Burengo Logo" class="brand-image   elevation-0" style="opacity: .8"> </a>
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
}	
?> 	

<div class="alert alert-success alert-dismissible">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <h5><i class="icon fas fa-envelope"></i> Para finalizar la activación de su cuenta se ha enviado un email a su cuenta de correo. </h5>
</div> 

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
                      <span class="info-box-number text-center text-muted mb-0"> <?php if($max_post==99999){ echo "Ilimitadas"; }else{ echo $max_post; } ?> </span>
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
  <a href="<?php echo burengoBaseUrl; ?>" class="btn btn-sm btn-primary"> <i class="fas fa-list-alt"></i> <?php echo burengo_mainPage; ?> </a>
<!--  <button type="button" id="goToAcc"  class="btn btn-sm btn-success"> <i class="fas fa-user"></i> <?php echo burengo_accMyAccount; ?> </button>
-->
</div>
</div>
 </div>
 </div>
 </div>
 </div>
 </div>
      </div>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  </div>
<footer class="main-footer"> Burengo &copy; 2020 - <?php echo burengo_copyright; ?> </footer>
</div>
<script src="../plugins/jquery/jquery.min.js"></script>
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../dist/js/adminlte.min.js"></script>
<script src="../plugins/toastr/toastr.min.js"></script>
<script type="text/javascript">
 $('#goToAcc').click(function(){
 $.getJSON('../ajax/burengo_first_login.php',{			  	 
	uid: $('#getUserCode').val() 
	},function(data){
	   switch(data['ok'])
		{
			case 0: toastr.error('No fue posible iniciar Session'); break;
			case 1: window.location = "../access/"+data['url']; break;		
		 }
	});
 });

</script>
</body>
</html>
