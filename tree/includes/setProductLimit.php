<?php


function set_maximum_quantity_for_products($product_quantity, $cart_item_key, $cart_item)
{
    $product_a = 479762;
    $product_b = 479763;

    // Set maximum quantities for each product
    $maximum_quantity_a = 20;
    $maximum_quantity_b = 50;

    // Check if the current item is product A
    if ($cart_item['product_id'] == $product_a && $cart_item['quantity'] > $maximum_quantity_a) {
        $product_quantity = $maximum_quantity_a;
    }

    // Check if the current item is product B
    if ($cart_item['product_id'] == $product_b && $cart_item['quantity'] > $maximum_quantity_b) {
        $product_quantity = $maximum_quantity_b;
    }

    return $product_quantity;
}

add_filter('woocommerce_cart_item_quantity', 'set_maximum_quantity_for_products', 10, 3);
