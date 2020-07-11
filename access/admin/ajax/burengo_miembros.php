<?php 
require_once "../../modelos/conexion.php";
require_once "../../modelos/functions.php";

$tp = $_REQUEST["tp"];
$cp = $_REQUEST["cp"];
$vp = $_REQUEST["vp"];


if($cp>=1){ $tt = " AND u.profile = ".$cp; }else{ $tt = ""; }
if($vp>=1){ $tx = " AND u.provinvia = ".$vp; }else{ $tx = ""; }



if(	$tp=='ar' || $tp=='bo' || $tp=='br' || $tp=='cl' || $tp=='co' || $tp=='cr' || $tp=='cu' || $tp=='do' || 
	$tp=='ec' || $tp=='gt' || $tp=='hn' || $tp=='mx' || $tp=='ni' || $tp=='pa' || $tp=='pe' || $tp=='pr' ||
	$tp=='py' || $tp=='sv' || $tp=='uy' || $tp=='ve'){
	
	$stmt = Conexion::conectar()->prepare("SELECT u.*, p.*, c.* FROM bgo_users u
										    INNER JOIN bgo_planes p ON u.profile = p.planid 
											INNER JOIN bgo_country c ON u.bgo_country = c.cyid
											AND u.bgo_country ='".$tp."' ".$tt." ".$tx);											
}else{
	
	$stmt = Conexion::conectar()->prepare("SELECT u.*, p.*, c.* FROM bgo_users u
										    INNER JOIN bgo_planes p ON u.profile = p.planid 
											INNER JOIN bgo_country c ON u.bgo_country = c.cyid
											AND u.profile <= 98 ".$tt." ".$tx);
}
 
$stmt -> execute();
while($results = $stmt -> fetch())
{ 

$ct = $results['bgo_country'];

 echo '
 <div class="col-md-3">
            <div class="card usrProfile" uid="'.$results['uid'].'">
              <div class="card-body box-profile">
               <div class="text-center">
                  <img style="width:100px; height: 100px;" class="profile-user-img img-fluid img-circle" src="../../media/users/'.$results["img"].'" alt="User profile picture">
                </div>
				<h3 class="profile-username text-center">'.$results["name"].' </h3>
				<p class="text-muted text-center"> '.$results["cystr"].' <br/> '.$results["planname"].' </p>
          </div>
      </div>      
  </div>';
}
?>

 