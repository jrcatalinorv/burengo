<?php 
session_start();
date_default_timezone_set("America/Santo_Domingo");
require_once "modelos/conexion.php";
require_once "modelos/data.php";

if(isset($_SESSION['bgo_userId'])){   
}else{
  header('Location: acceder.php'); 
} 

$code = $_SESSION['bgo_userId'];
$fsDt = date("Y-m-d", strtotime("first day of this month")); 
$lsDt = date("Y-m-d", strtotime("last day of this month")); 
$stmt5 = Conexion::conectar()->prepare("SELECT u.*, p.*, pl.* FROM bgo_users u 
INNER JOIN bgo_places p  ON u.provinvia = p.pcid 
INNER JOIN bgo_planes pl ON u.profile = pl.planid AND u.uid = '".$_SESSION['bgo_userId']."'");
$stmt5 -> execute();
$rest5 = $stmt5 -> fetch(); 

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="icon" type="image/png" href="<?php echo burengoBaseUrl; ?>favicon.ico"/>
  <title>Burengo</title>
  <link rel="stylesheet" href="<?php echo burengoBaseUrl; ?>plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?php echo burengoBaseUrl; ?>dist/css/adminlte.css">
  <link rel="stylesheet" href="<?php echo burengoBaseUrl; ?>plugins/toastr/toastr.min.css">
<style>
@media only screen and (max-width: 600px) {
.bgo_top{
	margin-top: 2rem; 
  }
} 

.Hideme{
	display:none;
	
} 
</style>
</head>
<body class="hold-transition layout-top-nav layout-navbar-fixed">
<div class="wrapper">
 <nav class="main-header navbar navbar-expand-md navbar-dark bg-navy"> 
    <div class="container">
      <a href="inicio.php" class="navbar-brand">
        <img src="<?php echo burengoBaseUrl; ?>dist/img/burengo.png" alt="Burengo Logo" class="brand-image   elevation-0" style="opacity: .8"> 
      </a>
      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <ul class="navbar-nav"> </ul>
      </div>
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
	  		<li class="nav-item"><a class="nav-link" href="profile.php">
			 <img alt="Avatar"  class="user-image" src="<?php echo burengoBaseUrl; ?>media/users/<?php echo $_SESSION['bgo_userImg']; ?>">
			 <?php echo $_SESSION['bgo_user']; ?></a>
		</li>
	<li class="nav-item dropdown show">
        <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="true">
          <i class="fas fa-bars fa-lg"></i>
           
        </a>
			<?php include_once "dropdown-menu.php"; ?>
      </li>
     
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <input type="hidden" id="usrcode" value="<?php echo $_SESSION['bgo_userId']; ?>" />
        </div> 
      </div> 
    </div>

 <!-- Main content -->
 <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
			<div class="card">
  
        <div class="card-body" style="display: block;">
          <div class="row">
		  
            <div class="col-12 col-md-12 col-lg-7 order-2 order-md-1 pt-2">
           <h5 class=""> <?php echo burengo_personalData; ?> </h5>
              <div class="form-group pt-3">
                <label> <?php echo burengo_fname; ?> </label>
                <input id="fullname" type="text" class="form-control" value="<?php echo $rest5["name"]; ?>" />
				<input id="currentCode" class="form-control" type="hidden" value="<?php  echo $_SESSION['bgo_userId']; ?>"/>
               </div>              
			   
			   <div class="form-group">
                <label> <?php echo burengo_uname; ?> </label>
                <input id="username" type="text" class="form-control" value="<?php echo $rest5["user"]; ?>" />
               </div>  
			   
			   <div class="form-group">
                <label> <?php echo burengo_email2; ?> </label>
                <input id="email" type="text" class="form-control" value="<?php echo $rest5["email"]; ?>" />
               </div>
			   
			   <div class="form-group">
                <label> <?php echo burengo_id;?> </label>
                <input id="identification" type="text" class="form-control" value="<?php echo $rest5["ced"]; ?>" />
               </div>
			  
			  	<div class="form-group">
                <label> <?php echo burengo_phone; ?> </label>
                <input id="telefono" type="text" class="form-control" value="<?php echo $rest5["phone"]; ?>" />
               </div>

				<div class="form-group"> <label> <?php echo burengo_place; ?> </label>
					<select id="place" class="form-control">
                         <option value="0"> <?php echo burengo_place; ?> </option>
						 <?php 
							$stmt2 = Conexion::conectar()->prepare("SELECT * FROM bgo_places WHERE pcstatus = 1");
							$stmt2 -> execute();
							while( $resulta2 = $stmt2 -> fetch()){		
								if($rest5["provinvia"]==$resulta2['pcid']){
									echo '<option selected value="'.$resulta2['pcid'].'"> '.$resulta2['pcstr'].' </option>';	
								}else{
									echo '<option value="'.$resulta2['pcid'].'"> '.$resulta2['pcstr'].' </option>';	
								}
							}	
						?>
						</select> 
						</div>
			   
			  	<div class="form-group">
                <label> <?php echo burengo_addr;?> </label>
                <input id="address" type="text" class="form-control" id="fullname" value="<?php echo $rest5["addr"]; ?>" />
               </div>	
			   

	
			  	<div class="form-group">
                <label> <?php echo burengo_whatsapp; ?> </label>
                <input id="whatsapp" type="text" class="form-control" value="<?php echo $rest5["bgo_whatsapp"]; ?>" />
               </div>				  	
			   
			   <div class="form-group">
                <label> Instagram </label>
                <input id="instagram" type="text" class="form-control" value="<?php echo $rest5["bgo_instagram"]; ?>" />
               </div>

			   <div class="form-group">
                <label> Facebook </label>
                <input id="facebook" type="text" class="form-control" value="<?php echo $rest5["bgo_facebook"]; ?>" />
               </div>			   
			   
 	<div class="form-group ">
                    <div class="input-group Hideme">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="file">
                        <label class="custom-file-label" for="file"> <?php echo burengo_chooseFile; ?> </label>
                      </div>
                    </div>
                  </div>
          </div>
			 <div class="col-12 col-md-12 col-lg-5 order-1 order-md-2 float-right">
			     <div class="text-center">
				 <div id="imgPlaceHolder">
					<img class="profile-user-img img-fluid img-circle" src="<?php echo burengoBaseUrl; ?>media/users/<?php echo $_SESSION['bgo_userImg']; ?>" alt="User profile picture">
				 </div>
				 <p><a id="changePic" href="#"> <?php echo burengo_changePic; ?> </a></p>
				 <p><a id="deleteAccount" href="#"> <?php echo burengo_delAcc; ?> </a></p>
				 </div>
           </div>
		</div>
     </div>
        <!-- /.card-body -->
	<div class="card-footer">
               <a href="profile.php" type="button" class="btn btn-danger"> <i class="fas fa-times"></i> <?php echo burengo_cancel; ?> </a>			  	
			   <div class="float-right">  	
				 <button  type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-pass"> <i class="fas fa-lock"></i> <?php echo burengo_changePass; ?> </button>
				<button  id="updateAccount" type="button" class="btn btn-warning" > <i class="fas fa-retweet"></i>  <?php echo burengo_update; ?>  </button>
           </div>
        </div>	
      </div> 
 </div>
<!-- /.col -->
</div>
</div><!-- /.container-fluid -->
</section>
</div>


<div id="triggerDelAcc" data-toggle="modal" data-target="#modal-delAcc" ></div>

<div class="modal fade" id="modal-pass">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"> <?php echo burengo_changePass; ?> </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
				<div class="form-group"><input type="password" class="form-control" id="password0" placeholder="<?php echo burengo_accPass; ?>"></div>
				<div class="form-group"><input type="password" class="form-control" id="password1" placeholder="<?php echo burengo_newPass; ?>"></div>
				<div class="form-group"><input type="password" class="form-control" id="password2" placeholder="<?php echo burengo_conPass; ?>"></div> 
            </div>
			 <div class="modal-footer justify-content-between">
              <button id="closeMeBtn" type="button" class="btn btn-danger" data-dismiss="modal"> <?php echo burengo_close; ?> </button>
              <button id="changePass" type="button" class="btn btn-success"> <?php echo burengo_accept; ?> </button>
            </div>
          </div>
        </div>
      </div>


<div class="modal fade" id="modal-delAcc">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"> Eliminiar Cuenta </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
				<p class="text-center text-info">  ¿Está seguro que desea eliminar su cuenta de usuario? <br/>Este proceso no puede revertirse.   </p>
				
				
            </div>
			 <div class="modal-footer justify-content-between">
              <button id="closeMeBtn" type="button" class="btn btn-secondary" data-dismiss="modal"> <i class="fas fa-times"></i>  <?php echo burengo_cancel; ?> </button>
              <button id="ProceedToDelete" type="button" class="btn btn-danger"> <i class="fas fa-trash"></i> <?php echo burengo_accept; ?> </button>
            </div>
          </div>
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

 
<?php include_once "burengo-footer.php"; ?>

</div>
<script src="<?php echo burengoBaseUrl; ?>plugins/jquery/jquery.min.js"></script>
<script src="<?php echo burengoBaseUrl; ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo burengoBaseUrl; ?>dist/js/adminlte.min.js"></script>
<script src="<?php echo burengoBaseUrl; ?>plugins/toastr/toastr.min.js"></script>
<script type="text/javascript">
$('#changePic').click(function(){
	$('#file').click();
});

$(document).on('change', '#file', function(){
	var name = document.getElementById("file").files[0].name;
	var form_data = new FormData();
	var ext = name.split('.').pop().toLowerCase();
  
 if(jQuery.inArray(ext, ['png','jpg','jpeg']) == -1) 
  {
	toastr.error('Archivo Invalido. Solo se permite jpg, png & jpeg');
  }else{
	var oFReader = new FileReader();
		oFReader.readAsDataURL(document.getElementById("file").files[0]);
		
	var f = document.getElementById("file").files[0];
	var fsize = f.size||f.fileSize;
  
	 if(fsize > 5000000)
		{
		 toastr.error('La imgen es muy Grande. Solo se permiten archivos de max 2MB');			
		}
	else
	{
		$('#imgPlaceHolder').html();
		form_data.append("file", document.getElementById('file').files[0]);
		form_data.append("code", $('#currentCode').val());

   $.ajax({
		url:"upload-pic.php",
		method:"POST",
		data: form_data,
		contentType: false,
		cache: false,
		processData: false,
		beforeSend:function(){
			//toastr.success('Subiendo Imagen de portada');	
		},   
			success:function(data){
			$('#imgPlaceHolder').html(data);
		}
   });
  } //Fin del else 
	
		
	}
 });
 
$('#updateAccount').click(function(){
/* Preguntar por todos los campos si estan llenos  */
if( !isEmpty($('#fullname').val())){ 
if( !isEmpty($('#username').val())){ 
if( !isEmpty($('#email').val())){
if( !isEmpty($('#identification').val())){ 
if( !isEmpty($('#telefono').val())){ 
if( parseInt($('#place').val()) > 0){ 
if( !isEmpty($('#address').val())){
	updateData();
}else{ $('#address').focus(); toastr.error('Debe especificar la direccion');}	
}else{ toastr.error('Debe completar todos los campos - Seleccione la provincia');}				 
}else{ $('#telefono').focus(); toastr.error('Debe completar todos los campos');}				 
}else{ $('#identification').focus(); toastr.error('Debe completar todos los campos');}	
}else{ $('#email').focus(); toastr.error('Debe completar todos los campos'); }
}else{ $('#username').focus(); toastr.error('El campo Usuario no puede estar en blanco');} 
}else{ $('#fullname').focus(); toastr.error('Debe completar todos los campos');}
});
 
function isEmpty(str) {
    return (!str || 0 === str.length);
}
function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}

/* Guardar un nuevo record */
function updateData(){
	$.getJSON('<?php echo burengoBaseUrl; ?>ajax/burengo_update_account.php',{
		 code: $('#currentCode').val(),
		 nombre: $('#fullname').val(),
		 user: $('#username').val(),
		 email: $('#email').val(),
		 pass: 	$('#password1').val(),
		 ced: $('#identification').val(),
		 tel: $('#telefono').val(),
		 provincia: $('#place').val(),
		 address: $('#address').val(),
		 wa: $('#whatsapp').val(),
		 ig: $('#instagram').val(),
		 fb: $('#facebook').val()
	},function(data){
		switch(data['ok']){
			case 0: toastr.error('ERROR! No se pudo almacenar los datos: '+ data['err']); break;
			case 1: location.href=""; break;
		}
	});	
}

 
$('#changePass').click(function(){

if( !isEmpty($("#password0").val())){ 
  if( !isEmpty($("#password1").val())){
	if( !isEmpty($("#password2").val())){
	var newpass  = $("#password1").val();
	var conpass  = $("#password2").val(); 
	var pr = newpass.localeCompare(conpass);
	
	if(pr==0){
			$.getJSON('<?php echo burengoBaseUrl; ?>ajax/burengo_update_account_pass.php',{
		 code: $('#currentCode').val(),
		 pass: $("#password0").val(),
		 npass: newpass
  },function(data){
		switch(data['ok']){
			case 0: toastr.error('ERROR! No se pudo almacenar los datos: '+ data['err']); break;
			case 1: toastr.success('Los Datos fueron actualizados de forma correcta.'); $('#closeMeBtn').click(); break;
			case 2: $('#password0').val(""); $('#password0').focus(); toastr.error('La clave actual no es correcta! '); break;
		}
	});
		
	}else{
		$('#password1').val(""); 
		$('#password2').val(""); 
		$('#password1').focus(); 
		toastr.error('Las Claves no coinciden');
	}
}else{ $('#password2').focus();	toastr.error('Las Claves no coinciden'); }
}else{ $('#password1').focus();	toastr.error('Las Claves no coinciden'); }
}else{ $('#password0').focus(); toastr.error('La clave actual no es correcta! '); }
}); 

$('#deleteAccount').click(function(){
  	$('#triggerDelAcc').click();
});

$('#ProceedToDelete').click(function(){
var usr = $('#usrcode').val();

$.getJSON('<?php echo burengoBaseUrl; ?>ajax/burengo_delete_user.php',{
		pid: usr
	},function(data){
		switch(data['ok']){
			case 0: toastr.error('ERROR! No se guardaron los cambios los datos: '+ data['err']); break;
			case 1: location.href="salir.php"; break;
		}
	});	

});
</script>
</body>
</html>
<?php 
function convert($id){
	switch($id){
		case 0: return ""; break;
		case 1: return " x ".burengo_day; break;
		case 2: return " x ".burengo_night; break;
		case 3: return " x ".burengo_hour; break;
		case 4: return " - ".burengo_week; break;
		case 5: return " - ".burengo_month; break;
		default: return ""; break;
	}
}
?>