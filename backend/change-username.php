<?php
session_start();
require "db.php";

// if the user isn't logged in, take them to the login page
if (!isset($_SESSION["user_id"])) {
    header("Location: ../login.html");
    exit();
}

// only allow POST requests
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    exit("Method not allowed.");
}

// grab the submitted username
$new_username = trim($_POST["new_username"] ?? "");

// make sure the username is valid
if (!preg_match("/^[a-zA-Z0-9_]{3,24}$/", $new_username)) {
    header("Location: ../edit-profile.php?status=invalid");
    exit();
}

// update the username in sql
$sql = "UPDATE users SET username = :username WHERE user_id = :user_id";

try {
    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        "username" => $new_username,
        "user_id" => $_SESSION["user_id"]
    ]);

    // update the session username
    $_SESSION["username"] = $new_username;

    header("Location: ../edit-profile.php?status=updated");
    exit();

} 
// error catches for when the username is taken or invalid
catch (PDOException $e) {
    if ($e->getCode() === "23000") {
        header("Location: ../edit-profile.php?status=taken");
    } else {
        header("Location: ../edit-profile.php?status=error");
    }
    exit();
}
?>