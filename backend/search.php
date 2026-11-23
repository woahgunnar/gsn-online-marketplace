<?php

require "db.php";

header("Content-Type: application/json");

$search = trim($_GET["search"] ?? "");

if ($search === "") {
    echo json_encode([]);
    exit;
}

$sql = "
    SELECT product_id, name, description, price, image_url
    FROM products
    WHERE name LIKE :name_search
    OR description LIKE :description_search
";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    "name_search" => "%" . $search . "%",
    "description_search" => "%" . $search . "%"
]);

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($results);

?>
