<?php
session_start();

if (isset($_POST['id'], $_POST['quantity'], $_SESSION['cart'])) {
    $id = $_POST['id'];
    $quantity = $_POST['quantity'];

    // Update the quantity of the product with the given ID in the cart
    $_SESSION['cart'][$id] = $quantity;

    // Update the cart count
    $_SESSION['cart_count'] = array_sum($_SESSION['cart']);

    // Return success response
    echo json_encode(['status' => 'success']);
} else {
    // Return error response if required parameters are not provided
    echo json_encode(['status' => 'error', 'message' => 'Missing parameters']);
}
?>
