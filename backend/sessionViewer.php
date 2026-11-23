<?php
session_start();
$timeout = 900; 

if (!isset($_SESSION["user_id"])) {
    echo json_encode([
        "logged_in" => false
    ]);
    exit;
}

if (isset($_SESSION["last_activity"])) {
    $inactive = time() - $_SESSION["last_activity"];
    if ($inactive >= $timeout) {

        session_unset();
        session_destroy();
        echo json_encode([
            "logged_in" => false,
            "timeout" => true
        ]);

        exit;
    }
}

$_SESSION["last_activity"] = time();

echo json_encode([
    "logged_in" => true
]);

?>