<?php 
// Fetch data from the API
$url = 'https://fakestoreapi.com/products';

$response = file_get_contents($url);  

// Check if the request was successful
if ($response === false) {
    die('Error fetching data');
}

// Decode JSON response
$data = json_decode($response, true);

// Retrieve start and perLoad parameters from the AJAX request
$start = isset($_GET['start']) ? intval($_GET['start']) : 0;
$perLoad = isset($_GET['perLoad']) ? intval($_GET['perLoad']) : 0;

for ($i = $start; $i < min($start + $perLoad, count($data)); $i++) {
    $product = $data[$i];
    // Generate HTML markup for each product
    echo '<div class="col-md-3 mt-3 gap-3">';
    echo '<div class="card h-100 d-flex flex-column">';
    echo '<div class="d-flex justify-content-center align-items-center" style="height: 200px;">';
    echo '<img class="card-img-top rounded mt-2" src="' . $product['image'] . '" alt="' . $product['title'] . '" style="max-width: 100%; max-height: 100%; object-fit: contain;">';
    echo '</div>';
    echo '<div class="card-body">';
    echo '<h5 class="card-title">' . $product['title'] . '</h5>';
    echo '<p class="card-description">' . substr($product['description'], 0, 80) . '</p>';
    echo '<p class="card-text">$' . $product['price'] . '</p>';
    echo '<button class="btn btn-primary mt-auto add-to-cart" data-product-id="' . $product['id'] . '">Add to Cart</button>';


    echo '</div>';
    echo '</div>';
    echo '</div>';
}
?>
