<?php
session_start();
$cart_count = isset($_SESSION['cart_count']) ? $_SESSION['cart_count'] : 0;
// Fetch data from the API
$url = 'https://fakestoreapi.com/products';
$response = file_get_contents($url);
$data = json_decode($response, true);

// Check if the request was successful
if ($response === false) {
    die('Error fetching data');
}

// Initialize subtotal variable
$subtotal = 0;
?>
<html>
<head>
  <title>ecart</title>
</head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="script.js"></script>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">

<body>
  <section class="h-auto gradient-custom">
    <div class="container py-5">
      <div class="h3 mb-3 teal-text text-center">Your Cart</div>
      <div class="row d-flex justify-content-center my-4">
        <div class="col-md-8">
          <div class="card mb-4">
            <div class="card-header py-3">
              <h5 class="mb-0">Cart - <?php echo $cart_count." Items"; ?></h5>
            </div>
            <div class="card-body">
              <!-- Single item -->
              <?php
              if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $productId => $quantity) {
                  foreach ($data as $product) { 
                    if ($product['id'] == $productId) { 
                        // Calculate subtotal for each product
                        $subtotal += $product['price'] * $quantity;
              ?>
              <div class="row">
                <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                  <!-- Image -->
                  <div class="bg-image hover-overlay hover-zoom ripple rounded" data-mdb-ripple-color="light">
                    <img src="<?php echo $product['image']; ?>" class="w-75" alt="<?php echo $product['title']; ?>" />
                    <a href="#!">
                      <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
                    </a>
                  </div>
                  <!-- Image -->
                </div>

                <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                  <!-- Data -->
                  <p><strong><?php echo substr($product['title'], 0, 25).".."; ?></strong></p>
                  <p>Description: <?php echo substr($product['description'], 0, 50); ?></p>
                  <p>Category: <?php echo $product['category']; ?></p>
                  <a href="deleteCart.php?id=<?php echo $product['id']; ?>" class="btn btn-sm me-1 mb-2" data-mdb-toggle="tooltip" name="delBtn">
                    <i class="fas fa-trash">
                      <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="25" height="25" viewBox="0,0,256,256">
                      <g fill="#fa5252" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(8.53333,8.53333)"><path d="M13,3c-0.26757,-0.00363 -0.52543,0.10012 -0.71593,0.28805c-0.1905,0.18793 -0.29774,0.44436 -0.29774,0.71195h-5.98633c-0.36064,-0.0051 -0.69608,0.18438 -0.87789,0.49587c-0.18181,0.3115 -0.18181,0.69676 0,1.00825c0.18181,0.3115 0.51725,0.50097 0.87789,0.49587h18c0.36064,0.0051 0.69608,-0.18438 0.87789,-0.49587c0.18181,-0.3115 0.18181,-0.69676 0,-1.00825c-0.18181,-0.3115 -0.51725,-0.50097 -0.87789,-0.49587h-5.98633c0,-0.26759 -0.10724,-0.52403 -0.29774,-0.71195c-0.1905,-0.18793 -0.44836,-0.29168 -0.71593,-0.28805zM6,8v16c0,1.105 0.895,2 2,2h14c1.105,0 2,-0.895 2,-2v-16z"></path></g></g>
                      </svg></i>
                  </a>
                    <button class="update-btn btn btn-sm me-1 mb-2" data-product-id="<?php echo $product['id']; ?>">
                    <svg version="1.1" viewBox="0 0 22 22" xmlns="http://www.w3.org/2000/svg" height="26" width="26">
                        <defs>
                            <style type="text/css" id="current-color-scheme">.ColorScheme-Text {
                            color:#232629;
                          }</style>
                        </defs>
                        <path class="ColorScheme-Text" fill="currentColor" d="m10.998047 6 4 4h-2v5h-4.0000001v-5h-2zm5.481971-0.4945913-2.480469 0.298829 0.5-0.867188c-2.9696-1.7145-6.7364095-1.027347-8.9121085 1.623047-2.1757 2.650394-2.113716 6.4760703 0.146484 9.0546873l-0.751953 0.658203c-2.5783-2.941475-2.649769-7.3262723-0.167969-10.349609 2.4818-3.023285 6.7980465-3.807312 10.185546-1.851562l0.5-0.865235zm2.517578 5.3671883c0.02996 1.841775-0.573553 3.69341-1.814453 5.205078-2.4819 3.023284-6.796094 3.807312-10.183594 1.851562l-0.5 0.865235-0.982422-2.298828 2.482422-0.298829-0.5 0.865235c2.9695995 1.7145 6.7344565 1.029299 8.9101565-1.621094s2.113715-6.4760703-0.146485-9.0546873l0.751953-0.658203c1.28915 1.470738 1.95246 3.302755 1.982422 5.1445313z"></path>
                    </svg>
                    </button>
                  <!-- Data -->
                </div>

                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                  <!-- Quantity -->
                  <div class="d-flex mb-4" style="max-width: 300px">
                    <button class="btn btn-primary px-3 py-3 me-2"
                      onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                      <i class="fas fa-minus">-</i>
                    </button>

                    <div class="form-outline">
                      <input id="quantity_<?php echo $product['id']; ?>" min="0" name="quantity" value="<?php echo $quantity; ?>" type="number" class="form-control" />
                      <label class="form-label" for="form1">Quantity</label></form>
                    </div>

                    <button class="btn btn-primary px-3 py-3 ms-2"
                      onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                      <i class="fas fa-plus">+</i>
                    </button>
                  </div>
                  <!-- Quantity -->

                  <!-- Price -->
                  <p class="text-start text-md-center">
                    <strong><?php echo "$".$product['price']; ?></strong>
                  </p>
                  <!-- Price -->
                </div>
              </div>
              <!-- Single item -->

              <hr class="my-4" />
                <?php  
                    }
                      }
                        } 
                          } else {
                              echo '<p>Your cart is empty</p>';
                          }
                ?>
            </div> 
                <span class="text-sm-end top-0 me-3 h6">Subtotal (<?php echo $cart_count." Items"; ?>): $<?php echo $subtotal; ?></span>
          </div>
    
          <div class="card mb-4 mb-lg-0">
            <div class="card-body">
              <p><strong>We accept</strong></p>
              <img class="me-2" width="45px"
                src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce-gateway-stripe/assets/images/visa.svg"
                alt="Visa" />
              <img class="me-2" width="45px"
                src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce-gateway-stripe/assets/images/amex.svg"
                alt="American Express" />
              <img class="me-2" width="45px"
                src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce-gateway-stripe/assets/images/mastercard.svg"
                alt="Mastercard" />
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card mb-4">
            <div class="card-header py-3">
              <h5 class="mb-0">Summary</h5>
            </div>
            <div class="card-body">
              <ul class="list-group list-group-flush">
                <li
                  class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                  Products
                  <span>$<?php echo $subtotal; ?></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                  Shipping
                  <span>Gratis</span>
                </li>
                <li
                  class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                  <div>
                    <strong>Total amount</strong>
                    <strong>
                      <p class="mb-0">(including VAT)</p>
                    </strong>
                  </div>
                  <span><strong>$<?php echo $subtotal; ?></strong></span>
                </li>
              </ul>
              <div class="text-center d-flex justify-content-between">
              <a href="#">
                <button type="button" class="btn btn-primary btn-md btn-block text-center">Checkout</button></a>  
              <a href="index.php">
                <button type="button" class="btn btn-primary btn-md btn-block text-center">Back to Shop</button></a>  
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://replit.com/public/js/replit-badge-v2.js" theme="dark" position="bottom-right"></script>
    </body>
  </html>
