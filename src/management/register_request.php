<?php
// Create connection
require_once('../config/config.php');
$connection = new mysqli(SERVER_NAME, SERVER_USERNAME, SERVER_PASSWORD, DB_NAME);
// Check connection
if ($connection->connect_error) {
  die("Connection failed: " . $connection->connect_error);
}

$name = $email = $password = "";

// Get user inputs from Form
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (!is_email_valid($_POST["email"])){
        header('Location: ../pages/register.php?error=1');
        exit;
    }
    $name = process_input($_POST["username"]);
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
    global $email, $connection;
    // Check if a user is already registered with the entered email
    $sql = "SELECT email from users WHERE email = '$email'";
    $result = mysqli_query($connection, $sql);

    // Result
    if (mysqli_num_rows($result) > 0){
        header('Location: ../pages/register.php?error=1'); // Already Used
    } else{
        add_user(); // Add user if email not used
    }

}


// Create user with the form inputs
function add_user(){    
    global $name, $password, $email, $connection;
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Add new user to users table (SQL Command).
    $sql = "
        INSERT INTO users (name, email, password) 
        VALUES ('$name', '$email', '$password_hash')
    ";

    // Use previous sql command in the database
    if ($connection -> query($sql) == TRUE){
        $id = $connection->insert_id;
        start_session($name, $email, $id);
    // Error
    } else{
        echo $connection -> error;
    }

}

// Starts a new session with the user data
function start_session($name, $email, $id){
    session_start();
    $_SESSION["name"] = $name;
    $_SESSION["id"] = $id;
    $_SESSION["email"] = $email;
    header('Location: ../pages/homepage.php');
    exit();
}

// Disconnect from database
$connection -> close();

?>