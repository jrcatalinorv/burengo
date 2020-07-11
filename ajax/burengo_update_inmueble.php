<?php 
session_start();
require_once "../modelos/conexion.php";

$bgo_code = $_REQUEST["code"];
$bgo_title = $_REQUEST["title"];
$bgo_price = $_REQUEST["price"];
$bgo_lugar = $_REQUEST["lugar"];
$bgo_uom = $_REQUEST["uom"];
$bgo_currency = $_REQUEST["currency"];
$bgo_vtype = $_REQUEST["type"];
$bgo_addr = $_REQUEST["addr"];
$bgo_notes = $_REQUEST["notes"];
$bgo_construccion =  $_REQUEST["construccion"];
$bgo_niveles = $_REQUEST["niveles"];
$bgo_rooms = $_REQUEST["rooms"];
$bgo_bath = $_REQUEST["baths"];
$bgo_parqueos = $_REQUEST["garage"];
$bgo_terreno = $_REQUEST["terreno"];
$bgo_tipolocal = $_REQUEST["type"];
	 
/* Insertar datos en la tabla factura */ 
$stmt = Conexion::conectar()->prepare("UPDATE bgo_posts SET bgo_title = '".$bgo_title."' ,bgo_price = ".$bgo_price ." ,bgo_lugar = ".$bgo_lugar.", bgo_uom = ".$bgo_uom .", bgo_currency = ".$bgo_currency." , bgo_vtype = ".$bgo_vtype." ,bgo_addr = '".$bgo_addr."', bgo_notes = '".$bgo_notes."' , bgo_construccion = '".$bgo_construccion."', bgo_niveles = ".$bgo_niveles." ,bgo_rooms = ".$bgo_rooms." ,bgo_bath = ".$bgo_bath." , bgo_parqueos = ".$bgo_parqueos." , bgo_terreno = '".$bgo_terreno."' , bgo_tipolocal = ".$bgo_tipolocal." WHERE bgo_code = '".$bgo_code."'");
		
if($stmt->execute()){
   $out['ok'] = 1;
   $out['ccdt'] = $bgo_code;
}else{
  $out['ok']  = 0;
  $out['err'] = $stmt->errorInfo();
}
echo json_encode($out); 
?>