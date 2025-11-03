<?php
include "db.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $identifier = $_POST["identifier"]; // email or phone
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email=? OR phone=?");
    $stmt->bind_param("ss", $identifier, $identifier);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['full_name'];
            header("Location: dashboard.php"); // redirect to dashboard after login
            exit();
        } else {
            $error = "Invalid password / ভুল পাসওয়ার্ড!";
        }
    } else {
        $error = "User not found / ব্যবহারকারী পাওয়া যায়নি!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>MonBondhu - Login</title>
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
.login-container {
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
    background: #FF6B6B;
    border: none;
    width: 100%;
    padding: 10px;
    font-weight: 600;
}
.btn-submit:hover {
    background: #e55656;
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
<div class="login-container">
    <h2>Login / লগইন</h2>
    <?php if(isset($error)) { echo '<div class="error-msg">'.$error.'</div>'; } ?>
    <form method="POST" action="">
        <div class="mb-3">
            <label class="form-label">Email or Phone / ইমেইল বা ফোন</label>
            <input type="text" name="identifier" class="form-control" placeholder="Enter email or phone / ইমেইল বা ফোন লিখুন" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Password / পাসওয়ার্ড</label>
            <input type="password" name="password" class="form-control" placeholder="Enter password / পাসওয়ার্ড লিখুন" required>
        </div>
        <button type="submit" class="btn btn-submit">Login / লগইন</button>
        <div class="text-center mt-3">
            Don't have an account? <a href="signup.php" style="color:#FFD700;">Sign Up / নিবন্ধন</a>
        </div>
    </form>
</div>
</body>
</html>
