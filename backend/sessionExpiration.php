<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    http_response_code(401);
    exit;
}

$_SESSION["last_activity"] = time();
echo json_encode([
    "success" => true
]);

?>