<?php

require "db.php";

$username = $_POST["username"] ?? "";
$email = $_POST["email"] ?? "";
$password = $_POST["password"] ?? "";
$password_hash = password_hash($password, PASSWORD_DEFAULT);
$phone = $_POST["phone"] ?? "";
$country = $_POST["country"] ?? "";
$state = $_POST["state"] ?? "";

$sql = "INSERT INTO users (username, email, password_hash, phone, country, state)
        VALUES (:username, :email, :password_hash, :phone, :country, :state)";

try {
    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        "username" => $username,
        "email" => $email,
        "password_hash" => $password_hash,
        "phone" => $phone,
        "country" => $country,
        "state" => $state
    ]);

    echo "user registered successfully";
} catch (PDOException $e) {
    if ($e->getCode() === "23000") {
        http_response_code(409);
        echo "Username or email already exists.";
    } else {
        http_response_code(500);
        echo "Registration failed. Please try again.";
    }
}

?>