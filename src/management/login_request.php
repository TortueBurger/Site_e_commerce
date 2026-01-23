<?php
$name = $email = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = process_input($_POST["username"]);
    $password = process_input($_POST["password"]);
    $email = process_input($_POST["email"]);
}

function process_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>