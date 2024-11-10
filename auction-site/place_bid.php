<?php
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productId = $_POST['product_id'];
    $bidAmount = $_POST['bid_amount'];

    // Insert the new bid into the database
    $stmt = $conn->prepare("INSERT INTO bids (product_id, amount) VALUES (?, ?)");
    $stmt->bind_param("ii", $productId, $bidAmount);
    $stmt->execute();

    // Redirect back to the product page after placing the bid
    header("Location: product.php?id=" . $productId);
    exit();
}
?>
