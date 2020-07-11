<?php  
session_start(); 
date_default_timezone_set("America/Santo_Domingo");
$ct = $_REQUEST["ct"];
$ctStr = countryName($ct);
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
  <link rel="stylesheet" href="../../dist/css/adminlte.css">
  <link rel="stylesheet" href="../../plugins/toastr/toastr.min.css"> 
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark bg-navy">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
<!--	  <li class="nav-item d-none d-sm-inline-block"><a href="settings-currency-menu.php" class="nav-link"> Menú Monedas </a></li> -->
	  <li class="nav-item d-none d-sm-inline-block"><a href="settings.php" class="nav-link"> Menú Configuración </a></li>	
      
    </ul>
  <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
 	<li class="nav-item dropdown" data-toggle="modal" data-target="#catcurrency"><a class="nav-link"  href="#"><i class="fas fa-plus-circle"></i>  Moneda </a></li>
	 
    </ul>
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
          <li class="nav-item"><a href="members.php" class="nav-link"><i class="nav-icon fas fa-users"></i><p> Miembros </p></a></li>
          <li class="nav-item"><a href="all-publications.php" class="nav-link"><i class="nav-icon fas fa-list-alt"></i><p> Publicaciones </p></a></li>
          <li class="nav-item"><a href="planes.php" class="nav-link"><i class="nav-icon fas fa-list"></i><p> Planes </p></a></li>
          <li class="nav-item"><a href="settings.php" class="nav-link active"><i class="nav-icon fas fa-cogs"></i><p> Configuración </p></a></li>
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
	<input type="hidden" id="getCountryCode" value="<?php echo $ct; ?>" />
      <div class="container-fluid">
	  <div class="row pt-2">
	        <div class="col-md-12">
   <div class="card">
              <div class="card-header">
                <h3 class="card-title"> <i class="fas fa-map-marked-alt"></i> Monedas  </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th> Codigo </th>
                      <th> Moneda </th>
                      <th> Signo </th>
                      <th> Pais </th>
                      <th>Estatus</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody id="categoryBody">     <!-- changeStatus -->             
			
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
	 </div>  
    </div><!-- /.container-fluid -->
    </div>
  </div>
  
  
<div id="triggereditCatmodal" data-toggle="modal" data-target="#editCatmodal"></div>

 <!----  Modal Categorias ------->
      <div class="modal fade" id="catcurrency">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"> Nueva Moneda </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
          <div class="input-group mb-3">
                  <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-globe-americas"></i></span></div>
                  <input id="modalCountryStr" readonly type="text" class="form-control" value="<?php echo $ctStr; ?>">
                  <input id="modalCountry" readonly type="hidden" class="form-control" value="<?php echo $ct; ?>">
                </div>
				
          <div class="input-group mb-3">
                  <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-code"></i></span></div>
                  <input id="modalCurrencyCode" type="text" class="form-control" placeholder="Código (Ej: USD)" >
                </div>				
				 
				 <div class="input-group mb-3">
                  <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-money-bill-wave-alt"></i></span></div>
                  <input id="modalCurrency" type="text" class="form-control" placeholder="Moneda (Ej: Dolar)" >
                </div>					 
				
				<div class="input-group mb-3">
                  <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-filter"></i></span></div>
                  <input id="modalSign" type="text" class="form-control" placeholder="Símbolo (Ej: $)" >
                </div>				
				
            </div>
            <div class="modal-footer justify-content-between">
              <button id="closeModalBtn" type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fas fa-times"></i> Cancelar </button>
              <button id="modalSaveCurrency" type="button" class="btn btn-success"> <i class="fas fa-save"></i> Guardar </button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->	  
 
  <!----  Modal Categorias ------->
      <div class="modal fade" id="editCatmodal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"> Editar  Moneda </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
          <div class="input-group mb-3">
                  <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-globe-americas"></i></span></div>
                  <input id="modalEditCountryStr" readonly type="text" class="form-control" value="<?php echo $ctStr; ?>">
                  <input id="modalEditCountry" readonly type="hidden" class="form-control" value="<?php echo $ct; ?>">
                </div>
				
          <div class="input-group mb-3">
                  <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-code"></i></span></div>
                  <input id="modalEditCurrencyCode" type="text" class="form-control" placeholder="Código (Ej: USD)" >
                  <input id="modalEditCurrencyId" type="hidden" class="form-control" >
                </div>				
				 
				 <div class="input-group mb-3">
                  <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-money-bill-wave-alt"></i></span></div>
                  <input id="modalEditCurrency" type="text" class="form-control" placeholder="Moneda (Ej: Dolar)" >
                </div>					 
				
				<div class="input-group mb-3">
                  <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-filter"></i></span></div>
                  <input id="modalEditSign" type="text" class="form-control" placeholder="Símbolo (Ej: $)" >
                </div>				
				
            </div>
            <div class="modal-footer justify-content-between">
              <button id="closeModalEditBtn" type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fas fa-times"></i> Cancelar </button>
              <button id="modalUpdateCurrency" type="button" class="btn btn-success"> <i class="fas fa-save"></i> Guardar </button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
 
 
   
  
  
<footer class="main-footer"><strong>Burengo &copy; 2020 </footer>
</div>
<!-- ./wrapper -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../dist/js/adminlte.min.js"></script>
<script src="../../plugins/toastr/toastr.min.js"></script>
<script type="text/javascript">
 $( document ).ready(function() {
$('#categoryBody').load('ajax/burengo_currency_lista.php?cd='+$('#getCountryCode').val()); 	   
});


$('#categoryBody').on("click","button.changeStatus",function(){
  var id = $(this).attr("nxid");
  var st = $(this).attr("nxt");
$.getJSON('ajax/burengo_update_stcurrency.php',{
		pid: id,
	 status: st
	},function(data){
		switch(data['ok']){
			case 0: toastr.error('ERROR! No se guardaron los cambios los datos: '+ data['err']); break;
			case 1: $('#categoryBody').load('ajax/burengo_currency_lista.php?cd='+$('#getCountryCode').val()); 	 break;
		}
	});	
});


$('#categoryBody').on("click","button.editarCurrency",function(){
  $('#modalEditCurrencyId').val($(this).attr("catId"));
  $('#modalEditCurrencyCode').val($(this).attr("code"));
  $('#modalEditCurrency').val($(this).attr("str"));
  $('#modalEditSign').val($(this).attr("sign"));
 $('#triggereditCatmodal').click();
});






/* Guardar un nuevo record */
$('#modalSaveCurrency').click(function(){
	$.getJSON('ajax/burengo_insert_currency.php',{
		code: $('#modalCurrencyCode').val(),
		currency: $('#modalCurrency').val(),
		sign: $('#modalSign').val(),
		country: $('#modalCountry').val()
	},function(data){
		switch(data['ok']){
			case 0: toastr.error('ERROR! No se pudo almacenar los datos: '+ data['err']); break;
			case 1: 
				toastr.success('La Moneda fue añadida con exito!'); 
				$('#categoryBody').load('ajax/burengo_currency_lista.php?cd='+$('#getCountryCode').val()); 	
				document.getElementById('closeModalBtn').click();
				$('#modalCurrencyCode').val("");	
				$('#modalCurrency').val("");	
				$('#modalSign').val("");	
				$('#modalCountry').val("");	
			break;
		}
	}); 
});
  
/* Editar Record */  
$('#modalUpdateCurrency').click(function(){
	$.getJSON('ajax/burengo_update_currency.php',{
		id: $('#modalEditCurrencyId').val(),
		code: $('#modalEditCurrencyCode').val(),
		currency: $('#modalEditCurrency').val(),
		sign: $('#modalEditSign').val(),
		country: $('#modalEditCountry').val()
	},function(data){
		switch(data['ok']){
			case 0: toastr.error('ERROR! No se pudo almacenar los datos: '+ data['err']); break;
			case 1: 
				toastr.success('La Moneda fue actualizada con exito!'); 
				$('#categoryBody').load('ajax/burengo_currency_lista.php?cd='+$('#getCountryCode').val()); 	
				document.getElementById('closeModalEditBtn').click();
				$('#modalEditCurrencyId').val("");	
				$('#modalEditCurrencyCode').val("");	
				$('#modalEditCurrency').val("");	
				$('#modalEditSign').val("");	
				$('#modalEditCountry').val("");	
			break;
		}
	}); 
});
  
  

</script>
</body>
</html>
<?php 
function countryName($ct){
	switch($ct){
		case 'ar': return 'Argentina'; break;
		case 'bo': return 'Bolivia'; break;
		case 'br': return 'Brasil'; break;
 		case 'cl': return 'Chile'; break;
 		case 'co': return 'Colombia'; break;
 		case 'cr': return 'Costa Rica'; break;
 		case 'cu': return 'Cuba'; break;
 		case 'do': return 'Dominicana'; break;
 		case 'ec': return 'Ecuador'; break;
 		case 'gt': return 'Guatemala'; break;
 		case 'hn': return 'Honduras'; break;
 		case 'mx': return 'México'; break;
 		case 'ni': return 'Nicaragua'; break;
 		case 'pa': return 'Panamá'; break;
 		case 'py': return 'Paraguay'; break;
 		case 'pe': return 'Perú'; break;
 		case 'pr': return 'Puerto Rico'; break;
 		case 'sv': return 'Salvador'; break;
 		case 'uy': return 'Uruguay'; break;
 		case 've': return 'Venezuela'; break;
		default: return 'Dominicana'; break;
	}

}

?>