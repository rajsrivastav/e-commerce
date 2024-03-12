<?php 
session_start();

if (isset($_POST['productId'])) {
    $productId = $_POST['productId'];

    // Check if the product ID already exists in the cart
    if (isset($_SESSION['cart'][$productId])) {
        // If the product ID exists, increase the quantity by 1
        $_SESSION['cart'][$productId]++;
    } else {
        // If the product ID doesn't exist, add it to the cart with quantity 1
        $_SESSION['cart'][$productId] = 1;
    }
    // Update the cart count in the session
    $_SESSION['cart_count'] = array_sum($_SESSION['cart']);
  
    // Respond with success message or any necessary response
    echo "Product added to cart successfully";
} else {
    echo "No Product ID provided";
}

?>