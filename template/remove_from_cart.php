<?php
// Get the product id from the URL
$id = $_GET['id'];

// Remove the product from the cart
unset($_SESSION['cart'][$id]);

// Redirect back to the cart page
header('Location: panier.php');
