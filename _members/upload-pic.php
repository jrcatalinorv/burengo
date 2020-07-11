<?php
session_start();
require_once "../modelos/conexion.php";

if($_FILES["file"]["name"] != '')
{
 $test = explode('.', $_FILES["file"]["name"]);
 $code = $_POST['code'];
 
 $ext = strtolower (end($test));
 $name = $code.'.'. $ext;
  
 $location = '../media/users/' . $name;  
 move_uploaded_file($_FILES["file"]["tmp_name"],$location);
 
 
$stmt = Conexion::conectar()->prepare("UPDATE bgo_users SET img = '". $name."' WHERE uid = '".$code."'");
if($stmt->execute()){
	$_SESSION['bgo_userImg'] = $name;
	echo '<img class="profile-user-img img-fluid img-circle" src="../media/users/'.$name.'" alt="User profile picture">';
}else{
  //$out['ok']  = 0;
  //$out['err'] = $stmt->errorInfo();
}
}
?>