<?php
include 'includes/db.php';

// Get product details based on ID
$productId = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->bind_param("i", $productId);
$stmt->execute();
$product = $stmt->get_result()->fetch_assoc();

// Fetch the current highest bid
$stmtBid = $conn->prepare("SELECT MAX(amount) AS highest_bid FROM bids WHERE product_id = ?");
$stmtBid->bind_param("i", $productId);
$stmtBid->execute();
$bidResult = $stmtBid->get_result();
$highestBid = $bidResult->fetch_assoc()['highest_bid'] ?? $product['starting_price']; // If no bid, set to starting price
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $product['title']; ?></title>
    <link rel="stylesheet" href="assests/css/styles.css"> <!-- Link to your styles.css -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assests/js/ajax.js"></script> <!-- Include your AJAX script here -->
</head>
<body>
    <h1><?php echo $product['title']; ?></h1>
    <p>Starting at: $<?php echo $product['starting_price']; ?></p>

    <!-- Display the highest bid -->
    <p id="highestBid">Highest Bid: $<?php echo $highestBid; ?></p>

    <!-- Bid form -->
    <form action="place_bid.php" method="POST">
        <label for="bid_amount">Place your bid:</label>
        <input type="number" name="bid_amount" min="<?php echo $product['starting_price']; ?>" required>
        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
        <button type="submit">Place Bid</button>
    </form>

    <script>
        // Start updating the bid in real-time
        var productId = <?php echo $product['id']; ?>;
        updateBid(productId);  // This will keep checking the highest bid every 5 seconds
    </script>
</body>
</html>

