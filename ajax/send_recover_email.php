<?php 
require_once "../modelos/conexion.php";
require_once "../modelos/data.php";
require "../../plugins/PHPMailer/src/Exception.php";
require "../../plugins/PHPMailer/src/PHPMailer.php";
require "../../plugins/PHPMailer/src/SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$email  = $_REQUEST["email"];
$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

/* Buscar el usuario si existe */
$stmt2 = Conexion::conectar()->prepare("SELECT * FROM bgo_users WHERE email ='".$email."' AND bgo_country ='".COUNTRY_CODE."'");
$stmt2 -> execute();
if($results = $stmt2 -> fetch()){	

$first = substr(str_shuffle($permitted_chars), 0, 75);
$second = $results['uid'] ;
$third = substr(str_shuffle($permitted_chars), 0, 35);
 
$stmt = Conexion::conectar()->prepare("SELECT * FROM bgo_mail_server WHERE site_code = 'bgo'");
$stmt -> execute(); 
$rslt = $stmt -> fetch(); 

// create instance phpmailer
$mail = new PHPMailer();
$mail->isSMTP();
$mail->Host = $rslt["mail_host"];
$mail->Port = $rslt["mail_port"];
$mail->SMTPAuth = "true";
$mail->Username = $rslt["mail_user"];
$mail->Password = $rslt["mail_pass"]; 
$mail->SMTPSecure = "tls";
$mail->CharSet = "UTF-8";
$mail->isHTML(true);

$mail->setFrom("info@burengo.com");
$mail->Subject = burengo_mailSubject;
$mail-> Body =  "<center>"
				."\n\n"
				."<h3> ".burengo_mailboddy." </h3>"
				."https://burengo.com/".COUNTRY_CODE."/confirmation/recuperar-cuenta.php?ft=".$first."&th=".$third."&sd=".$second.""
				."</center>\n"
				."\n"
				."\n";
$mail->addAddress($email);

if($mail->Send()){
	 	$out['ok'] = 1;
}else{
	 	$out['ok'] = 2;
}

$mail->smtpClose();
}else{
	$out['ok'] = 3;
	$out['err'] = $stmt->errorInfo();
}
echo json_encode($out); 
?>