<?php 
session_start();
date_default_timezone_set("America/Santo_Domingo");
require_once "modelos/conexion.php";
require_once "modelos/data.php";

if(isset($_SESSION['bgo_userId'])){   
}else{
  header('Location: acceder.php'); 
} 

 
$fsDt = date("Y-m-d", strtotime("first day of this month")); 
$lsDt = date("Y-m-d", strtotime("last day of this month")); 
 
 

 
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
  .bgo_top{
	 
  }
@media only screen and (max-width: 600px) {
.bgo_top{
	margin-top: 2rem; 
  }
	
}  
</style>
  
</head>
<body class="hold-transition layout-top-nav layout-navbar-fixed">
<div class="wrapper">

  <!-- Navbar -->
 <nav class="main-header navbar navbar-expand-md navbar-dark bg-navy"> 
    <div class="container">
      <a href="../inicio.php" class="navbar-brand">
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

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
		  <input id="currentCode" class="form-control" type="hidden" value="<?php  echo $_SESSION['bgo_userId']; ?>"/>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
 <section class="content">
      <div class="container-fluid">
        <div class="row">
		
				<div class="col-md-3">
        

          <div class="card">
            <div class="card-header">
           

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-0">
              <ul class="nav nav-pills flex-column">
                <li class="nav-item bg-primary">
                  <a href="inbox.php" class="nav-link">
                    <i class="fas fa-inbox"></i> <?php echo burengo_msgReceived; ?>
                   
                  </a>
                </li>
                <li class="nav-item">
                  <a href="outbox.php" class="nav-link">
                    <i class="far fa-envelope"></i> <?php echo burengo_msgSent; ?>
                  </a>
                </li>
				<li> &nbsp;
				</li>
              </ul>
            </div>
            <!-- /.card-body -->
          </div>
 
          <!-- /.card -->
        </div>
		
 <div class="col-md-9">
 
 
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title"> Mensajes Recibidos  </h3>

             
              <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
       
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                  <tbody class="mmssg">
                  <?php 
						$stmt0 = Conexion::conectar()->prepare("SELECT count(msgid) as totalMsg FROM  bgo_msg WHERE usrto = '".$_SESSION['bgo_userId']."'");
						$stmt0 -> execute();
						$rest0 = $stmt0 -> fetch();
						
						if($rest0['totalMsg'] <= 0){
							echo ' <tr>
                    <td class="mailbox-name text-center"> -- No tiene Mensajes - </td>   </tr>';
						}else{
							
					$stmt = Conexion::conectar()->prepare("SELECT m.*, u.*, p.* FROM bgo_msg m 
						INNER JOIN bgo_users u ON  m.usrfrom = u.uid 
						INNER JOIN bgo_posts p ON  m.msgpost = p.bgo_code 
						AND m.usrto = '".$_SESSION['bgo_userId']."'"); 
					$stmt -> execute();
					while($rest = $stmt -> fetch()){
						
				echo ' <tr class="choosMe" msId="'.$rest['msgid'].'"  msTx="'.$rest['msgtext'].'"  msFrom="'.$rest['name'].'" 
				msTel="'.$rest['phone'].'" msEmail="'.$rest['email'].'" msFromCode="'.$rest['uid'].'" msPost="'.$rest['msgpost'].'" 
				 msPosNm="'.$rest['bgo_title'].'" >
                    <td class="mailbox-name"> '.$rest['timestamp'].' </td>
                    <td class="mailbox-name text-primary">'.$rest['name'].'</td>
                    <td class="mailbox-subject"> '.$rest['msgtext'].'</td>
                    <td class="mailbox-date"> '.$rest['bgo_title'].' </td>
                  </tr>';
				  
				}
		}
			 
  ?>
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer p-0">
        
            </div>
          </div>
          <!-- /.card -->
        </div>    
       
        </div>
      </div><!-- /.container-fluid -->
    </section>
  </div>
 
<div id="triggerBtnModalmodal" data-toggle="modal" data-target="#modal-msg"></div>

 
  <div class="modal fade" id="modal-msg">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title text-info"> <i class="fas fa-envelope"></i> <?php echo burengo_usrMsgSend; ?> </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
				<div class="row">
				  <div class="callout callout-info">
					<h5 id="mdlTitle"> </h5>
					<p id="mdlpostN">  </p>
					<p id="mdlBody"> </p>
					<hr/>
					<strong id="mdlTel">    </strong>
					<strong id="mdlMail">  </strong>
				   </div>
					 <input id="mdlFrom" class="form-control" type="hidden" value="<?php  echo $_SESSION['bgo_userId']; ?>" />
					 <input id="mdlTo"   class="form-control" type="hidden" />
					 <input id="mdlEm"   class="form-control" type="hidden" />
					 <input id="mdlPst"  class="form-control" type="hidden" />
					 <input id="mdlRply"  class="form-control" type="hidden" />
				 </div>
				<div class="form-group">
                        <label> <?php echo burengo_answer; ?> </label>
                        <textarea id="mcomment" class="form-control" rows="3" placeholder="Escribir comentario"></textarea>
                      </div>
          </div>
		  	<div class="modal-footer justify-content-between">
              <button id="btnCloseModal" type="button" class="btn btn-danger" data-dismiss="modal"> <?php echo burengo_cancel; ?> </button>
              <button id="sendMsgConfirm" type="button" class="btn btn-success"> <i class="fab fa-telegram-plane"></i> <?php echo burengo_send; ?> </button>
            </div>
        </div>
</div>
</div>

<div class="modal fade" id="modal-favorites">
 <div class="modal-dialog">
   <div class="modal-content">
      <div class="modal-header">
       <h4 class="modal-title">   </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
<div class="modal-body p-0 whlist" style="height:400px;   overflow-y: auto; overflow-x: hidden;"> 
<!----------------------------------->
		
<!----------------------------------->
</div>
   </div>
    </div>
      </div>
   <!-- /.modal -->



  <!-- /.content-wrapper -->
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
<script src="<?php echo burengoBaseUrl; ?>plugins/jquery/jquery.min.js"></script>
<script src="<?php echo burengoBaseUrl; ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo burengoBaseUrl; ?>dist/js/adminlte.min.js"></script>
<script src="<?php echo burengoBaseUrl; ?>plugins/toastr/toastr.min.js"></script>
<script type="text/javascript">
 $('.mmssg').on("click","tr.choosMe", function(){
	 //-------------------------------------
	 var id = $(this).attr("msId");
	 var nm = '<i class="fas fa-user"></i> '+$(this).attr("msFrom");
	 var bd = $(this).attr("msTx");
	 var mail = $(this).attr("msEmail");
	 var phone = '<i class="fas fa-phone mr-1"></i> '+$(this).attr("msTel");
	 var pname = '<small>'+$(this).attr("msPosNm")+'</small>';
	 //-------------------------------------	 
	 $('#mdlTitle').html(nm);
	 $('#mdlpostN').html(pname);
	 $('#mdlBody').html(bd);
	 $('#mdlTel').html(phone);
	 $('#mdlMail').html('<i class="fas fa-envelope mr-1"></i> '+mail);

	 //-------------------------------------
	 $('#mdlEm').val(mail);
	 $('#mdlTo').val($(this).attr("msFromCode"));
	 $('#mdlPst').val($(this).attr("msPost"));
	 $('#mdlRply').val(id);
	 //-------------------------------------
	 $('#triggerBtnModalmodal').click();
	 //-------------------------------------
 });
 
 
$('#sendMsgConfirm').click(function(){
if( !isEmpty($('#mcomment').val() ) ){
	$.getJSON('<?php echo burengoBaseUrl; ?>ajax/burengo_send_message.php',{			  	 
			from: $('#mdlFrom').val(),	    	 
			to: $('#mdlTo').val(), 	 
			email: $('#mdlEm').val(),	 
			msg: $('#mcomment').val(),	 
			post: $('#mdlPst').val(), 	 
			reply: $('#mdlRply').val() 	 
	},function(data){
	   switch(data['ok'])
		{
			case 0: toastr.error('ERROR! No se pudo almacenar los datos: '+ data['err']); break;
			case 1: toastr.success('El mensaje fue enviado de forma correcta'); $('#btnCloseModal').click();  break;		
		 }
	});
  }else{
		toastr.error('Debe completar el campo mensaje.');
	}
});
 
 function isEmpty(str) {
    return (!str || 0 === str.length);
}



$('.whlist').load("<?php echo burengoBaseUrl; ?>ajax/burengo_select_favorites.php?id="+$('#currentCode').val());



$('.whlist').on("click","span.itemSelection",function(){
	var id = $(this).attr('itemId');
	var cat = $(this).attr('stid');
	switch(cat){
		case '1': location.href="vehiculos.php?dtcd="+id; break;
		case '2': location.href="inmuebles.php?dtcd="+id; break;
	}
});


$('.whlist').on("click","img.itemSelection",function(){
	var id = $(this).attr('itemId');
	var cat = $(this).attr('stid');
	switch(cat){
		case '1': location.href="vehiculos.php?dtcd="+id; break;
		case '2': location.href="inmuebles.php?dtcd="+id; break;
	}
});

$('.whlist').on("click","a.itemSelection",function(){
	var id = $(this).attr('itemId');
	var cat = $(this).attr('stid');
	switch(cat){
		case '1': location.href="vehiculos.php?dtcd="+id; break;
		case '2': location.href="inmuebles.php?dtcd="+id; break;
	}
});


$('.whlist').on("click","a.itemDelete",function(){
   var pid = $(this).attr('itemId');
   var uid = $(this).attr('userId');
   
   $.getJSON('<?php echo burengoBaseUrl; ?>ajax/burengo_delete_fav.php',{
		pid: pid,
		uid: uid
	},function(data){
		switch(data['ok']){
			case 0: toastr.error('ERROR! No se guardaron los cambios los datos: '+ data['err']); break;
			case 1: $('.whlist').load("<?php echo burengoBaseUrl; ?>ajax/burengo_select_favorites.php?id="+uid);  break;
		}
	});	
 
});


</script>
</body>
</html>