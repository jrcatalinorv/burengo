<?php 
session_start();
date_default_timezone_set("America/Santo_Domingo");
require_once "../../../../modelos/conexion.php";
require_once "../../../../modelos/data.php";
$code = $_REQUEST["ccdt"];
$src = $_REQUEST["pth"];
/*  */
if(isset($_SESSION['bgo_userId'])){   
}else{
  header('Location: '.burengoBaseUrl.'acceder.php'); 
} 

/* Buscar el plan */
$stmt = Conexion::conectar()->prepare(" SELECT a.profile, b.planmaxf FROM bgo_users a INNER JOIN bgo_planes b ON a.profile = b.planid AND a.uid = '".$_SESSION['bgo_userId']."' ");
$stmt -> execute();
if($results = $stmt -> fetch()){
	$max = intval($results['planmaxf'])-1;
}else{
	$max = 0; 
}
/*  */
$stmt = Conexion::conectar()->prepare("SELECT p.*, c.*, i.*, m.*,n.*, l.*, cr.*, ts.*, tc.*, fl.*, vt.* FROM bgo_posts p 
INNER JOIN bgo_colores c ON p.bgo_color = c.clrs_id
INNER JOIN bgo_colores_int i ON p.bgo_color_interior = i.clrs_int_id
INNER JOIN bgo_marcas_vehiculos m ON p.bgo_marca = m.mv_id   
INNER JOIN bgo_modelos_vehiculos n ON p.bgo_modelo = n.mvd_id      
INNER JOIN bgo_places l ON p.bgo_lugar = l.pcid      
INNER JOIN bgo_currency cr ON p.bgo_currency = cr.cur_id  
INNER JOIN bgo_transmision_vehiculo ts ON p.bgo_transmision = ts.tsvid    
INNER JOIN bgo_traccion_vehiculo tc ON p.bgo_traccion = tc.tv_id    
INNER JOIN bgo_fuel fl ON p.bgo_fuel = fl.fid   
INNER JOIN bgo_innercategoires vt ON p.bgo_vtype = vt.inncat  
AND p.bgo_code = '".$code."'");
$stmt -> execute();
/*  */
if($results = $stmt -> fetch()){
 $thumpnail = "../../../../media/thumbnails/".$results['bgo_thumbnail'];
 $totalPhotos = intval($results['bgo_comp_img']);
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
<link rel="stylesheet" href="<?php echo burengoBaseUrl; ?>dist/css/adminlte.css">
<style type="text/css"> .Hideme{display:none;} </style>
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">
 <nav class="main-header navbar navbar-expand-md navbar-dark bg-black"> 
    <div class="container">
      <a href="" class="navbar-brand"><img src="<?php echo burengoBaseUrl; ?>dist/img/burengo.png" alt="Burengo Logo" class="brand-image   elevation-0" style="opacity: .8"></a>
	  <div class="collapse navbar-collapse order-3" id="navbarCollapse"><ul class="navbar-nav"> </ul></div>
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
         <li class="nav-item"><a class="nav-link" href="">
			 <img alt="Avatar"  class="user-image" src="<?php echo burengoBaseUrl; ?>media/users/<?php echo $_SESSION['bgo_userImg']; ?>"> <?php echo $_SESSION['bgo_user']; ?></a>
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
	 			
			<!------------------------------>
		</div>
</div>
	  
    <div class="row pt-4">
	<div class="col-md-12">
	<input id="getMaxValAllow" value="<?php echo $max; ?>" type="hidden" />
	<input id="getUserID" type="hidden" value="<?php echo $_SESSION['bgo_userId']; ?>" />
	<input id="url" type="hidden" value="<?php echo $src; ?>" />
    
            <div class="card">
			  <div class="card-header">
                <h3 class="card-title">  
				<i class="far fa-image"></i>
				
				<?php echo burengo_portadaPost; ?>
				<input id="uploadedCTRL" type="hidden" value="1" />
				<input id="getCode" type="hidden" value="<?php echo $code; ?>" />
				<input id="url" type="hidden" value="<?php echo $src; ?>">
				</h3>
              </div>
            <div class="card-body"> <input id="currentCode" type="hidden" value="<?php echo $code; ?>" />
			<div class="form-group p-0">
				<button id="changeImg" class="btn btn-info mt-1"> <i class="far fa-image"></i> <?php echo burengo_chImgPortada; ?> </button>
				<?php 
					if($totalPhotos>=1){ 
						echo '<button id="changeImges" class="btn btn-info mt-1"> <i class="far fa-image"></i> Sustituir Imagenes Complemtarias </button>';
						}else{
						echo '<button id="changeImges" class="btn btn-primary mt-1"><i class="fas fa-plus"></i> Anexar Mas imagenes </button>';
					}
				?>
             <h3 class="Hideme"> <?php echo burengo_selectPortada; ?> </h3>
             <div class="input-group Hideme">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="file">
                        <label class="custom-file-label" for="file"> <?php echo burengo_chooseFile; ?> </label>
                      </div>
                    </div>
                  </div>
			 <hr/>
			 
			<h3 id="t2" class="Hideme"> <i class="far fa-images"></i> <?php echo burengo_addMore; ?>  </h3>
			<div id="t3"class="form-group Hideme">
                <div class="input-group">
                      <div class="custom-file">
                        <input type="file" id="inpFile" multiple />
                       <label class="custom-file-label" for="inpFile">  <?php echo burengo_selectImg; ?> </label>  
                      </div>  
                    </div>
                  </div>
				  
			<div class="col-md-6">
				<div style="padding: 10px; height:260px; width:315px;">
					<span   id="uploaded_image"> <img src="<?php echo $thumpnail; ?>" style="height:250px; width:auto;"  class="img-thumbnail" /></span> 
				</div>
            </div>			
			<br/>
			<div class="col-md-12">
				<div>
					<span   id="uploaded_images">
					  <?php 
			 			$extraImages = json_decode($results['bgo_extrapics'], true);
						for($i=0; $i < count($extraImages); $i++){
							echo '<img src="'.burengoBaseUrl.'media/images/'.$code.'/'.$extraImages[$i].'" height="125" width="150" class="img-thumbnail mr-1">';
						}
				  
				?>
					</span>				
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
      </div> 
    </section>
  </div>
  <footer class="main-footer bg-black"> Burengo &copy; 2020 - <?php echo burengo_copyright; ?> </footer>
</div>
<!-- ./wrapper -->
<script src="<?php echo burengoBaseUrl; ?>plugins/jquery/jquery.min.js"></script>
<script src="<?php echo burengoBaseUrl; ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo burengoBaseUrl; ?>plugins/toastr/toastr.min.js"></script>
<script src="<?php echo burengoBaseUrl; ?>dist/js/adminlte.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$('#changeImg').click(function(){
	$('#file').click();
});
$('#changeImges').click(function(){
	$('#inpFile').click();
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
		}
   });
  } //Fin del else 
	}
 });
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
});
$('#cancel').click(function(){ 
var ch = $('#url').val();
switch(ch){
	case '1':  location.href="confirmacion.php?ccdt="+$('#pcode').val(); break;
	case '2': location.href="../../../publicaciones.php"; break;
	default: location.href="../../../inicio.php";  break; 
}
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
 </script>
</body>
</html>
