<?php
//Create connection
require_once('../config/config.php');
$connection = new mysqli(SERVER_NAME, SERVER_USERNAME, SERVER_PASSWORD, DB_NAME);

// Check connection
if ($connection->connect_error) {
  die("Connection failed: " . $connection->connect_error);
}

$email = $password = "";

// Get user inputs from Form
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (!is_email_valid($_POST["email"])){
        header('Location: ../pages/login.php?error=1');
        exit;
    }
    $password = process_input($_POST["password"]);
    $email = process_input($_POST["email"]);
    get_user_with_mail();
}

// Check if the string used in paramater matches the email filter
function is_email_valid($email){
    if ($email == filter_var($email, FILTER_VALIDATE_EMAIL)){
        return true;
    }
    return false;
}

// Remove all special characters from the inputs for security
function process_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function get_user_with_mail(){
    global $email, $connection, $password;

    // Find user in database
    $sql = "SELECT name, email, password, id, role from users WHERE email = '$email'";
    $result = mysqli_query($connection, $sql);

    // Result
    if (mysqli_num_rows($result) > 0){
        while($row = $result->fetch_assoc()){
            if ($email == $row["email"]){
                check_password($email, $password, $row["password"], $row["name"], $row["id"], $row["role"]);
            }
        }
    } else{
        header('Location: ../pages/login.php?error=1'); // Already Used
    }

}

function check_password($email, $password, $password_hash, $name, $id, $role){
    if (password_verify($password, $password_hash)){
        start_session($name, $email, $id, $role);
    } else{
        header('Location: ../pages/login.php?error=1');
    }
}

// Starts a new session with the user data
function start_session($name, $email, $id, $role){
    session_start();
    $_SESSION["name"] = $name;
    $_SESSION["email"] = $email;
    $_SESSION["id"] = $id;
    $_SESSION["role"] = $role;
    header('Location: ../pages/homepage.php');
    exit();
}

// Disconnect from database
$connection -> close();

?>