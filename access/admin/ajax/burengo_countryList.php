<?php 
require_once "../../modelos/conexion.php";
require_once "../../modelos/functions.php";

 
$stmt = Conexion::conectar()->prepare("SELECT * FROM bgo_country WHERE cystatus =1 ");
$stmt -> execute();

 echo '<a class="dropdown-item ctSelect" ctid="all" ctName="Todos los Paises"> Todos </a>';
 
while($results = $stmt -> fetch())
{ 
 echo '<a class="dropdown-item ctSelect pt-0" ctid="'.$results["cyid"].'" ctName="'.$results["cystr"].'" > '.$results["cystr"].'</a>';
}
?>

 