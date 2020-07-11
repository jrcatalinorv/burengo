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
$bgo_anio_construccion = 0; 
/*------------------------------------------*/
$bgo_destacado = $_REQUEST["destacado"];
$bgo_status = 0; 
	 
/* Insertar datos en la tabla factura */ 
$stmt = Conexion::conectar()->prepare("INSERT INTO bgo_posts (bgo_code,bgo_txdate,bgo_txtime,bgo_usercode,bgo_cat,bgo_subcat,bgo_title,bgo_price,bgo_lugar,bgo_uom,bgo_duedate,bgo_currency,bgo_vtype,bgo_addr,bgo_notes,bgo_construccion,bgo_niveles,bgo_rooms,bgo_bath,bgo_parqueos,bgo_terreno,bgo_tipolocal,bgo_anio_construccion,bgo_country_code,bgo_stdesc,bgo_status) VALUES (:bgo_code,:bgo_txdate,:bgo_txtime,:bgo_usercode,:bgo_cat,:bgo_subcat,:bgo_title,:bgo_price,:bgo_lugar,:bgo_uom,:bgo_duedate,:bgo_currency,:bgo_vtype,:bgo_addr,:bgo_notes,:bgo_construccion,:bgo_niveles,:bgo_rooms,:bgo_bath,:bgo_parqueos,:bgo_terreno,:bgo_tipolocal,:bgo_anio_construccion,:bgo_country_code,:bgo_stdesc,:bgo_status)");
		
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
$stmt->bindParam(":bgo_currency",$bgo_currency, PDO::PARAM_STR);
$stmt->bindParam(":bgo_vtype",$bgo_vtype, PDO::PARAM_INT);
$stmt->bindParam(":bgo_addr",$bgo_addr, PDO::PARAM_STR);
$stmt->bindParam(":bgo_notes",$bgo_notes, PDO::PARAM_STR);
$stmt->bindParam(":bgo_construccion",$bgo_construccion, PDO::PARAM_STR);
$stmt->bindParam(":bgo_niveles",$bgo_niveles, PDO::PARAM_INT);
$stmt->bindParam(":bgo_rooms",$bgo_rooms, PDO::PARAM_INT);
$stmt->bindParam(":bgo_bath",$bgo_bath, PDO::PARAM_INT);
$stmt->bindParam(":bgo_parqueos",$bgo_parqueos, PDO::PARAM_INT);
$stmt->bindParam(":bgo_terreno",$bgo_terreno, PDO::PARAM_STR);
$stmt->bindParam(":bgo_tipolocal",$bgo_tipolocal, PDO::PARAM_INT);
$stmt->bindParam(":bgo_anio_construccion",$bgo_anio_construccion, PDO::PARAM_INT);
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