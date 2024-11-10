<?php
include 'includes/db.php';
include 'includes/functions.php';

// Check if there is a search term from the GET request
$searchTerm = isset($_GET['search']) ? "%" . $_GET['search'] . "%" : "%";

// Prepare the SQL query to fetch products based on the search term
$stmt = $conn->prepare("SELECT * FROM products WHERE title LIKE ? OR description LIKE ?");
$stmt->bind_param("ss", $searchTerm, $searchTerm);
$stmt->execute();

// Get the result of the query
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Auction Site</title>
    <link rel="stylesheet" href="assests/css/style.css">
</head>
<body>
    <h1>Welcome to the Auction Site</h1>

    <!-- Search Form -->
    <form action="index.php" method="GET">
        <label for="search">Search for a product:</label>
        <input type="text" name="search" id="search" placeholder="Search products..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
        <button type="submit">Search</button>
    </form>

    <ul>
        <?php 
        // Display products from the database
        while ($product = $result->fetch_assoc()): ?>
            <li>
                <a href="product.php?id=<?php echo $product['id']; ?>">
                    <?php echo $product['title']; ?> - Starting at $<?php echo $product['starting_price']; ?>
                </a>
            </li>
        <?php endwhile; ?>
    </ul>
</body>
</html>
