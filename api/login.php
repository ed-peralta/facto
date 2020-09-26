<?php
$username = null;
$password = null;
$data = json_decode(file_get_contents("php://input"));

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if(!empty($_POST["username"]) && !empty($_POST["password"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        if($username == 'user' && $password == 'password') {
            session_start();
            $_SESSION["authenticated"] = 'true';
            header('Location: index.php');
        }
        else {
            header('Location: login.php');
        }

    } else {
        header('Location: login.php');
    }
} else {
header('Location: login.php');
} ?>
