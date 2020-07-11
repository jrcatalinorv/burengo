<?php 
require_once "../modelos/conexion.php";
require_once "../modelos/data.php";
$id = $_REQUEST["id"];
 
$stmt8 = Conexion::conectar()->prepare("SELECT w.*, p.* FROM bgo_whishlist w 
INNER JOIN bgo_posts p ON  w.FAVPID = p.bgo_code AND w.FAVUID = '".$id."'");
$stmt8 -> execute();
while( $resulta8 = $stmt8 -> fetch()){
		
echo '<div class="user-block col-md-12 p-2 border-top" >
     <img class="img-circle img-bordered-sm itemSelection" itemId="'.$resulta8["FAVPID"].'" stid="'.$resulta8["bgo_subcat"].'" src="media/thumbnails/'.$resulta8["bgo_thumbnail"].'" alt="User Image">
          <span class="username">
            <a href="#" class="text-muted itemSelection" itemId="'.$resulta8["FAVPID"].'" stid="'.$resulta8["bgo_subcat"].'" >'.$resulta8["FAVPN"].'</a>
            <a href="#" class="float-right btn-tool itemDelete" userId="'.$resulta8["FAVUID"].'" itemId="'.$resulta8["FAVPID"].'"><i class="fas fa-trash-alt text-danger"></i></a>
          </span>
       <span class="description itemSelection" itemId="'.$resulta8["FAVPID"].'" stid="'.$resulta8["bgo_subcat"].'"  >  '.burengo_seePost2.'  </span>
    </div>';
}	
?>	