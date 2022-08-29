<?php

require_once 'connect.php';
$response = [];
    
if (isset($_REQUEST['id'])         &&
    isset($_REQUEST['concert_id']) &&
    isset($_REQUEST['cat_id'])) {

    $customer_id = (int)$_REQUEST['id'];
    $concert_id = (int)$_REQUEST['concert_id'];
    $cat_id = (int)$_REQUEST['cat_id'];

    mysqli_begin_transaction($db);
    try {

        $order_time = date("Y-m-d H:i:s");
        $price = 100.00;

        $result = mysqli_query($db,"SELECT MAX(`id`) FROM customer_order");
        $row = mysqli_fetch_row($result);
        $highest_id = $row[0] + 1;
        
        //создаем заказ
        $order_query = mysqli_prepare($db,'INSERT INTO customer_order (id,
                                                                             customer_id,
                                                                             paid_time, 
                                                                             total_price,
                                                                             discount,
                                                                             final_price)
                                                         VALUES (?, ?, ?, ?, ?, ?)');
        mysqli_stmt_bind_param($order_query, 'iissss', $highest_id,$customer_id, $order_time, $price, $price, $price);
        mysqli_stmt_execute($order_query);
        
        $last_order = mysqli_insert_id($db);
        
        //создаем билет
        $ticket_query = mysqli_prepare($db,'INSERT INTO ticket (serial_num, concert_id, ticket_category_id) 
                                                         VALUES (UUID(), ?, ?)');
        mysqli_stmt_bind_param($ticket_query, 'ii', $concert_id, $cat_id);
        mysqli_stmt_execute($ticket_query);

        $last_ticket = mysqli_insert_id($db);
        
        //создаем зависимость заказа и билетов
        $order_ticket_query = mysqli_prepare($db,'INSERT INTO order_ticket (customer_order_id, ticket_id) 
                                                               VALUES (?, ?)');
        mysqli_stmt_bind_param($order_ticket_query, 'ii', $last_order, $last_ticket);
        mysqli_stmt_execute($order_ticket_query);
        
        mysqli_commit($db);
        $response = $result;
    } catch (mysqli_sql_exception $exception) {
        mysqli_rollback($db);
        throw $exception;
    }

} else {
    $response = ["success" => 0, "message" => "Empty data"];
}

echo json_encode($response);
?>