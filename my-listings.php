<?php
session_start();

require_once __DIR__ . "/backend/db.php";

// Verify login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$userID = (int) $_SESSION['user_id'];

// Retrieve this user's products
$sql = "SELECT product_id, name, description, price,
               image_url, created_at
        FROM products
        WHERE user_id = :user_id
        ORDER BY created_at DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute([':user_id' => $userID]);

$listings = $stmt->fetchAll();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0" />

    <meta name="author" content="Gunnar Ashworth; modified by Sebastian Jeansonne" />
    <meta name="description"
          content="Manage your marketplace listings" />

    <title>Olde-Catalog - Your Listings</title>

    <link rel="stylesheet" href="css/global.css" />
    <link rel="stylesheet" href="css/header-footer.css" />
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="css/my-listings.css" />

    <script src="js/sessionExpiration.js" defer></script>
</head>

<body>

<header>
    <div class="header-content">

        <div class="logo-window">
            <h1>
                <a href="index.html">
                    <img src="images/logo.webp"
                         width="300"
                         height="150"
                         alt="logo" />
                </a>
            </h1>
        </div>

        <nav aria-label="Main navigation">
            <a href="login.html">Sign in</a>
            <a href="index.html">Browse</a>
            <a href="messages.html">Messages</a>
            <a href="profile.php">Profile</a>
            <a href="cart.html">Cart</a>
        </nav>

    </div>
</header>

<main class="wooden-frame">

    <div class="parchment-panel">

        <img src="images/iron-rivet.png"
             class="nail-left" alt="nail" />

        <img src="images/iron-rivet.png"
             class="nail-right" alt="nail" />

        <a href="profile.php" class="leather-button">
            Back
        </a>

        <section class="listing-form">

            <h1>Create a New Listing</h1>

            <?php if (isset($_GET['success'])): ?>
                <p class="success-message">
                    Your product was successfully added!
                </p>
            <?php endif; ?>

            <?php if (isset($_GET['error'])): ?>
                <p class="error-message">
                    Your product could not be added.
                    Please check your information and try again.
                </p>
            <?php endif; ?>

            <form action="add-product.php"
                  method="POST"
                  enctype="multipart/form-data">

                <label for="name">Product Name</label>

                <input type="text"
                       id="name"
                       name="name"
                       maxlength="255"
                       required />

                <label for="description">Description</label>

                <textarea id="description"
                          name="description"
                          rows="5"></textarea>

                <label for="price">Price ($)</label>

                <input type="number"
                       id="price"
                       name="price"
                       min="0"
                       max="99999999.99"
                       step="0.01"
                       required />

                <label for="image_url">Product Image URL</label>
        	<input type="url"
               		id="image_url"
               		name="image_url"
               		maxlength="255"
               		placeholder="https://example.com/image.jpg"
               		required>

		<div class="image-preview-container">
		    <p>Image Preview:</p>
		    <img
		        id="imagePreview"
		        src=""
		        alt="Product image preview"
		        hidden
		    >
		    <p id="previewMessage">Enter an image URL to see a preview.</p>
		</div>

                <button type="submit">
                    Add Listing
                </button>

            </form>

        </section>

        <section class="existing-listings">

            <h2>Your Existing Listings</h2>

            <?php if (count($listings) > 0): ?>

                <?php foreach ($listings as $listing): ?>

                    <article class="product-listing">

                        <h3>
                            <?= htmlspecialchars(
                                $listing['name'],
                                ENT_QUOTES,
                                'UTF-8'
                            ) ?>
                        </h3>

                        <img
                            src="<?= htmlspecialchars(
                                $listing['image_url'],
                                ENT_QUOTES,
                                'UTF-8'
                            ) ?>"
                            alt="<?= htmlspecialchars(
                                $listing['name'],
                                ENT_QUOTES,
                                'UTF-8'
                            ) ?>"
                            width="200"
                        />

                        <p>
                            <?= nl2br(htmlspecialchars(
                                $listing['description'] ?? '',
                                ENT_QUOTES,
                                'UTF-8'
                            )) ?>
                        </p>

                        <p>
                            Price: $
                            <?= htmlspecialchars(
                                $listing['price'],
                                ENT_QUOTES,
                                'UTF-8'
                            ) ?>
                        </p>

                        <p>
                            Listed:
                            <?= htmlspecialchars(
                                $listing['created_at'],
                                ENT_QUOTES,
                                'UTF-8'
                            ) ?>
                        </p>

                    </article>

                <?php endforeach; ?>

            <?php else: ?>

                <p>You haven't created any listings yet.</p>

            <?php endif; ?>

        </section>

    </div>

</main>

<footer>
    <div class="footer-content">
        <p>&copy; 2026 Olde-Catalog</p>
        <a href="support.html">Help & Support</a>
    </div>
</footer>

<script src="js/imagePreview.js" defer></script>

</body>
</html>
