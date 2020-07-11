<?php 
require_once "../../modelos/conexion.php";
require_once "../../modelos/functions.php";



 
$stmt = Conexion::conectar()->prepare("SELECT * FROM bgo_planes WHERE planstatus = 1");
$stmt -> execute();

 
while($results = $stmt -> fetch())
{ 

if($results["plantypo"]==1){
echo '
 <div class="col-md-3">
            <div class="card card-primary card-outline choice" pn="'.$results["planid"].'"  nm ="'.$results["planname"].'" pr="'.$results["planprice"].'"  dr="'.$results["planduration"].'" >
              <div class="card-body box-profile">
              
				<h3 class="profile-username text-center"> '.$results["planname"].' </h3>
				
				<br/>
                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Precio </b> <a class="float-right">$'.number_format($results["planprice"],2).' '.$results["plancurrency"].' </a>
                  </li>
                  <li class="list-group-item">
                    <b>Duración </b> <a class="float-right">'.$results["planduration"].' Días </a>
                  </li>
                  <li class="list-group-item">
                    <b>Publicaciones </b> <a class="float-right"> ';
						if($results["planmaxp"]==99999){
							echo "Ilimitadas";
						}else{
						  echo $results["planmaxp"];	 	
						}
						echo ' </a>
                  </li>                  
				  <li class="list-group-item">
                    <b>Fotos </b> <a class="float-right"> '.$results["planmaxf"].' </a>
                  </li>
                </ul>

              </div>
            </div>      
          </div>
 ';	
}else{
 echo '
 <div class="col-md-3">
            <div class="card card-success card-outline choice" pn="'.$results["planid"].'"  nm ="'.$results["planname"].'" pr="'.$results["planprice"].'"  dr="'.$results["planduration"].'" >
              <div class="card-body box-profile">
              
				<h3 class="profile-username text-center"> '.$results["planname"].' </h3>
				
				<br/>
                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Precio </b> <a class="float-right">$'.number_format($results["planprice"],2).' '.$results["plancurrency"].' </a>
                  </li>
                  <li class="list-group-item">
                    <b>Duración </b> <a class="float-right">'.$results["planduration"].' Días</a>
                  </li>
                  <li class="list-group-item">
                    <b>Publicaciones </b> <a class="float-right"> ';
						if($results["planmaxp"]==99999){
							echo "Ilimitadas";
						}else{
						  echo $results["planmaxp"];	 	
						}
						echo ' </a>
                  </li>                  
				  <li class="list-group-item">
                    <b>Fotos </b> <a class="float-right"> '.$results["planmaxf"].' </a>
                  </li>
                </ul>

              </div>
            </div>      
          </div>
 ';	
	
}


}	 
 
?>

 