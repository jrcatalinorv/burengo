<?php
require_once "modelos/conexion.php";
require_once "modelos/data.php";
$stmt = Conexion::conectar()->prepare("SELECT * FROM bgo_cpinfo WHERE cpcode = 'bgo'");
$stmt -> execute();
$results = $stmt -> fetch();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="icon" type="image/png" href="favicon.ico"/>
  <title> Burengo - Compra, renta o vende vehículos e inmuebles </title>
  <link rel="stylesheet" href="<?php echo burengoBaseUrl; ?>plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?php echo burengoBaseUrl; ?>dist/css/adminlte.css">
  <link rel="stylesheet" href="<?php echo burengoBaseUrl; ?>dist/css/burengo.css">  
  <link rel="stylesheet" href="<?php echo burengoBaseUrl; ?>plugins/toastr/toastr.min.css">
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
.closeModal {
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
.closeModal:hover {
    background: #fa3f6f;
}
</style>  
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">
 <nav class="main-header navbar navbar-expand-md navbar-dark bg-navy"> 
    <div class="container">
      <a href="<?php echo burengoBaseUrl; ?>" class="navbar-brand"><img src="<?php echo burengoBaseUrl; ?>dist/img/burengo.png" alt="Burengo Logo" class="brand-image   elevation-0" style="opacity: .8"></a>    
      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <ul class="navbar-nav"> </ul>
      </div>
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
         <li class="nav-item linkWeb"><a class="nav-link" href="<?php echo burengoBaseUrl; ?>"> <?php echo burengo_portada; ?> </a></li>
        <li class="nav-item"><a class="nav-link" href="acceder.php"><?php echo burengo_login; ?></a></li>
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
<div class="row">
          <div class="col-md-3">

           
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"> <?php echo burengo_about; ?> </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
				<p><strong><i class="fas fa-building mr-1"></i></strong> <span class="text-muted"> <?php echo $results["cpname"]; ?></span></p><hr>
				<p><strong><i class="fas fa-envelope mr-1"></i></strong> <span class="text-muted"><?php echo $results["cpemail"]; ?></span></p><hr>
				<p><strong><i class="fas fa-map-marker-alt mr-1"></i></strong> <span class="text-muted"><?php echo $results["cpaddr"]; ?></span></p><hr>
				<p><strong><i class="fas fa-phone mr-1"></i></strong> <span class="text-muted"><?php echo $results["cpphone"]; ?></span></p><hr> 
				<p> &nbsp; </p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
 
		  </div>
          <!-- /.col -->
          <div class="col-md-9 ">
            <div class="card card-info">
              <div class="card-header">
               <h3 class="card-title"> <i class="fas fa-envelope-open-text"></i> <?php echo burengo_sendMsg; ?> </h3>
              </div> 
              <div class="card-body">      
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label"> <?php echo burengo_name; ?> </label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName" placeholder="<?php echo burengo_name; ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label"><?php echo burengo_email; ?></label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail" placeholder="<?php echo burengo_email; ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label"><?php echo burengo_phone; ?></label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName2" placeholder="<?php echo burengo_phone; ?>" 
						  data-inputmask='"mask": "<?php echo burengo_phoneMask; ?>"' data-mask />
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label"> <?php echo burengo_comment; ?> </label>
                        <div class="col-sm-10">
                          <textarea class="form-control" id="inputExperience" placeholder=" "></textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button id="sendData" type="button" class="btn btn-success"> <i class="fab fa-telegram-plane"></i> 
						  <?php echo burengo_send; ?> </button>
                        </div>
                      </div>
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
     

	   </div>     

	 <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

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
<!-- ./wrapper -->
<script src="<?php echo burengoBaseUrl; ?>plugins/jquery/jquery.min.js"></script>
<script src="<?php echo burengoBaseUrl; ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo burengoBaseUrl; ?>dist/js/adminlte.min.js"></script>
<script src="<?php echo burengoBaseUrl; ?>plugins/moment/moment.min.js"></script>
<script src="<?php echo burengoBaseUrl; ?>plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<script type="text/javascript">
$('[data-mask]').inputmask();

$('#sendData').click(function(){
$.getJSON('<?php echo burengoBaseUrl; ?>/ajax/send_contact_email.php',{			  	 
	nm: $('#inputName').val(),	    	 
	ml: $('#inputEmail').val(),	    	 
	ph: $('#inputName2').val(),	    	 
	cm: $('#inputExperience').val()	    	 
},function(data){
	   switch(data['ok'])
		{
			case 0:  toastr.error('Err');   break;
			case 1:  window.location = "#messageSend"; break;		
		 }
	});
});

function isEmpty(str) {
    return (!str || 0 === str.length);
}
</script>
</body>
</html>
