<?php
require_once "../../modelos/conexion.php";

$code = $_POST['code'];
$total = count($_FILES["myFiles"]["name"]);
$extraPics = [];

// Loop through each file
for( $i=0 ; $i < $total ; $i++ ) {

  //Get the temp file path
   $test = explode('.', $_FILES['myFiles']['name'][$i]);
   $ext = strtolower (end($test));
   $name = $code.'-'.$i.'.'. $ext;
   
   
   $tmpFilePath = $_FILES['myFiles']['tmp_name'][$i];

  //Make sure we have a file path
  if ($tmpFilePath != ""){
    //Setup our new file path
    $newFilePath = "../../media/images/".$code."/" . $name; 

    //Upload the file into the temp dir
    if(move_uploaded_file($tmpFilePath, $newFilePath)) {
		
		 array_push($extraPics,$name);
		 echo '<img src="../../'.$newFilePath.'" height="125" width="150" class="img-thumbnail" />';
		
		if($i==($total-1)){	
			$text = json_encode($extraPics);	
		    
			$stmt = Conexion::conectar()->prepare("UPDATE bgo_posts SET bgo_comp_img = ".$total.", bgo_extrapics = '".$text."' WHERE bgo_code = '".$code."'");
			if($stmt->execute()){
				
			}		
		}
   }
  }
}

 

?>