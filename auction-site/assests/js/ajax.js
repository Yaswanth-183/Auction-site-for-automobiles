function updateBid(productId) {
    setInterval(function() {
        $.ajax({
            url: "get_highest_bid.php",
            method: "GET",
            data: { product_id: productId },
            success: function(response) {
                // Update the highest bid displayed on the page
                $('#highestBid').text("Highest Bid: $" + response);
            }
        });
    }, 5000);  // Update every 5 seconds
}
