<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include "../../config.php";
include "../../Library/DBConnection.php";

$data = json_decode(file_get_contents("php://input"));

 	/*$con = openCon();
	$sqla       = "SELECT * FROM tb_m_vehicle";
	$resulta    = exeQuery($con,$sqla);
	$rowcounta	= readDB($resulta);
	echo json_encode($rowcounta) ;*/

	$connection = new dbConnection();
	$connection->openCon();
	$connection->exeNonQuery("insert into tb_m_vehicle values($data->id,'$data->name')");
	//echo json_encode($rows) ;
?>