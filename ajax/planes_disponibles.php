<?php 
require_once "../modelos/conexion.php";
require_once "../modelos/functions.php";
require_once "../modelos/data.php";

 
$stmt = Conexion::conectar()->prepare("SELECT * FROM bgo_planes WHERE planstatus = 1");
$stmt -> execute();

 
while($results = $stmt -> fetch())
{ 
if($results["plantypo"]==1){
 echo '
 <div class="col-md-3">
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
               
				<h3 class="profile-username text-center"> '.$results["planname"].' </h3>
				
				<br/>
                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b> '.burengo_price.' </b> <a class="float-right">$'.number_format($results["planprice"],2).' '.$results["plancurrency"].' </a>
                  </li>
                  <li class="list-group-item">
                    <b> '.burengo_duration.' </b> <a class="float-right">'.$results["planduration"].' '.burengo_days.'</a>
                  </li>
                  <li class="list-group-item">
                    <b> '.burengo_maxp2.' </b> <a class="float-right"> ';
						if($results["planmaxp"]==99999){
							echo "Ilimitadas";
						}else{
						  echo $results["planmaxp"];	 	
						}
						echo ' </a>
                  </li>                  
				  <li class="list-group-item">
                    <b> '.burengo_maxf2.' </b> <a class="float-right"> '.$results["planmaxf"].' </a>
                  </li>
                </ul>

                <a href="#" class="btn btn-primary btn-block planselection" idPlan="'.$results["planid"].'" pricePlan="'.$results["planprice"].'"  ><b> '.burengo_selectBtn.' </b></a>
              </div>
            </div>      
          </div>
 ';	
}else{
 	
	
}


}
?>

 