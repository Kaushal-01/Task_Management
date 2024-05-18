<?php
    include 'config.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $taskName = $_POST['taskName'];
        $dueDate = $_POST['dueDate'];

        $sql = "INSERT INTO tasks (task_name, due_date) VALUES ('$taskName', '$dueDate')";

        if ($conn->query($sql) === TRUE) {
            header("Location: taskdisplay.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
?>
