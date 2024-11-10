<?php
include 'includes/db.php';
include 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    uploadProduct($_POST['name'], $_POST['description'], $_POST['starting_price']);
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Product</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h1>Upload Product</h1>
    <form action="" method="post">
        <input type="text" name="name" placeholder="Product Name" required>
        <textarea name="description" placeholder="Product Description" required></textarea>
        <input type="number" name="starting_price" placeholder="Starting Price" required>
        <button type="submit">Upload</button>
    </form>
</body>
</html>
