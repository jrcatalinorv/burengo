<?php 
require_once "../../modelos/conexion.php";
require_once "../../modelos/functions.php";

 
$stmt = Conexion::conectar()->prepare("SELECT * FROM bgo_planes WHERE plantypo = 1");
$stmt -> execute();

echo '<a class="dropdown-item plSelect" plid="0" pnm="Todos los Planes"  > Todos </a>';
 
while($results = $stmt -> fetch())
{ 
 echo '<a class="dropdown-item plSelect" plid="'.$results["planid"].'" pnm="'.$results["planname"].'"  > '.$results["planname"].'</a>';
}
?>

 