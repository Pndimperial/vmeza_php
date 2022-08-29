<?php
include 'connect.php';

$response = [];

$str_query = "SELECT `id`, `city_name` FROM cities";

$query = mysqli_query($db, $str_query);

while ($result = mysqli_fetch_assoc($query)) {
    $response[] = $result;
}
//
//$response[] = array('cities' => $resultArray);

echo json_encode($response);
?>
