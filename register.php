<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Checking for all variables and fields
    if (isset($_POST['username']) && isset($_POST['password'])) {
        
        $username = $_POST['username'];
        $password = $_POST['password']; 
        // PASSWORD_DEFAULT; 
        $mail = $_POST['mail'];

        // Database connection 
        $servername = "localhost"; 
        $db_username = "root"; 
        $db_password = ""; 
        $database = "task_manager"; 

        // Creating connection
        $conn = new mysqli($servername, $db_username, $db_password, $database);

        // Checking connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // The SQL statement
        $stmt = $conn->prepare("INSERT INTO `registration` (username, password , email) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $password, $mail);

        // Executing the statement
        if ($stmt->execute() === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Closing the statement and connection
        $stmt->close();
        $conn->close();
    } else {
        // For empty field
        echo "All fields are required";
    }
}
?>
