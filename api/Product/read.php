<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//database & object
include_once = '../Config/database.php';
include_once = '../Objects/object_vehicle.php';


//inisiasi database 

$database = new Database();
$db = $database->getConnection();

$vehicle = new Vehicle();

$stmt = $vehicle->read();
$num = $stmt->rowCount();

if(empty($num)){
	$vehicle_arr = array();
	$vehicle_arr["records"]= array();

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

		extract($row);

		$vehicle_item=array(
			"id" => $id,
			"name" => $name
		);
		
		array_push($vehicle_arr["records"], $vehicle_item);
	}

	http_response_code(200);

	echo json_encode($vehicle_arr);



}else
{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode(
        array("message" => "No products found.")
    );
}


