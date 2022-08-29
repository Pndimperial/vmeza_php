<?php
require_once 'connect.php';

// if (isset($_POST['login'])){
if (isset($_REQUEST['login'])) {

    $username = $_REQUEST['login'];
    // $username = $_POST['login'];
    $password = $_REQUEST['pass'];
    // $password = $_POST['pass'];

    $str_query = sprintf("SELECT `id`, `username`, `email`, `name`, `age` FROM user WHERE username = '%s' AND password = '%s'",
        mysqli_real_escape_string($db, $username),
        mysqli_real_escape_string($db, $password));

    if (!$response = mysqli_fetch_assoc(mysqli_query($db, $str_query))){
        http_response_code(404);
        $response = ["success" => 0, "message" => "Problem"];
    }
  

//        $response[] = array('user' => $resultArray);
} else {

    $response = ["success" => 0, "message" => "Problem"];
}

echo json_encode($response);
?>