
<?php

session_start();

require_once 'db.php';

//ensure user log in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

//ONLY accept POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: my-listings.php");
    exit();
}

//Get current user ID
$userID = (int) $_SESSION['user_id'];

//Retrieve form information
$name = trim($_POST['name'] ?? '');
$description = trim($_POST['description'] ?? '');
$price = trim($_POST['price'] ?? '');
$imageURL = trim($_POST['image_url'] ?? '');

//product name check
if (
    $name === '' ||
    mb_strlen($name) > 255
) {
    header("Location: my-listings.php?error=1");
    exit();
}

//Validate price (Can't have you make TOO much money now)
if (!preg_match('/^\d{1,8}(\.\d{1,2})?$/', $price)) {
    header("Location: my-listings.php?error=1");
    exit();
}

//Validate uploaded image URL length
if (strlen($imageURL) > 255) {
    header("Location: my-listings.php?error=1");
    exit();
}

// Validate image URL
$urlParts = parse_url($imageURL);

if (
    !filter_var($imageURL, FILTER_VALIDATE_URL) ||
    !is_array($urlParts) ||
    !isset($urlParts['scheme'], $urlParts['host']) ||
    strtolower($urlParts['scheme']) !== 'https'
) {
    header("Location: my-listings.php?error=1");
    exit();
}

try {

    //Insert product into database
    $sql = "INSERT INTO products
            (user_id, name, description, price, image_url)
            VALUES
            (:user_id, :name, :description, :price, :image_url)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':user_id' => $userID,
        ':name' => $name,
        ':description' => $description,
        ':price' => $price,
        ':image_url' => $imageURL
    ]);

    // Redirect after successful insertion
    header("Location: my-listings.php?success=1");
    exit();

} catch (PDOException $e) {

    error_log($e->getMessage());

    header("Location: my-listings.php?error=1");
    exit();
}

?>
