<?php
require_once "../../modelos/conexion.php";

if($_FILES["file"]["name"] != '')
{
 $test = explode('.', $_FILES["file"]["name"]);
 $code = $_POST['code'];
 
 $ext = strtolower (end($test));
 $name = $code.'.'. $ext;
 //$name = rand(100, 999) . '.' . $ext;
 $location = '../../media/thumbnails/' . $name;  
 
 
 move_uploaded_file($_FILES["file"]["tmp_name"],$location);
 
 
$stmt = Conexion::conectar()->prepare("UPDATE bgo_posts SET bgo_thumbnail = '".$name."' 
WHERE bgo_code = '".$code."'");
	
 if($stmt->execute()){
    echo '<img src="../../'.$location.'" height="250" width="300" class="img-thumbnail" />';
}else{
  //$out['ok']  = 0;
  //$out['err'] = $stmt->errorInfo();
}
 

}




 
	function compress($source, $destination, $quality) {

		$info = getimagesize($source);

		if ($info['mime'] == 'image/jpeg') 
			$image = imagecreatefromjpeg($source);

		elseif ($info['mime'] == 'image/gif') 
			$image = imagecreatefromgif($source);

		elseif ($info['mime'] == 'image/png') 
			$image = imagecreatefrompng($source);

		imagejpeg($image, $destination, $quality);

		return $destination;
	}

	//$source_img = 'source.jpg';
	//$destination_img = 'destination .jpg';

	
 

?>