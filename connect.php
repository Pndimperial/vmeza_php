<?php

header("Content-Type: application/json; charset=UTF-8");

$db = mysqli_connect("localhost:3306", "pndimper_root", "1q2w3e!Q@W#E", "pndimper_vmezadb");

if (!$db) {
    die("Cannot connect to server");
}
?>