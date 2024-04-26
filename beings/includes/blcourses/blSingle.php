<?php

function bulkPurchaseSingleCourse()
{
?>
    <div class="sh-container-bulk">
        <div class="quantity-sec-single-23-sh">
            <div class="price">
                £11 <span>/Unit Price</span>
            </div>
            <div class="total-price">
                £110
            </div>
            <h5>Quantity:</h5>
            <div class="for-without-width-and-flex">
                <button class="button" onclick="decrement()">-</button>
                <input id="demoInput" type="number" value="10" min="10" max="500">
                <button class="button" onclick="increment()">+</button>
            </div>
            <div class="add-to-cart-ctm">
                <a class="sa_ctm_btn" href="<?php echo site_url(); ?>/cart/?add-to-cart=23161" data-quantity="10">Add to Cart</a>
            </div>
        </div>
    </div>

    <script>
    
        jQuery.noConflict();

        jQuery(document).ready(function($) {
            $("button").click(function() {
                updatePriceAndQuantity();
            });

            $(".sa_ctm_btn").click(function(event) {
                event.preventDefault();
                var selectedQuantity = $(this).attr("data-quantity");
                window.location.href = $(this).attr("href") + "&quantity=" + selectedQuantity;
            });
        });

        // Functions using jQuery
        function increment() {
            jQuery('#demoInput').val(parseInt(jQuery('#demoInput').val()) + 1);
            updatePriceAndQuantity();
        }

        function decrement() {
            jQuery('#demoInput').val(parseInt(jQuery('#demoInput').val()) - 1);
            updatePriceAndQuantity();
        }

        function updatePriceAndQuantity() {
            var inputVal = jQuery('#demoInput').val();
            var addToCartBtn = jQuery(".sa_ctm_btn");

            if (inputVal >= 10 && inputVal <= 49) {
                addToCartBtn.attr("data-quantity", inputVal);
                jQuery(".price").html("£11<span>/Unit Price</span>");
                jQuery(".total-price").html("£" + (inputVal * 11).toFixed(2));
            } else if (inputVal >= 50 && inputVal <= 99) {
                addToCartBtn.attr("data-quantity", inputVal);
                jQuery(".price").html("£9<span>/Unit Price</span>");
                jQuery(".total-price").html("£" + (inputVal * 9).toFixed(2));
            } else if (inputVal >= 100 && inputVal <= 500) {
                addToCartBtn.attr("data-quantity", inputVal);
                jQuery(".price").html("£7<span>/Unit Price</span>");
                jQuery(".total-price").html("£" + (inputVal * 7).toFixed(2));
            }
        }
    </script>
<?php
}
add_shortcode('bulk_purchase_single', 'bulkPurchaseSingleCourse');
?>