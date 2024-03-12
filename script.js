//operation for load more button 
$(document).ready(function() {
    $('#load-more').on('click', function() {
        var start = $('.card').length; // Number of products already loaded
        var perLoad = 4; // Number of products to load per click

        $.get('load-more-products.php', { start: start, perLoad: perLoad })
              .done(function(data) {
              if (data.trim() === '') {
                  // No more products to load, disable the button
                  $('#load-more').prop('disabled', true);
              } else {
                  // Append new products to container
                  $('#product-container').append(data);
              }
            })
            .fail(function(xhr, status, error) {
                console.error('Error loading more products:', error);
            });
    });
});
  
// {/* //add to cart operation */}
  $(document).ready(function(){
    $('.add-to-cart').click(function(){
      var productId = $(this).data('product-id');
      console.log(productId);
      $.ajax({
          url: 'addToCart.php',
          method: 'POST',
          data: { productId: productId },
          success: function(response) {
              // Update cart count displayed in the navigation bar
              var cartCount = parseInt($('.badge.bg-secondary').text());
              $('.badge.bg-secondary').text(cartCount + 1);

            // Show a toast message
            var toast = $('#liveToast');
            toast.find('.toast-body').text('Product added to cart successfully');
            toast.toast({ delay: 2000, autohide: true }); // Set duration and autohide
            toast.toast('show');
            },
          error: function(xhr, status, error) {
              console.error('Error adding item to cart:', error);
          }
      });
    });
  });

//update the cart quantity
$(document).ready(function() {
    // Update cart quantity
    $('.update-btn').click(function() {
        var productId = $(this).data('product-id');
        var newQuantity = $('#quantity_' + productId).val();
    
        // AJAX request to update quantity
        $.ajax({
            url: 'updateCart.php',
            type: 'POST',
            dataType: 'json',
            data: {
                id: productId,
                quantity: newQuantity
            },
            success: function(response) {
                if (response.status === 'success') {
                    // Reload the page to reflect the changes
                    location.reload();
                } else {
                    // Handle error
                    alert('Error: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert('Error: Unable to update cart quantity.');
            }
        });
    });
});
