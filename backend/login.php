<?php
session_start();
require "db.php";

// only allow POST requests
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    exit("Method not allowed.");
}

// grab the submitted fields
$email = trim($_POST["email"] ?? "");
$password = $_POST["password"] ?? "";

// return a message if either field is empty
if (empty($email) || empty($password)) {
    exit("Please enter your email and password.");
}

// find the user in the database
$sql = "SELECT user_id, username, password_hash FROM users WHERE email = :email";
$stmt = $pdo->prepare($sql);
$stmt->execute(["email" => $email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// verify the password
if (!$user || !password_verify($password, $user["password_hash"])) {
    header("Location: ../login.html?error=invalid");
    exit();
}

// create the session
session_regenerate_id(true);
$_SESSION['user_id'] = $user['user_id'];
$_SESSION['username'] = $user['username'];
$_SESSION["last_activity"] = time();

// redirect to the profile page after logging in
header("Location: ../index.html");
exit();
?>
