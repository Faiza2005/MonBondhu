<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // Check if user already exists
    $check = $conn->prepare("SELECT * FROM users WHERE email=? OR phone=?");
    $check->bind_param("ss", $email, $phone);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        $error = "User already exists! ব্যবহারকারী ইতিমধ্যেই বিদ্যমান!";
    } else {
        // Insert new user
        $stmt = $conn->prepare("INSERT INTO users (full_name, email, phone, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $phone, $password);
        if ($stmt->execute()) {
            header("Location: login.php");
            exit();
        } else {
            $error = "Error: " . $conn->error;
        }
    }
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>MonBondhu - Sign Up</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    font-family: 'Poppins', sans-serif;
    color: white;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}
.signup-container {
    background: rgba(0,0,0,0.5);
    padding: 2rem;
    border-radius: 15px;
    width: 100%;
    max-width: 400px;
}
h2 {
    text-align: center;
    margin-bottom: 1.5rem;
    color: #FFD700;
}
.form-control {
    background: rgba(255,255,255,0.1);
    border: 1px solid rgba(255,255,255,0.3);
    color: white;
}
.form-control:focus {
    background: rgba(255,255,255,0.15);
    border-color: #FFD700;
    color: white;
    box-shadow: 0 0 5px #FFD700;
}
.btn-submit {
    background: #4ECDC4;
    border: none;
    width: 100%;
    padding: 10px;
    font-weight: 600;
}
.btn-submit:hover {
    background: #38b2ac;
}
.error-msg {
    background: #FF6B6B;
    padding: 10px;
    border-radius: 8px;
    margin-bottom: 1rem;
    text-align: center;
}
</style>
</head>
<body>
<div class="signup-container">
    <h2>Sign Up / নিবন্ধন</h2>
    <?php if(isset($error)) { echo '<div class="error-msg">'.$error.'</div>'; } ?>
    <form method="POST" action="">
        <div class="mb-3">
            <label class="form-label">Full Name / নাম</label>
            <input type="text" name="name" class="form-control" placeholder="Enter your name / আপনার নাম লিখুন" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email / ইমেইল</label>
            <input type="email" name="email" class="form-control" placeholder="Enter your email / আপনার ইমেইল লিখুন" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Phone / ফোন</label>
            <input type="tel" name="phone" class="form-control" placeholder="Enter your phone / আপনার ফোন লিখুন" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Password / পাসওয়ার্ড</label>
            <input type="password" name="password" class="form-control" placeholder="Enter password / পাসওয়ার্ড লিখুন" required>
        </div>
        <button type="submit" class="btn btn-submit">Create Account / একাউন্ট তৈরি করুন</button>
        <div class="text-center mt-3">
            Already have an account? <a href="login.php" style="color:#FFD700;">Login / লগইন</a>
        </div>
    </form>
</div>
</body>
</html>
