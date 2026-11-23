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

?>