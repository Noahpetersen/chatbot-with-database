<?php
    session_start();
    //Include the database
    include("../db.php");


    // Set headers 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    // Check if the request method is POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the user data from the request body
        $data = json_decode(file_get_contents("php://input"));

        // Save user data as variables
        $userName = $data->userName;
        $email = $data->email;
        $password = $data->password;

        //Check if user already exists
        if($db->query("SELECT * FROM Users WHERE email = '$email'")->num_rows > 0) {
            http_response_code(409);
            echo json_encode(array("alreadyExists" => true));
            exit();
        } else {
            $password = password_hash($password, PASSWORD_DEFAULT);
            // Insert the user into the database
            $sql = "INSERT INTO Users (email , password, user_name) VALUES ('$email', '$password', '$userName')";
            $query = $db->query($sql);
            
            if($query) {
                // log user in on signup
                $_SESSION['email'] = $email;
                $_SESSION['auth'] = true;
                http_response_code(201);
                echo json_encode(array("message" => "User created."));
                exit();
            } else {
                http_response_code(500);
                echo json_encode(array("message" => "Something went wrong."));
                exit();
            }
        }
        
    } else {
        // Return an error message if the request method is not POST
        http_response_code(405);
        echo json_encode(array("message" => "Method not allowed."));
    }
?>