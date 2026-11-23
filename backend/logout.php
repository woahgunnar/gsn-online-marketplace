<?php
session_start();

// only allow POST requests
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    exit("Method not allowed.");
}

// destroy the session
session_destroy();

// redirect to the homepage
header("Location: ../index.html");
exit();
?>