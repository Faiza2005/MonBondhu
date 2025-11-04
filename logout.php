<?php
session_start();
session_destroy();
$_SESSION['message'] = "You have been logged out successfully";
$_SESSION['message_type'] = "success";
header("Location: index.php");
exit();
?> 