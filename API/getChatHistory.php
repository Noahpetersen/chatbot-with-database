<?php
    header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With, *");
    header("Content-Type: application/json; charset=UTF-8");
    /* ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    ini_set('display_errors', 1); */
    include("../db.php");
    $useremail = json_decode(file_get_contents("php://input"), true)["user_email"];
    $chatId = json_decode(file_get_contents("php://input"), true)["chatId"];

    $sql = "SELECT *, GROUP_CONCAT(Answers.bot_respons SEPARATOR ', ') AS bot_response, GROUP_CONCAT(Answers.user_message SEPARATOR ', ') AS user_message FROM Chats INNER JOIN Answers ON Chats.chat_id = Answers.chat_id WHERE email = '$useremail' AND Chats.chat_id = '$chatId' GROUP BY Answers.chat_id";

    $num = $db->query($sql)->num_rows;

    if($num == 0) {
        echo json_encode(false);
        return;
    }
    $result = $db->query($sql)->fetch_object();
    echo json_encode($result);