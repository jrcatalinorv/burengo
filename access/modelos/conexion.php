<?php
class Conexion{
	public function conectar(){
		$link = new PDO("mysql:host=localhost;dbname=bgo_database_site","burengo","bgoAdmin7869");
		$link->exec("set names utf8");
		return $link;
	}
}
?>

