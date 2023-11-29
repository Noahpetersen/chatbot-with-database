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
        $email = $data->email;
        $password = $data->password;

        //Create variables for the user data
        $query = $db->query("SELECT * FROM Users WHERE email = '$email'");
        $user = $query->fetch_assoc();
        $num = $query->num_rows;

        // Check for user on the database
        if($query && $num > 0 && password_verify($password, $user['password'])) {
            // handle login
            $_SESSION['email'] = $user['email'];
            $_SESSION['auth'] = true;
            echo json_encode(array("message" => "Login successful."));
            http_response_code(200);
            exit();
        } else {
            //handle error
            echo json_encode(array("message" => "Sorry, you entered an invalid email or password. Please try again."));
        }

    } else {
        // Return an error message if the request method is not POST
        http_response_code(405);
        echo json_encode(array("message" => "Method not allowed."));
    }
?>