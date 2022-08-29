<?php
require_once 'connect.php';
$response = [];

// if (isset($_POST['login'])){
if (isset($_REQUEST['login'])) {

    $username = $_REQUEST['login'];
    // $username = $_POST['login'];
    $password = $_REQUEST['pass'];
    // $password = $_POST['pass'];

    $str_query = sprintf("INSERT INTO user (username, password) VALUES ('%s', '%s')",
        mysqli_real_escape_string($db, $username),
        mysqli_real_escape_string($db, $password));

    $result = mysqli_query($db, $str_query);
    $response = $result;
} else {
    $response = ["success" => 0, "message" => "Empty data"];
}

echo json_encode($response);
?>