<?php 
require_once "../modelos/data.php";
date_default_timezone_set("America/Santo_Domingo");
$code = rand(1000000,9999999) ;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="icon" type="image/png" href="../favicon.ico"/>
  <title> Burengo - Compra, renta o vende vehículos e inmuebles </title>
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../plugins/toastr/toastr.min.css">
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">
 <nav class="main-header navbar navbar-expand-md navbar-dark bg-navy"> 
    <div class="container">
      <a href="<?php echo burengoBaseUrl; ?>" class="navbar-brand"><img src="../dist/img/burengo.png" alt="Burengo Logo" class="brand-image   elevation-0" style="opacity: .8"></a>
      <div class="collapse navbar-collapse order-3" id="navbarCollapse"><ul class="navbar-nav"> </ul></div>
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <li class="nav-item"><a class="nav-link" href="<?php echo burengoBaseUrl; ?>"> <?php echo burengo_portada; ?> </a></li>
        <li class="nav-item"><a class="nav-link" href="../contacto.php"> <?php echo burengo_contact; ?>  </a></li>
      </ul>
    </div>
  </nav>

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
        </div><!-- /.row -->
      </div> 
 </div>

<div class="content">
 <div class="container">
 <center>
 <div class="login-box">
  <div class="login-logo"></div>
  <div class="card">
    <div class="card-body login-card-body">
      <p><h4> <?php echo burengo_newUser; ?> </h4></p>
      <div action="#"><br/>
        <div class="input-group mb-3">
          <input id="fullname" type="text" class="form-control" placeholder="<?php echo burengo_fname; ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="far fa-id-badge">    </span>
            </div>
          </div>
        </div>        
		
		<div class="input-group mb-3">
          <input  id="username" type="text" class="form-control paste-no-event" placeholder="<?php echo burengo_uname; ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>		
		
		<div class="input-group mb-3">
          <input  id="email" type="email" class="form-control" placeholder="<?php echo burengo_email2; ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
		
        <div class="input-group mb-3">
          <input  id="password1" type="password" class="form-control" placeholder="<?php echo burengo_pw1; ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>        
		
		<div class="input-group mb-3">
          <input  id="password2" type="password" class="form-control" placeholder="<?php echo burengo_pw2; ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
		
		<div class="input-group mb-3">
          <input  id="identification" type="text" class="form-control" placeholder="<?php echo burengo_id;?>"  
		  data-inputmask='"mask": "<?php echo burengo_idMask; ?>"' data-mask > <!-- 094-0021875-7 -->
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="far fa-address-card"></span>  
            </div>
          </div>
        </div>

		<div class="input-group mb-3">
          <input  id="telefono" type="text" class="form-control" placeholder="<?php echo burengo_phone; ?>" data-inputmask='"mask": "<?php echo burengo_phoneMask; ?>"' data-mask  >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone"></span>  
            </div>
          </div>
        </div>	

		<div class="input-group mb-3">
          <input  id="wa" type="text" class="form-control" placeholder="<?php echo burengo_whatsapp; ?>" data-inputmask='"mask": "<?php echo burengo_phoneMask; ?>"' data-mask  >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fab fa-whatsapp"></span>  
            </div>
          </div>
        </div>		
		
		<div class="input-group mb-3">
          <select id="place" class="form-control">
				<option value="0"> <?php echo burengo_place; ?> </option>
		  </select>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-globe-americas"></span>  
            </div>
          </div>
        </div>		
		
		<div class="input-group mb-3">
          <input  id="address" type="text" class="form-control" placeholder="<?php echo burengo_addr;?>">  
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-map-marked-alt"></span>
            </div>
          </div>
        </div>
		
      <div class="row"><div class="col-12"><button id="btnNewAccount" type="button" class="btn btn-success btn-block"> <?php echo burengo_createAccount; ?> </button></div></div></div>
      <div class="social-auth-links text-center mb-3"> <a href="../acceder.php" class="btn btn-block btn-info"> <?php echo burengo_hadAccount; ?> </a></div>
    </div>
	 
	<a href="#" class="text-center text-mute" data-toggle="modal" data-target="#modal-sample"><small> <?php echo burengo_policy2; ?> </small></a>  
	<a href="#" class=" text-center text-mute" data-toggle="modal" data-target="#modal-sample2"> <small> <?php echo burengo_policy1; ?></small></a>
	 <br/>
  </div>
</div>
	<br/>
	<br/>
	<br/>
	 </center>
	 </div> 
    </div>
  </div>

<div id="triggerContract" data-toggle="modal" data-target="#modal-lg"></div>
<div class="modal fade" id="modal-lg">
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
              <p class="justify-content-between"><?php echo burengo_contract1?>	</p>
		</div>
<p>
<hr/>
<div class="form-group">
   <div class="form-check">
    <input id="terms-conditions" class="form-check-input" type="checkbox">
     <label class="form-check-label labelCheck"> <?php echo burengo_policy0; ?> </label>
    </div>
</div>
</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-danger" data-dismiss="modal"> <?php echo burengo_cancel; ?> </button>
              <button id="saveNewUsr" type="button" class="btn btn-success"> <?php echo burengo_accept; ?> </button>
            
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
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
<?php include_once "../burengo-footer.php"; ?>
</div>
<script src="../plugins/jquery/jquery.min.js"></script>
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../dist/js/adminlte.min.js"></script>
<script src="../plugins/toastr/toastr.min.js"></script>
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<script src="../plugins/bgo/burengo.min.js"></script>
<script type="text/javascript">
$('#place').load('../ajax/burengo_select_places.php');
$('#saveNewUsr').prop('disabled', true);
$('[data-mask]').inputmask();
 
/* Check Values */
$('#btnNewAccount').click(function(){
/* Preguntar por todos los campos si estan llenos  */
if( !isEmpty($('#fullname').val())){ 
if( !isEmpty($('#username').val())){
if( !isEmpty($('#email').val())){
if( !isEmpty($('#password1').val())){
	var pa =  $('#password1').val();
	var pb =  $('#password2').val();
	var pr = pa.localeCompare(pb);
if(pr==0){
if( !isEmpty($('#identification').val())){ 
if( !isEmpty($('#telefono').val())){ 
if( parseInt($('#place').val()) > 0){ 
if( !isEmpty($('#address').val())){
if(burengoCases($('#username').val())){	
	$('#triggerContract').click();
}else{$('#username').focus(); toastr.error('El nombre de usuario seleccionado no es permito. No se admiten acentos, espacios o caracteres especiales.');}	
}else{ $('#address').focus(); toastr.error('Debe completar todos los campos');}	
}else{ toastr.error('Debe completar todos los campos - Seleccione la provincia');}				 
}else{ $('#telefono').focus(); toastr.error('Debe completar todos los campos');}				 
}else{ $('#identification').focus(); toastr.error('Debe completar todos los campos');}	
}else{ $('#password1').focus(); toastr.error('Las Claves no coinciden'); }
}else{ $('#password1').focus(); toastr.error('Debe completar todos los campos');}
}else{ $('#email').focus(); toastr.error('Debe completar todos los campos'); }
}else{ $('#username').focus(); toastr.error('Debe completar todos los campos');} 
}else{ $('#fullname').focus(); toastr.error('Debe completar todos los campos');}
});



$('#terms-conditions').click(function(){
  if($('#terms-conditions').prop("checked") == true){
       $('#saveNewUsr').prop('disabled', false);
   }
    else if($('#terms-conditions').prop("checked") == false){
        $('#saveNewUsr').prop('disabled', true);
    }
});

/* Remover Espacios en blanco nombre usuario */
$('#username').keyup(function(){
var ntemp = $('#username').val();	
var ntemp = $('#username').val();
var res = ntemp.split(" ");
if(res.length>=2){
	var newText = ntemp.split(/\s/).join('');
	$('#username').focus(); 
	toastr.error('No se permiten espacios en blanco en el Nombre de usuario');
	$('#username').val(newText);		
}
}); 

/* Guardar un nuevo record */
$('#saveNewUsr').click(function(){
	$.getJSON('../ajax/burengo_insert_newAccount.php',{
		 nombre: $('#fullname').val(),
		 user: $('#username').val(),
		 email: $('#email').val(),
		 pass: 	$('#password1').val(),
		 ced: $('#identification').val(),
		 tel: $('#telefono').val(),
		 provincia: $('#place').val(),
		 address: $('#address').val(),
		 whatsapp: $('#wa').val()
	},function(data){
		switch(data['ok']){
			case 0: toastr.error('ERROR! No se pudo almacenar los datos: '+ data['err']); break;
			case 1: var code = <?php echo $code; ?>; location.href="planes.php?code="+code+"&acc="+data['code']+""; break;
			case 2:  toastr.info('<?php echo burengo_errAlert; ?>');  toastr.error('<?php echo burengo_err3; ?>'); break;
			case 3:  toastr.info('<?php echo burengo_errAlert; ?>');  toastr.error('<?php echo burengo_err2; ?>'); break;
			case 4:  toastr.info('<?php echo burengo_errAlert; ?>');  toastr.error('<?php echo burengo_err4; ?>'); break;
		}
	});	
});		
</script>
</body>
</html>
