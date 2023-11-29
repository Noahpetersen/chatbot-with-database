<?php
    header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With, *");
    header("Content-Type: application/json; charset=UTF-8");
    /* ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    ini_set('display_errors', 1); */
    include_once("db.php");
    $useremail = json_decode(file_get_contents("php://input"), true)["user_email"];
    $password = json_decode(file_get_contents("php://input"), true)["password"];


    $sql = "SELECT * FROM Users WHERE email = '$useremail'";

    $num = $db->query($sql)->num_rows;

    if($num == 0) {
        echo json_encode(false);
        return;
    }
    
    $result = $db->query($sql)->fetch_assoc();

    if (password_verify($result["password"], $password)) {
        echo json_encode($result);
    } else {
        echo json_encode(false);
    }
?>