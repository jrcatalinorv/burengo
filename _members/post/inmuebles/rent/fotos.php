<?php 
session_start();
date_default_timezone_set("America/Santo_Domingo");
require_once "../../../../modelos/conexion.php";
require_once "../../../../modelos/data.php";
$code = $_REQUEST["ccdt"];

if(isset($_SESSION['bgo_userId'])){   
}else{
  header('Location: ../../../../acceder.php'); 
} 



/*Buscar el plan */
 $stmt = Conexion::conectar()->prepare(" SELECT a.profile, b.planmaxf FROM bgo_users a INNER JOIN bgo_planes b
ON a.profile = b.planid AND a.uid = '".$_SESSION['bgo_userId']."' ");
$stmt -> execute();
if($results = $stmt -> fetch()){
	$max = intval($results['planmaxf'])-1;
}else{
	$max = 0; 
}

$structure = '../../../../media/images/'.$code.'/';

if(is_dir($structure)){
	/* No hacer nada */
}else{
	if (!mkdir($structure, 0777, true)) {
			die('Failed to create folders...');
	} 
}


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
  <link rel="stylesheet" href="<?php echo burengoBaseUrl; ?>plugins/toastr/toastr.min.css">
  <link rel="stylesheet" href="../../../../../dist/css/adminlte.css">
  <style type="text/css">
.Hideme{
	display:none;
}

@media only screen and (min-width: 992px) {
.bgo-wrapper{width: 600px;  height: 100px; padding-left:100px;}
.bgo-margin-area {  position: relative;  text-align: center;  font-family: "Trebuchet", sans-serif;  font-size: 14px;  margin: 0 20px;}
.bgo-dot {height: 30px; width: 30px; position: absolute; background: #000; border-radius: 50%; top: 10px; color: #fff; line-height: 30px; z-index: 9999;}
.bgo-dot.bgo-one {left: 35px; background: #0C84D9;}
.bgo-dot.bgo-two {left: 180px; background: #0C84D9;}
.bgo-dot.bgo-three {left: 330px; background: #bbb; color: #fff;}
.bgo-progress-bar { position: absolute;  height: 10px;  width: 35%;  top: 20px;  left: 10%;  background: #bbb;}
.bgo-progress-bar.bgo-first {background: #0C84D9;}
.bgo-progress-bar.bgo-second {left: 40%;}
.bgo-message{position: absolute;height: 60px;width: 170px;padding: 10px;margin: 0;left: -50px;top: 0;color: #000;}
.bgo-message.bgo-message-1 {top: 40px;color: #000;}
.bgo-message.bgo-message-2 {left: 160px;}
.bgo-message.bgo-message-3 {left: 160px;color: #000;}	
}	


/*  Vista celulares y tablet portrait */
@media screen and (max-width: 700px) {
	.bgo-wrapper{ padding-left:10px; width: 450px; height: 100px; }
	.bgo-margin-area {position: relative;  text-align: center;  font-family: "Trebuchet", sans-serif;  font-size: 14px;  margin: 0 20px;}	
	.bgo-dot {height: 30px; width: 30px; position: absolute; background: #000; border-radius: 50%; top: 10px; color: #fff; line-height: 30px; z-index: 9999;}
	.bgo-dot.bgo-one {left: 35px; background: #0C84D9;}
	.bgo-dot.bgo-two {left: 180px; background: #0C84D9;}
	.bgo-dot.bgo-three {left: 330px; background: #bbb; color: #fff; }
	.bgo-progress-bar { position: absolute;  height: 10px;  width: 45%;  top: 20px;  left: 10%;  background: #bbb;}
	.bgo-progress-bar.bgo-first {background: #0C84D9;}
	.bgo-progress-bar.bgo-second {left: 40%;}
	.bgo-message{position: absolute; height: 60px; width: 170px; padding: 10px; margin: 0; left: -50px; top: 0; color: #000;}
	.bgo-message.bgo-message-1 { display: none;}
	.bgo-message.bgo-message-2 {display: none;}
	.bgo-message.bgo-message-3 {display: none;}
}


@media screen and (max-width: 1000px) {
	.bgo-wrapper{ padding-left:10px; width: 450px; height: 100px; }
	.bgo-margin-area {position: relative;  text-align: center;  font-family: "Trebuchet", sans-serif;  font-size: 14px;  margin: 0 20px;}
	.bgo-dot {height: 30px; width: 30px; position: absolute; background: #000; border-radius: 50%; top: 10px; color: #fff; line-height: 30px; z-index: 9999;}
	.bgo-dot.bgo-one {left: 35px; background: #0C84D9;}
	.bgo-dot.bgo-two {left: 180px; background: #0C84D9;}
	.bgo-dot.bgo-three {left: 330px; background: #bbb; color: #fff; }
	.bgo-progress-bar { position: absolute;  height: 10px;  width: 45%;  top: 20px;  left: 10%;  background: #bbb;}
	.bgo-progress-bar.bgo-first {background: #0C84D9;}
	.bgo-progress-bar.bgo-second {left: 45%;}
	.bgo-message{position: absolute; height: 60px; width: 170px; padding: 10px; margin: 0; left: -50px; top: 0; color: #000;}
	.bgo-message.bgo-message-1 {top: 40px; color: #000;}
	.bgo-message.bgo-message-2 {left: 160px;}
	.bgo-message.bgo-message-3 {left: 160px;color: #000;}	
}
  		
			
   </style>
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">
 <nav class="main-header navbar navbar-expand-md navbar-dark bg-black"> 
    <div class="container">
      <a href="" class="navbar-brand">
	                  <img src="../../../../../dist/img/burengo.png" alt="Burengo Logo" class="brand-image   elevation-0" style="opacity: .8">  
      </a><div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <ul class="navbar-nav"> </ul>
      </div>
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
         <li class="nav-item"><a class="nav-link" href="">
			 <img alt="Avatar"  class="user-image" src="../../../../media/users/<?php echo $_SESSION['bgo_userImg']; ?>">
			 <?php echo $_SESSION['bgo_user']; ?></a>
		</li>

	   </ul>
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
 <section class="content">
      <div class="container-fluid">
	          <div class="row">
         <div class="col-md-12"> 
	<center>
			<div class="bgo-wrapper">
			<div class="bgo-margin-area">
			<div class="bgo-dot bgo-one">1</div>
			<div class="bgo-dot bgo-two">2</div>
			<div class="bgo-dot bgo-three">3</div>
			<div class="bgo-progress-bar bgo-first"></div>
			<div class="bgo-progress-bar bgo-second"></div>
			<div class="bgo-message bgo-message-1"> <?php echo burengo_gral; ?> <div>
			<div class="bgo-message bgo-message-2"> <?php echo burengo_upImg; ?>  <div>
			<div class="bgo-message bgo-message-3"> <?php echo burengo_confirmData; ?>  <div>
			</div></div></div></div></div></div>
			</div>
			</div>
	</center>			
			<!------------------------------>
		</div>
</div>
	  
    <div class="row">
	<div class="col-md-12">
	<input id="getMaxValAllow" value="<?php echo $max; ?>" type="hidden" />
	<input id="getUserID" type="hidden" value="<?php echo $_SESSION['bgo_userId']; ?>" />
            <div class="card">
			  <div class="card-header">
                <h3 class="card-title">  
				<i class="far fa-image"></i>
				
				<?php echo burengo_portadaPost; ?>
				<input id="uploadedCTRL" type="hidden" value="0" />
				<input id="getCode" type="hidden" value="<?php echo $code; ?>" />
				
				</h3>
              </div>
            <div class="card-body"> <input id="currentCode" type="hidden" value="<?php echo $code; ?>" />
 
			<div class="form-group">
                      <h3><?php echo burengo_selectPortada; ?> </h3>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="file">
                        <label class="custom-file-label" for="file"><?php echo burengo_chooseFile; ?></label>
                      </div>
                    </div>
                  </div>
 

			 <hr/>
			 
			 <h3 id="t2" class="Hideme"> <i class="far fa-images"></i> <?php echo burengo_addMore; ?>  </h3>
				 
				 <div id="t3"class="form-group Hideme">
             
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" id="inpFile" multiple />
                        <label class="custom-file-label" for="inpFile"> <?php echo burengo_selectImg; ?> </label>  
						 
                      </div>  
					  
 
					  
                    </div>
                  </div>
				  
			<div class="col-md-6">
				<div style="padding: 10px; height:260px; width:415px;">
					<span   id="uploaded_image"></span>
				</div>
            </div>			
			
			<div class="col-md-12">
				<div>
					<span   id="uploaded_images"></span>
				</div>
            </div>  
				  
				  
			</div>
			
			<div class="card-footer clearfix ">
                              <button id="cancel" type="button" class="btn btn-danger"> <i class="fas fa-times-circle"></i> <?php echo burengo_cancel; ?> </button>
              
				<button id="next" type="button" class="btn btn-primary float-right">  <?php echo burengo_next; ?> <i class="fas fa-arrow-alt-circle-right"></i> </button>
              </div>
			
            </div>
          </div>
	  	

  </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  </div>
  <!-- /.content-wrapper -->


 

  <!-- Main Footer -->
  <footer class="main-footer bg-black"> Burengo &copy; 2020 - <?php echo burengo_copyright; ?> </footer>
</div>
<!-- ./wrapper -->

<script src="../../../../../plugins/jquery/jquery.min.js"></script>
<script src="../../../../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../../../../plugins/toastr/toastr.min.js"></script>
<script src="../../../../../dist/js/adminlte.min.js"></script>
<script src="../../../../../dist/js/demo.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  
$('#next').prop('disabled', true);
  
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
  
	 if(fsize > 9000000)
		{
		 toastr.error('La imgen es muy Grande. Solo se permiten archivos de max 2MB');			
		}
	else
	{
		$('#uploaded_image').html();
		form_data.append("file", document.getElementById('file').files[0]);
		form_data.append("code", $('#currentCode').val());

   $.ajax({
		url:"../../upload.php",
		method:"POST",
		data: form_data,
		contentType: false,
		cache: false,
		processData: false,
		beforeSend:function(){
			toastr.success('Subiendo Imagen de portada');	
		},   
			success:function(data){
			$('#uploaded_image').html(data);
			$('#uploadedCTRL').val(1);
			$('#next').prop('disabled', false);
			$('#t2').removeClass('Hideme');
			$('#t3').removeClass('Hideme');
		}
   });
  } //Fin del else 
	
		
	}
 });
 
 
/* -----------------------------------------------------------  */
//Subir otras fotos:
/* -----------------------------------------------------------  */
$(document).on('change', '#inpFile', function(){
 var arr = document.getElementById("inpFile").files;
 var maxAllow = $('#getMaxValAllow').val();

  if( arr.length > maxAllow ){
	  toastr.error('Su plan solo permite '+maxAllow+' fotos extra por Publicacion');	
	 }else{
	   if(!isHigher(9000000,arr)){
			if(isValid(arr)){
const inpFile = document.getElementById("inpFile");
const formData = new FormData();
 
for( const file of inpFile.files){
	formData.append("myFiles[]",file);
  } 

formData.append("code", $('#currentCode').val());;


				
$.ajax({
		url:"../../uploadMult.php",
		method:"POST",
		data: formData,
		contentType: false,
		cache: false,
		processData: false,
		beforeSend:function(){
			//toastr.success('Subiendo Imagen de portada');	
		},   
	  success:function(data){
			//alert(data);
			$('#uploaded_images').html(data);
			//$('#uploadedCTRL').val(1);
		}
   });				
				
   }else{toastr.error('Uno o Mas archivos es Invalido. Solo se permite jpg, png & jpeg');} 
	}else{toastr.error('Uno o Mas archivos sobrepasa el tamano maximo permitido');}  	 	
   }   
});
/* -----------------------------------------------------------  */



});
 

 

$('#cancel').click(function(){
	deleteData(id);
});

$('#next').click(function(){
 
	if($('#uploadedCTRL').val()==1){
		location.href="confirmacion.php?ccdt="+$('#getCode').val();
	}else{
		toastr.error('Debe elegir al menos una imagen');
	}
 	
});

 
function isHigher(limit, data){
      for(var k = 0; k < data.length; k++){
        if (data[k].size > limit)
          return true;
      }
      return false;
    } 

	
	
function isValid(data){
      for(var k = 0; k < data.length; k++){
		  var n = data[k].name;
		  var ext = n.split('.').pop().toLowerCase();
		if(jQuery.inArray(ext, ['jpg','jpeg','png']) == -1){ 
			return false;
		 }
      }
      return true;
    }
 
/* */
function deleteData(id){	
$.getJSON('<?php echo burengoBaseUrl; ?>ajax/burengo_delete_post.php',{
		pid: id
	},function(data){
		switch(data['ok']){
			case 0: toastr.error('ERROR! No se guardaron los cambios los datos: '+ data['err']); break;
			case 1: location.href="../../../inicio.php"; break;
		}
	});		
}	
  

</script>
</body>
</html>
