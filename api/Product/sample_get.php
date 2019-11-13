<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include "../../config.php";
include "../../Library/DBConnection.php";

 	
	$connection = new dbConnection();
	$connection->openCon();
	$rows = $connection->exeQuery("SELECT * FROM tb_m_vehicle");
	echo json_encode($rows) ;
?>