<?php 
session_start();

if(isset($_GET['id']) && isset($_SESSION['cart'])){
    $id = $_GET['id'];
    $cart = $_SESSION['cart'];

    // Check if the product ID exists in the cart
    if(isset($cart[$id])) {
        // Remove the product with the given ID from the cart
        unset($cart[$id]);
        // Update the cart session variable
        $_SESSION['cart'] = $cart;
        // Update the cart count
        $_SESSION['cart_count'] = array_sum($cart);
    }
    // Redirect back to the cart page
    header('Location: cart.php');
    exit;
}
  

?>