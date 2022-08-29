<?php
require_once 'connect.php';
$response = [];

if (isset($_REQUEST['city_id'])) {

    $city_id = (int)$_REQUEST['city_id'];

    $str_query = "SELECT * FROM concert WHERE city_id = '$city_id'";

    $query = mysqli_query($db, $str_query);

    while ($result = mysqli_fetch_assoc($query)) {
        $response[] = $result;
    }

//    $response[] = array('concerts' => $resultArray);

} else {
    $response = ["success" => 0, "message" => "Problem"];
}
echo json_encode($response);
?>
