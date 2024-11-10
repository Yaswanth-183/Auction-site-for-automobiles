<?php
include 'includes/db.php';
include 'includes/functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if product_id and bid_amount are set
    if (isset($_POST['product_id']) && isset($_POST['bid_amount']) && !empty($_POST['bid_amount'])) {
        $productId = $_POST['product_id'];
        $amount = $_POST['bid_amount'];

        // Call your function to place the bid
        placeBid($productId, $amount);
    } else {
        die("Please enter a valid bid amount.");
    }
} else {
    die("Invalid request.");
}
?>
