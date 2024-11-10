<?php
// Include the database connection
include('includes/db.php');  // Include connection globally

// Fetch all products
function getProducts() {
    global $conn;
    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);

    if ($result) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        // Handle error
        die("Error fetching products: " . $conn->error);
    }
}

// Fetch a specific product by ID
function getProduct($id) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if product exists
    if ($result && $result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null;  // No product found with the given ID
    }
}

// Register a new user
function registerUser($username, $password, $email) {
    global $conn;

    // Hash the password before saving to the database
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // SQL query to insert data
    $query = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("sss", $username, $hashedPassword, $email);
        $stmt->execute();
        $stmt->close();
    } else {
        die("Error preparing statement: " . $conn->error);  // Handle preparation failure
    }
}

// Login a user
function loginUser($username, $password) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();

    // Return true if password matches
    return $user && password_verify($password, $user['password']);
}

// Upload a product
function uploadProduct($name, $description, $starting_price) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO products (name, description, starting_price) VALUES (?, ?, ?)");
    $stmt->bind_param('ssi', $name, $description, $starting_price);
    $stmt->execute();
}

// Place a bid on a product
function placeBid($productId, $amount) {
    global $conn;

    // Ensure the amount is not empty
    if (empty($amount)) {
        die("Bid amount cannot be empty.");
    }

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO bids (product_id, amount) VALUES (?, ?)");
    $stmt->bind_param('id', $productId, $amount);

    // Execute the statement and check for errors
    if ($stmt->execute()) {
        echo "Bid placed successfully!";
    } else {
        die("Error placing bid: " . $stmt->error);
    }
}

?>
