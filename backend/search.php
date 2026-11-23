<?php

require "db.php";

$search = $_GET["search"] ?? "";

$sql = "SELECT * FROM items WHERE name LIKE :search";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    "search" => "%" . $search . "%"
]);

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

header("Content-Type: application/json");

echo json_encode($results);

?>