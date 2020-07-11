<?php 
session_start();
date_default_timezone_set("America/Santo_Domingo");
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
	 <div class="login-box">
  <div class="login-logo">
     
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
	<input id="getUrsValue" type="hidden" readonly value="<?php echo $second; ?>" />
      <p class=""> <h3> <?php echo burengo_lostPass2; ?></h3> </p>

      <div action="#"><br/>
        <div class="input-group mb-3 pt-3">
          <input id="pass1" type="password" class="form-control" placeholder="<?php echo burengo_newPass; ?>" />
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>        
		<div class="input-group mb-3 pt-1">
          <input id="pass2" type="password" class="form-control" placeholder="<?php echo burengo_conPass; ?>" />
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row pt-3">
          <div class="col-12">
            <button id="getPassBack" type="button" class="btn btn-success btn-block"> <?php echo burengo_lostPass3; ?> </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
 </center>
	 </div> 
    </div>
  </div>
  
<!--modals-->
  <div id="messageSend" class="modalDialog">
      <div>
         <h2> </h2>
        <center><i class="fas fa-envelope fa-4x text-info"></i>
		<p class="text-info" style="font-size:2em;">  <?php echo burengo_stOKpassModify; ?>   </p>
		<p class="text-primary" style="font-size:1.4em;"> <a href="../../<?php echo COUNTRY_CODE; ?>"> <?php echo burengo_coverReturn; ?> </a>  </p>
		</center>
		</div>
</div>  
  
<footer class="main-footer"> Burengo &copy; 2020 - <?php echo burengo_copyright; ?>   </footer>
</div>
<script src="../../plugins/jquery/jquery.min.js"></script>
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../plugins/toastr/toastr.min.js"></script>
<script src="../../dist/js/adminlte.min.js"></script>
<script src="../../dist/js/demo.js"></script>
<script type="text/javascript">
var input = document.getElementById("pass2");
input.addEventListener("keyup", function(event) {
  if (event.keyCode === 13) {
   event.preventDefault();
   document.getElementById("getPassBack").click();
  }
});


$('#getPassBack').click(function(){
 if( !isEmpty($("#pass1").val())){ 
 if( !isEmpty($("#pass2").val())){ 
		var newpass  = $("#pass1").val();
		var conpass  = $("#pass2").val(); 
		var pr = newpass.localeCompare(conpass);
		if(pr==0){
		
		$.getJSON('../ajax/burengo_update_recover_password.php',{			  	 
	uid: $('#getUrsValue').val(),
	pw1: $('#pass1').val()	
	},function(data){
	   switch(data['ok'])
		{
			case 0: toastr.error('No se modificaron los cambios'); break;
			case 1: location.href = "#messageSend"; break;		
		 }
	});
		
		
		}else{
		$('#pass1').val(""); 
		$('#pass2').val(""); 
		$('#pass1').focus(); 
		toastr.error('Las Claves no coinciden');
	}
 }else{ $('#pass1').focus(); toastr.error('Las Claves no coinciden! '); }
 }else{ $('#pass1').focus(); toastr.error('Las Claves no coinciden! '); }
 		 
}); 
 
 function isEmpty(str) {
    return (!str || 0 === str.length);
}
</script>
</body>
</html>