<?php 
require_once "../modelos/conexion.php";
$id = $_REQUEST["pid"];
$src = '../media/images/'.$id.'/';

$stmt = Conexion::conectar()->prepare("DELETE FROM bgo_posts WHERE bgo_code = '".$id."'");
 if($stmt->execute()){
	 
   $dir = opendir($src);
    
	while(false !== ( $file = readdir($dir)) ) {
        if (( $file != '.' ) && ( $file != '..' )) {
            $full = $src . '/' . $file;
            if ( is_dir($full) ) {
                rrmdir($full);
            }
            else {
                unlink($full);
            }
        }
    }
    closedir($dir);
    rmdir($src);
	$out['ok']  = 1;
 }else{
	$out['ok']  = 0;
   $out['err'] = $stmt->errorInfo();
 }
echo json_encode($out); 
?>