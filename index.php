<?php 
    session_start();
    $cartCount = isset($_SESSION['cart_count']) ? $_SESSION['cart_count'] : 0;
?>
<html>
  <head>
    <title>ecart</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
  </head>

  <body>
    <div class="container-sm text-center">
      <?php
        $url = 'https://fakestoreapi.com/products';
        $response = file_get_contents($url);

        if ($response === false) {
            die('Error fetching data');
        }

        $data = json_decode($response, true);
      ?>
    
      <?php
        include ('nav.php');
        if(isset($_GET['category'])) {
          $selectedCategory = $_GET['category'];
          ?>
          <div class="row mt-4" id="product-container">
            <h3><?php echo "List of ".$selectedCategory." Products:"; ?></h3>
              <?php 
                foreach ($data as $items): 
                  if ($items['category'] === $selectedCategory) {
              ?>
                <div class="col-md-3 mt-3 gap-3">
                  <div class="card h-100 d-flex flex-column">
                    <div class="d-flex justify-content-center align-items-center" style="height: 200px;">
                      <img class="rounded mt-2" src="<?php echo $items['image']; ?>" alt="<?php echo $items['title']; ?>" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                    </div>
                    <div class="card-body">
                      <h5 class="card-title"><?php echo substr($items['title'], 0, 25).".."; ?></h5>
                      <p class="card-description"><?php echo substr($items['description'], 0, 80); ?></p>
                      <p class="card-text"><?php echo "$".$items['price']; ?></p>
                      <button class="btn btn-primary mt-auto add-to-cart" data-product-id="<?php echo $items['id']; ?>">Add to Cart</button>
                    </div>
                  </div>
                </div>
              <?php
                  }
                endforeach; 
              ?>
          </div>
        <?php 
        } else {
          ?>
          <div class="row mt-4" id="product-container">
            <?php 
              $count = 0;
              foreach ($data as $items): 
                if( $count === 16){
                  break;
                }
            ?>
              <div class="col-md-3 mt-3 gap-3">
                <div class="card h-100 d-flex flex-column">
                  <div class="d-flex justify-content-center align-items-center" style="height: 200px;">
                    <img class="card-img-top rounded mt-2" src="<?php echo $items['image']; ?>" alt="<?php echo $items['title']; ?>" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                  </div>
                  <div class="card-body">
                    <h5 class="card-title"><?php echo substr($items['title'], 0, 25).".."; ?></h5>
                    <p class="card-description"><?php echo substr($items['description'], 0, 80); ?></p>
                    <p class="card-text"><?php echo "$".$items['price']; ?></p>
                    <button class="btn btn-primary mt-auto add-to-cart" data-product-id="<?php echo $items['id']; ?>">Add to Cart</button>
                  </div>
                </div>
              </div>
            <?php
              $count++;
              endforeach; 
            ?>
          </div> 
          <button class="btn btn-success mt-3" id="load-more" type="button">Load More</button>
        <?php } ?>

      <div class="toast-container position-fixed top-0 end-0 p-3 ">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="toast-header">
            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="35" height="35" viewBox="0 0 48 48">
            <path fill="#c8e6c9" d="M44,24c0,11.045-8.955,20-20,20S4,35.045,4,24S12.955,4,24,4S44,12.955,44,24z"></path><path fill="#4caf50" d="M34.586,14.586l-13.57,13.586l-5.602-5.586l-2.828,2.828l8.434,8.414l16.395-16.414L34.586,14.586z"></path>
            </svg>
            <strong class="me-auto">Success</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
          <div class="toast-body bg-success text-white">
          </div>
        </div>
      </div>

      <div class="footer mt-3">
        <p>All Copyright Reserve @ 2023 Pk Pandu</p>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://replit.com/public/js/replit-badge-v2.js" theme="dark" position="bottom-right"></script>

  </body>
</html>