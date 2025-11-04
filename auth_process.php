<?php
session_start();
include_once 'db.php';
include_once 'user.php';

$database = new Database();
$db = $database->getConnection();
$user = new User($db);

$message = "";
$message_type = "danger"; 

if ($_POST) {
    if (isset($_POST['login'])) {
        // Login process
        $username = $_POST['username'];
        $password = $_POST['password'];

        if (empty($username) || empty($password)) {
            $message = "Please fill in all fields";
        } else {
            if ($user->login($username, $password)) {
                $_SESSION['user_id'] = $user->id;
                $_SESSION['user_name'] = $user->fullname;
                $_SESSION['message'] = "Login successful! Welcome back, " . $user->fullname . "!";
                $_SESSION['message_type'] = "success";
                header("Location: dashboard.php");
                exit();
            } else {
                $message = "Invalid username or password";
            }
        }
    } 
    elseif (isset($_POST['signup'])) {
        // Signup process
        $user->fullname = $_POST['fullname'];
        $user->email = $_POST['email'];
        $user->phone = $_POST['phone'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        // Validation
        if (empty($user->fullname) || empty($user->email) || empty($user->phone) || empty($password)) {
            $message = "Please fill in all fields";
        }
        elseif ($password !== $confirm_password) {
            $message = "Passwords do not match";
        }
        elseif (!filter_var($user->email, FILTER_VALIDATE_EMAIL)) {
            $message = "Invalid email format";
        }
        elseif ($user->emailExists()) {
            $message = "Email already registered";
        }
        elseif ($user->phoneExists()) {
            $message = "Phone number already registered";
        }
        else {
            // Hash password and create user
            $user->password = password_hash($password, PASSWORD_DEFAULT);
            
            if ($user->create()) {
                $_SESSION['message'] = "Registration successful! Please login.";
                $_SESSION['message_type'] = "success";
                header("Location: index.php");
                exit();
            } else {
                $message = "Registration failed. Please try again.";
            }
        }
    }

    // If there's an error, store it in session and redirect back
    if (!empty($message)) {
        $_SESSION['message'] = $message;
        $_SESSION['message_type'] = $message_type;
        header("Location: index.php");
        exit();
    }
}
?>