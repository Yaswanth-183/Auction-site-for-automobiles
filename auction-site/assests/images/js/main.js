// For handling form submissions and AJAX requests
document.addEventListener('DOMContentLoaded', function() {

    // Example of bid form submission using AJAX (optional, if you want to avoid page reload)
    const bidForm = document.querySelector('#bidForm');
    
    if (bidForm) {
        bidForm.addEventListener('submit', function(event) {
            event.preventDefault();  // Prevent the form from submitting normally
            
            const productId = bidForm.querySelector('input[name="product_id"]').value;
            const bidAmount = bidForm.querySelector('input[name="bid_amount"]').value;
            
            const formData = new FormData();
            formData.append('product_id', productId);
            formData.append('bid_amount', bidAmount);
            
            fetch('bid.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                alert(data);  // Show server response (success or error)
                location.reload();  // Reload the page to update the bids
            })
            .catch(error => {
                console.error('Error placing bid:', error);
            });
        });
    }

    // Example: Image preview for the upload page
    const imageInput = document.querySelector('input[type="file"]');
    const imagePreview = document.querySelector('#imagePreview');
    
    if (imageInput) {
        imageInput.addEventListener('change', function() {
            const file = imageInput.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    imagePreview.src = event.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    }

});
