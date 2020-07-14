<?php 
session_start();
date_default_timezone_set("America/Santo_Domingo");
require_once "modelos/data.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="icon" type="image/png" href="favicon.ico"/>
  <title> Burengo - Compra, renta o vende vehículos e inmuebles </title>
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
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
      <a href="<?php echo burengoBaseUrl; ?>" class="navbar-brand"><img src="dist/img/burengo.png" alt="Burengo Logo" class="brand-image   elevation-0" style="opacity: .8"></a>    
      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <ul class="navbar-nav"> </ul>
      </div>

     <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
         <li class="nav-item"><a class="nav-link" href="<?php echo burengoBaseUrl; ?>"> <?php echo burengo_portada; ?> </a></li>
        <li class="nav-item"><a class="nav-link" href="contacto.php"> <?php echo burengo_contact; ?>  </a></li>
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
	 <div class="login-box">
  <div class="login-logo">
     
  </div>
  <!-- /.login-logo -->
<div class="card">
<div class="card-body login-card-body">
<p class=""> <h3> <?php echo burengo_lostPass; ?></h3> </p>
<div action="#"><br/>
<div class="input-group mb-3 pt-3">
<input id="email" type="email" class="form-control" placeholder="<?php echo burengo_mailtext; ?>" />
<div class="input-group-append">
<div class="input-group-text">
<span class="fas fa-envelope"></span>
</div>
</div>
</div>
 
        <div class="row pt-3">
          <div class="col-12">
            <button id="send" type="button" class="btn btn-success btn-block"> <?php echo burengo_lostPass2; ?> </button>
          </div>
        </div>
      </div>

      <div class="social-auth-links text-center mb-3">
        <a href="<?php echo burengoBaseUrl; ?>" class="btn btn-block btn-info"> <?php echo burengo_cancel; ?> </a>         
		</div>  
    </div>
  </div>
</div>
</center>
</div> 
</div>
</div>
  
<div id="messageSend" class="modalDialog">
<div>
<h2> </h2>
<center><i class="fas fa-envelope fa-4x text-info"></i>
<p class="text-info" style="font-size:2em;"> <?php echo burengo_emailSendAlert; ?>  </p>
<p class="text-primary" style="font-size:1.4em;"> <a href="<?php echo burengoBaseUrl; ?>"> <?php echo burengo_back2Home; ?></a></p>
</center>
</div>
</div>  
 <div class="modal fade" id="modal-sample">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"> <?php echo burengo_policy2; ?></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
			<div class="row" style="height:300px;   overflow-y: auto; overflow-x: hidden;">
              <p class="justify-content-between"><?php echo burengo_contract1; ?></p>
			  </div>
 
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default float-right" data-dismiss="modal"> <?php echo burengo_close; ?> </button>
              
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
<div class="modal fade" id="modal-sample2">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"> <?php echo burengo_policy1; ?> </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
			 <div class="row" style="height:300px;   overflow-y: auto; overflow-x: hidden;">
               <p class="justify-content-between"> <?php echo burengo_contract2; ?> </p>
		     </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default float-right" data-dismiss="modal"> <?php echo burengo_close; ?></button>
              
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

 <section class="main-footer bg-navy" >   </section> 
<?php include_once "burengo-footer.php"; ?>

 
</div>
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/toastr/toastr.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/demo.js"></script>
<script type="text/javascript">
var input = document.getElementById("email");
input.addEventListener("keyup", function(event) {
  if (event.keyCode === 13) {
   event.preventDefault();
   document.getElementById("send").click();
  }
});


$('#send').click(function(){
$.getJSON('ajax/send_recover_email.php',{			  	 
	email: $('#email').val()    	 	 
	},function(data){
	   switch(data['ok'])
		{
			case 0: toastr.error('Digite una cuenta de correo válida');  $('#email').val("");  break;
			case 1: location.href="#messageSend"; break;		
		 }
	});				 
}); 
 
</script>
</body>
</html>