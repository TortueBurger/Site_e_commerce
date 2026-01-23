<?php
$servername = "localhost";
$username = "root";
$db_password = "";
$db_name = "e_commerce_database";

// Create connection
$conn = new mysqli($servername, $username, $db_password, $db_name);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$name = $email = $password = "";

// Get user inputs from Form
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = process_input($_POST["username"]);
    $password = process_input($_POST["password"]);
    $email = process_input($_POST["email"]);
    get_user_with_mail();
}

// Remove all special characters from the inputs for security
function process_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function get_user_with_mail(){
    global $email, $conn;
    // Check if a user is already registered with the entered email
    $sql = "SELECT email from users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    // Result
    if (mysqli_num_rows($result) > 0){
        while ($row = mysqli_fetch_assoc($result)){
            echo $row["email"];
        }
    } else{
        add_user(); // Add user if email not used
    }

}


// Create user with the form inputs
function add_user(){
    global $name, $password, $email, $conn;
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Add new user to users table (SQL Command).
    $sql = "
        INSERT INTO users (name, email, password) 
        VALUES ('$name', '$email', '$password_hash')
    ";

    // Use previous sql command in the database
    if ($conn -> query($sql) == TRUE){
        echo "Added new user";
    // Error
    } else{
        echo $conn -> error;
    }

}

// Disconnect from database
$conn -> close();

?>