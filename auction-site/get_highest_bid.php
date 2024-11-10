<?php
include 'includes/db.php';

if (isset($_GET['product_id'])) {
    $productId = $_GET['product_id'];

    // Fetch the highest bid for the product
    $stmt = $conn->prepare("SELECT MAX(amount) AS highest_bid FROM bids WHERE product_id = ?");
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();
    $highestBid = $result->fetch_assoc()['highest_bid'] ?? 0; // Default to 0 if no bid yet

    echo $highestBid; // Return the highest bid
}
?>
