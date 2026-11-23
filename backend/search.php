<?php

require "db.php";

$search = trim($_GET["search"] ?? "");

if ($search === "") {
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

if (count($results) === 0) {
    exit;
}

foreach ($results as $item) {

    $name = htmlspecialchars($item["name"]);
    $description = htmlspecialchars($item["description"]);
    $price = number_format($item["price"], 2);
    $image = htmlspecialchars($item["image_url"]);

    echo "
        <li class='product-box'>
            <img 
                src='$image' 
                alt='$name' 
                class='product-image'
            >
            <h4>$name</h4>
            <p>$description</p>
            <p class='product-price'>$$price</p>
        </li>
    ";
}
?>
