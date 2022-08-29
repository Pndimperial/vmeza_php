<?php
require_once 'connect.php';
$response = [];

// if (isset($_POST['login'])){
if (isset($_REQUEST['id'])) {

    $user_id = (int)$_REQUEST['id'];

    $str_query = "SELECT d.concert_name,
                         c.serial_num,
                         d.date,
                         d.coord_X,
                         d.coord_Y
                  FROM pndimper_vmezadb.customer_order as a
                  join pndimper_vmezadb.order_ticket as b on b.customer_order_id = a.id
                  join pndimper_vmezadb.ticket as c on c.id = b.ticket_id
                  join pndimper_vmezadb.concert as d on d.id = c.concert_id
                  where a.customer_id = '$user_id'";

    $query = mysqli_query($db, $str_query);

    while ($result = mysqli_fetch_assoc($query)) {
        $response[] = $result;
    }

} else {

    $response = ["success" => 0, "message" => "Empty data"];
}

echo json_encode($response);
?>