<?php 
date_default_timezone_set("America/Santo_Domingo");
require_once "../modelos/conexion.php";
require_once "../modelos/data.php";

$uid = $_REQUEST["acc"];

$stmt = Conexion::conectar()->prepare("SELECT * FROM bgo_cpinfo WHERE cpcode = 'bgo'");
$stmt -> execute();
$results = $stmt -> fetch();
$paypalCode = $results["paypal_code"];

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
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
 <nav class="main-header navbar navbar-expand-md navbar-dark bg-navy"> 
    <div class="container">
      <a href="" class="navbar-brand"> <img src="../dist/img/burengo.png" alt="Burengo Logo" class="brand-image   elevation-0" style="opacity: .8"> </a>
      <div class="collapse navbar-collapse order-3" id="navbarCollapse"><ul class="navbar-nav"> </ul></div>
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto"> </ul>
    </div>
  </nav>
  <!-- /.navbar -->

  <div class="content-wrapper">
	<div class="content">
 <input id="getCode" type="hidden" value="<?php echo $uid; ?>">
 <input id="getPlan" type="hidden" value="0">
	  <div class="row pt-2">
	        <div class="col-md-12">
            <div class="card card-primary">
        <div class="card-body pb-0 ">
			<div class="row panList"> </div>
		</div>
     </div>
   </div>
</div>	  	  
</div>
  </div>
   <div id="triggerPM" data-toggle="modal" data-target="#modal-pm"></div>
<div class="modal fade" id="modal-pm">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"> <?php echo burengo_paymentMode; ?> </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
				<input type="hidden" id="mdlPlanValue"  />
				 <br/>
				<div id="paypal-button-container" class="row pp"></div>
				 <br/>
            </div>
          
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
<footer class="main-footer"> Burengo &copy; 2020 - <?php echo burengo_copyright; ?> </footer>
<script src="https://www.paypal.com/sdk/js?client-id=<?php echo $paypalCode; ?>"></script>
 <script>
  paypal.Buttons({
    createOrder: function(data, actions) {
      // This function sets up the details of the transaction, including the amount and line item details.
      return actions.order.create({
        purchase_units: [{
          amount: {
            value: $('#mdlPlanValue').val()
          }
        }]
      });
    },
    onApprove: function(data, actions) {
      // This function captures the funds from the transaction.
      return actions.order.capture().then(function(details) {
        	var idPlan = $('#getPlan').val();
			location.href="confirmation.php?p="+idPlan+"&acc="+$('#getCode').val();
		// This function shows a transaction success message to your buyer.
        //alert('Transaction completed by ' + details.payer.name.given_name);
      });
    }
  }).render('#paypal-button-container');
  //This function displays Smart Payment Buttons on your web page.
</script>
</div>
<script src="../plugins/jquery/jquery.min.js"></script>
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../dist/js/adminlte.min.js"></script>
<script src="../plugins/toastr/toastr.min.js"></script>
<script type="text/javascript">
$('.panList').load("../ajax/planes_disponibles.php");
$('.panList').on("click", "a.planselection", function(){
	var idPlan = $(this).attr('idPlan');
	var code = $('#getCode').val();
    var price  =  parseFloat($(this).attr('pricePlan'));
	if(price == 0 ){
		 $('#getPlan').val(idPlan);
		 location.href="confirmation.php?p="+idPlan+"&acc="+code;
	}else{
		$('#getPlan').val(idPlan);
		$('#mdlPlanValue').val(price);
		$('#triggerPM').click();
	}
});
</script>
</body>
</html>
