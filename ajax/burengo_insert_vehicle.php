<?php 
session_start();
require_once "../modelos/conexion.php";

$bgo_code = $_REQUEST["code"];
$bgo_txdate = date('Y-m-d'); 
$bgo_txtime = date('H:i:s');
$bgo_usercode = $_REQUEST["usercode"];
$bgo_cat = $_REQUEST["cat"];
$bgo_subcat = $_REQUEST["subcat"];
$bgo_title = $_REQUEST["title"];
$bgo_price = $_REQUEST["price"];
$bgo_lugar = $_REQUEST["lugar"];
$bgo_uom = $_REQUEST["uom"];
$bgo_duedate = date('Y-m-d', strtotime($bgo_txdate. ' + 30 days'));
$bgo_marca = $_REQUEST["marca"];
$bgo_modelo = $_REQUEST["modelo"];
$bgo_year = $_REQUEST["year"];
$bgo_condicion = $_REQUEST["condicion"];
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
$bgo_accesories = $_REQUEST["accesories"];
$bgo_notes = $_REQUEST["notes"];
/*------------------------------------------*/
$bgo_destacado = $_REQUEST["destacado"];
$bgo_status = 0; 

/* Insertar datos en la tabla factura */ 
$stmt = Conexion::conectar()->prepare("INSERT INTO bgo_posts (bgo_code,bgo_txdate,bgo_txtime,bgo_usercode,
bgo_cat,bgo_subcat,bgo_title,bgo_price,bgo_lugar,bgo_uom,bgo_duedate,bgo_marca,bgo_modelo,bgo_year,
bgo_condicion,bgo_currency,bgo_fuel,bgo_vtype,bgo_transmision,bgo_traccion,bgo_color,bgo_color_interior,
bgo_puertas_cantidad,bgo_pasajeros_cantidad,bgo_addr,bgo_accesories,bgo_notes,bgo_country_code,bgo_stdesc,bgo_status) 
VALUES (:bgo_code,:bgo_txdate,:bgo_txtime,:bgo_usercode,:bgo_cat,:bgo_subcat,:bgo_title,:bgo_price,
		:bgo_lugar,:bgo_uom,:bgo_duedate,:bgo_marca,:bgo_modelo,:bgo_year,:bgo_condicion,:bgo_currency,
		:bgo_fuel,:bgo_vtype,:bgo_transmision,:bgo_traccion,:bgo_color,:bgo_color_interior,:bgo_puertas_cantidad,
		:bgo_pasajeros_cantidad,:bgo_addr,:bgo_accesories,:bgo_notes,
		:bgo_country_code,:bgo_stdesc,:bgo_status)");
		 
$stmt->bindParam(":bgo_code",$bgo_code, PDO::PARAM_STR);
$stmt->bindParam(":bgo_txdate",$bgo_txdate, PDO::PARAM_STR);
$stmt->bindParam(":bgo_txtime",$bgo_txtime, PDO::PARAM_STR);
$stmt->bindParam(":bgo_usercode",$bgo_usercode, PDO::PARAM_STR);
$stmt->bindParam(":bgo_cat",$bgo_cat, PDO::PARAM_STR);
$stmt->bindParam(":bgo_subcat",$bgo_subcat, PDO::PARAM_STR);
$stmt->bindParam(":bgo_title",$bgo_title, PDO::PARAM_STR);
$stmt->bindParam(":bgo_price",$bgo_price, PDO::PARAM_STR);
$stmt->bindParam(":bgo_lugar",$bgo_lugar, PDO::PARAM_STR);
$stmt->bindParam(":bgo_uom",$bgo_uom, PDO::PARAM_STR);
$stmt->bindParam(":bgo_duedate",$bgo_duedate, PDO::PARAM_STR);
$stmt->bindParam(":bgo_marca",$bgo_marca, PDO::PARAM_STR);
$stmt->bindParam(":bgo_modelo",$bgo_modelo, PDO::PARAM_STR);
$stmt->bindParam(":bgo_year",$bgo_year, PDO::PARAM_STR);
$stmt->bindParam(":bgo_condicion",$bgo_condicion, PDO::PARAM_STR);
$stmt->bindParam(":bgo_currency",$bgo_currency, PDO::PARAM_STR);
$stmt->bindParam(":bgo_fuel",$bgo_fuel, PDO::PARAM_STR);
$stmt->bindParam(":bgo_vtype",$bgo_vtype, PDO::PARAM_INT);
$stmt->bindParam(":bgo_transmision",$bgo_transmision, PDO::PARAM_STR);
$stmt->bindParam(":bgo_traccion",$bgo_traccion, PDO::PARAM_STR);
$stmt->bindParam(":bgo_color",$bgo_color, PDO::PARAM_STR);
$stmt->bindParam(":bgo_color_interior",$bgo_color_interior, PDO::PARAM_STR);
$stmt->bindParam(":bgo_puertas_cantidad",$bgo_puertas_cantidad, PDO::PARAM_INT);
$stmt->bindParam(":bgo_pasajeros_cantidad",$bgo_pasajeros_cantidad, PDO::PARAM_INT);
$stmt->bindParam(":bgo_addr",$bgo_addr, PDO::PARAM_STR);
$stmt->bindParam(":bgo_accesories",$bgo_accesories, PDO::PARAM_STR);
$stmt->bindParam(":bgo_notes",$bgo_notes, PDO::PARAM_STR);
$stmt->bindParam(":bgo_country_code",$_SESSION['bgo_ccode'], PDO::PARAM_STR);
$stmt->bindParam(":bgo_stdesc",$bgo_destacado, PDO::PARAM_INT);
$stmt->bindParam(":bgo_status",$bgo_status, PDO::PARAM_INT);
 
if($stmt->execute()){
   $out['ok'] = 1;
   $out['ccdt'] = $bgo_code;
}else{
  $out['ok']  = 0;
  $out['err'] = $stmt->errorInfo();
}
echo json_encode($out); 
?>