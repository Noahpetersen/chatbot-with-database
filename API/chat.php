<?php
    header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With, *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Credentials: true");
	header("Access-Control-Allow-Methods: GET, POST");
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    session_start();
    include("../db.php");
    include("../functions/chatbot.php");
    $useremail = json_decode(file_get_contents("php://input"), true)["user_email"];
    $chatId = json_decode(file_get_contents("php://input"), true)["chatId"];
    $message = json_decode(file_get_contents("php://input"), true)["message"];
    $created_at = date("Y-m-d H:i:s");
    $answer = bot($message);

    $findChat = "SELECT * FROM Chats WHERE chat_id = '$chatId'";
    $num = $db->query($findChat)->num_rows;

    if($num == 0) {
        $insertIntoDB = "INSERT INTO Chats (chat_id, email, created_at) VALUES ('$chatId', '$useremail', '$created_at')";
        
        if($db->query($insertIntoDB)){
            $insertAnswerIntoDB = "INSERT INTO Answers (chat_id, bot_respons, user_message) VALUES ('$chatId', '$answer', '$message')";
        }
    }else{
        $insertAnswerIntoDB = "INSERT INTO Answers (chat_id, bot_respons, user_message) VALUES ('$chatId', '$answer', '$message')";
    }

    
    if($db->query($insertAnswerIntoDB)){
        echo json_encode($answer);
    } else {
        echo json_encode(false);
    }
