<?php
session_start(); // Start the session

// Get the photo details from the form submission
$photo_id = $_POST['photo_id'];
$photo_title = $_POST['photo_title'];
$photo_price = $_POST['photo_price'];

// Create an item array
$item = [
    'id' => $photo_id,
    'title' => $photo_title,
    'price' => $photo_price,
];

// If cart is not set, initialize it
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Add the item to the cart
$_SESSION['cart'][] = $item;

// Redirect back to the shop page
header('Location: shop.php');
exit();
?>
