<?php
    header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With, *");
    header("Content-Type: application/json; charset=UTF-8");
    /* ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    ini_set('display_errors', 1); */
    include_once("db.php");
    $chatId = json_decode(file_get_contents("php://input"), true)["chatId"];

    $sql = "SELECT * FROM Answers WHERE chat_id = '$chatId'";
    $result = $db->query($sql)->fetch_object();

    $num = $db->query($sql)->num_rows;

    if($num == 0) {
        echo json_encode(false);
        return;
    }

    echo json_encode($result);