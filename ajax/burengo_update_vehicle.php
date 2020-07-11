<?php 
session_start();
require_once "../modelos/conexion.php";

$bgo_code = $_REQUEST["code"];
$bgo_title = $_REQUEST["title"];
$bgo_price = $_REQUEST["price"];
$bgo_lugar = $_REQUEST["lugar"];
$bgo_uom = $_REQUEST["uom"];
$bgo_condicion = $_REQUEST["condition"];
$bgo_marca = $_REQUEST["marca"];
$bgo_modelo = $_REQUEST["modelo"];
$bgo_year = $_REQUEST["year"];
$bgo_currency = $_REQUEST["currency"];
$bgo_fuel = $_REQUEST["fuel"];
$bgo_vtype = $_REQUEST["vtype"];
$bgo_transmision = $_REQUEST["transmision"];
$bgo_traccion = $_REQUEST["traccion"];
$bgo_color = $_REQUEST["color"];
$bgo_color_interior = $_REQUEST["color_interior"];
$bgo_puertas_cantidad = $_REQUEST["puertas_cantidad"];
$bgo_pasajeros_cantidad = $_REQUEST["pasajeros_cantidad"];
$bgo_addr = $_REQUEST["addr"];
$bgo_notes = $_REQUEST["notes"];


$stmt = Conexion::conectar()->prepare("UPDATE bgo_posts SET bgo_title ='".$bgo_title."' , bgo_price =".$bgo_price." ,
 bgo_lugar = ".$bgo_lugar." , bgo_uom = ".$bgo_uom." , bgo_condicion = '".$bgo_condicion."' , bgo_marca = ".$bgo_marca." , bgo_modelo = ".$bgo_modelo." ,
 bgo_year = ".$bgo_year." , bgo_currency = ".$bgo_currency.", bgo_fuel = ".$bgo_fuel." , bgo_vtype =".$bgo_vtype." ,
 bgo_transmision = ".$bgo_transmision.", bgo_traccion = ".$bgo_traccion." , bgo_color = ".$bgo_color." , bgo_color_interior = ".$bgo_color_interior.",
 bgo_puertas_cantidad = ".$bgo_puertas_cantidad." , bgo_pasajeros_cantidad = ".$bgo_pasajeros_cantidad.",
 bgo_addr ='".$bgo_addr."' ,bgo_notes ='".$_REQUEST["notes"]."' WHERE bgo_code = '".$bgo_code."'");
		 
if($stmt->execute()){
   $out['ok'] = 1;
}else{
  $out['ok']  = 0;
  $out['err'] = $stmt->errorInfo();
}
echo json_encode($out); 
?>