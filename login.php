<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login to TaskManager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="icon.jpeg" type="image/jpeg">
    <style>
        body {
            background-color: #343a40; /* Dark background */
            color: #ffffff; /* White text */
            font-family: Arial, sans-serif; /* Font for consistency */
        }
        .container {
            max-width: 400px;
            margin-top: 100px; /* Centering the content vertically */
        }
        .form-label {
            color: #ffffff; /* White label text */
        }
        .form-control {
            background-color: #6c757d; /* Dark grey form background */
            color: #ffffff; /* White form text */
            border-color: #6c757d; /* Dark grey form border */
        }
        .form-control:focus {
            background-color: #6c757d; /* Dark grey form background on focus */
            border-color: #6c757d; /* Dark grey form border on focus */
            box-shadow: none; /* Remove default focus box shadow */
        }
        .btn-primary {
            background-color: #007BFF; /* Bootstrap primary button color */
            border-color: #007BFF;
            font-weight: bold;
            transition: background-color 0.3s, color 0.3s; /* Smooth transition */
            padding: 10px 20px; /* Adjusted padding */
            font-size: 16px; /* Adjusted font size */
        }
        .btn-primary:hover, .btn-primary:focus {
            background-color: #0056b3; /* Darker shade for hover effect */
            border-color: #0056b3;
        }
        .btn-primary:active {
            background-color: #004085; /* Even darker for the active state */
            border-color: #004085;
        }
        .register-link {
            color: #ffffff; /* White register link text */
            text-decoration: none; /* Remove default underline */
            font-weight: bold; /* Make text bold */
            transition: color 0.3s; /* Smooth transition for color change */
        }
        .register-link:hover {
            color: #f8f9fa; /* Light grey color on hover */
        }

        .button-style {
            display: inline-block;
            padding: 10px 20px;
            margin: 5px;
            background-color: #007BFF; /* Bootstrap primary button color */
            color: white;
            text-align: center;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
            border: 1px solid transparent; /* For a sharp button look */
            transition: background-color 0.3s, color 0.3s;
        }

        .custom-class {
            border-radius: 18%;
            height: 65px;
            width: auto;
        }

        /* Increase text size in header */
        .navbar-brand {
            font-size: 24px; /* Adjust the font size as needed */
        }
        
        /* Increase space among navbar contents */
        .navbar-nav > li > a {
            margin-right: 20px;
        }

        .bg-dark.p-4 {
            border-radius: 25px; /* Adjust the border radius as needed */
        }

        .form-control:focus {
            background-color: #a9a9a9; /* Light grey form background on focus */
            border-color: #6c757d; /* Dark grey form border remains */
            box-shadow: none; /* Remove default focus box shadow */
        }
        
        .register-link {
            color: #ffffff; /* White register link text */
            text-decoration: none; /* Remove default underline */
            font-weight: bold; /* Make text bold */
            transition: color 0.3s; /* Smooth transition for color change */
            margin-top: 25px; /* Add margin-top */
        }

        .custom-button {
            margin-top: 20px;
            margin-bottom: 20px;
        }


    </style>
</head>
<body>
    <header class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a href="#" class="navbar-brand"><b>T</b>ask<b> M</b>anager</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a href="index.html" target="_blank" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="aboutus.html" class="nav-link">About Us</a></li>    
            </ul>
            <a href="socials.html" class="button-style">Contact Us</a>
        </div>
    </header>
    <div class="container">
        <h2 class="mb-4 text-center">
            <img class="image-responsive custom-class" src="icon.jpeg">
        </h2>
        <div class="bg-dark p-4">
            
            <form action="#" method="_POST">
                <div class="mb-3">
                    <label for="loginEmail" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="loginEmail" name="loginEmail" required placeholder="Enter Email">
                </div>
                <div class="mb-3">
                    <label for="loginPassword" class="form-label">Password</label>
                    <input type="password" class="form-control" id="loginPassword" name="loginPassword" required placeholder="Enter Password">
                </div>
                <input type="submit" class="btn btn-primary mx-auto custom-button" value="Submit" name="login">
            </form>
            <div class="text-center mt-3">
                <a href="register.html" class="register-link" target="_blank">New User ?? Register Here !! </a>
            </div>
        </div>
    </div>
    <?php
        session_start();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            if (!empty($_POST['loginEmail']) && !empty($_POST['loginPassword'])) {
                
                $loginEmail = $_POST['loginEmail'];
                $loginPassword = $_POST['loginPassword'];

                
                $servername = "localhost"; 
                $db_username = "root"; 
                $db_password = ""; 
                $database = "task_manager";

                
                $conn = new mysqli($servername, $db_username, $db_password, $database);

                
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                
                $stmt = $conn->prepare("SELECT * FROM registration WHERE email=?");
                $stmt->bind_param("s", $loginEmail);

                
                $stmt->execute();

                
                $result = $stmt->get_result();

                
                if ($result->num_rows == 1) {
                
                    $row = $result->fetch_assoc();
                    if (password_verify($loginPassword, $row['password'])) {
                        $_SESSION['user_id'] = $row['user_id']; 
                        header("location: dashboard.html"); 
                        exit;
                    } else {
                        echo "Incorrect password";
                    }
                } else {
                    echo "User not found";
                }     
                $result->close();
                $stmt->close();
                $conn->close();
            } else {
                echo "All fields are required";
            }
        }
    ?>
</body>
</html>