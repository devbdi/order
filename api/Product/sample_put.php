<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include "../../config.php";
include "../../Library/DBConnection.php";

$id = $_REQUEST['id'];
$data = json_decode(file_get_contents("php://input"));

 

	$connection = new dbConnection();
	$connection->openCon();
	$connection->exeNonQuery("update tb_m_vehicle set name='$data->name' where id=$id");
	//echo json_encode($rows) ;
?>