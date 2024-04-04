<?php

/* Short Description and limitations to woo product by shoive start */

add_action('woocommerce_before_cart', 'action_before_cart');

function action_before_cart()
{
    $has_exclude_category = false;
    $is_product_a_in_cart = WC()->cart->find_product_in_cart(WC()->cart->generate_cart_id(247209));
    $cart_count = WC()->cart->get_cart_contents_count();

    foreach (WC()->cart->get_cart() as $cart_item) {
        if (has_term('ex-cross-sale', 'product_cat', $cart_item['product_id'])) {
            $has_exclude_category = true;
            break;
        }
    }

    if ($has_exclude_category || ($is_product_a_in_cart && $cart_count == 1)) {
        remove_functions();
    } elseif ($is_product_a_in_cart && $cart_count > 0 && !$has_exclude_category) {
        add_functions();
    } else {
        add_functions();
    }
}

function add_functions()
{
    add_filter('woocommerce_cart_item_name', 'excerpt_in_cart', 40, 2);
    add_action('woocommerce_before_cart_item_quantity_zero', 'prevent_quantity_zero_for_product_a', 10, 2);
    add_filter('woocommerce_cart_item_quantity', 'set_minimum_quantity_for_product_a', 10, 3);
    add_filter('woocommerce_cart_item_remove_link', 'remove_cross_icon_for_product_a', 10, 2);
    add_filter('woocommerce_cart_item_quantity', 'bloomer_woocommerce_quantity_min_50_eur_cart', 9999, 3);
}

function remove_functions()
{
    remove_filter('woocommerce_cart_item_name', 'excerpt_in_cart', 40);
    remove_action('woocommerce_before_cart_item_quantity_zero', 'prevent_quantity_zero_for_product_a', 10);
    remove_filter('woocommerce_cart_item_quantity', 'set_minimum_quantity_for_product_a', 10);
    remove_filter('woocommerce_cart_item_remove_link', 'remove_cross_icon_for_product_a', 10);
    remove_filter('woocommerce_cart_item_quantity', 'bloomer_woocommerce_quantity_min_50_eur_cart', 9999);
}

function excerpt_in_cart($cart_item_html, $product_data)
{
    $excerpt = get_the_excerpt($product_data['product_id']);
    $excerpt = substr($excerpt, 0, 80);

    return $cart_item_html . '<br><p class="shortDescription">' . $excerpt . '</p>';
}

function prevent_quantity_zero_for_product_a($cart_item_key, $cart_item)
{
    $product_a = 247209;

    if ($cart_item['product_id'] == $product_a && $cart_item['quantity'] === 0) {
        WC()->cart->set_quantity($cart_item_key, 1);
    }
}

function set_minimum_quantity_for_product_a($product_quantity, $cart_item_key, $cart_item)
{
    $product_a = 247209;

    if ($cart_item['product_id'] == $product_a && $cart_item['quantity'] < 1) {
        $product_quantity = 1;
    }

    return $product_quantity;
}

function remove_cross_icon_for_product_a($link, $cart_item_key)
{
    $product_a = 247209;

    if (WC()->cart->get_cart()[$cart_item_key]['product_id'] == $product_a) {
        return '';
    }

    return $link;
}

function bloomer_woocommerce_quantity_min_50_eur_cart($product_quantity, $cart_item_key, $cart_item)
{
    $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
    $min = 0;

    if (247209 === $_product->get_id()) {
        $min = 1;
    }

    $product_quantity = woocommerce_quantity_input(array(
        'input_name'   => "cart[{$cart_item_key}][qty]",
        'input_value'  => $cart_item['quantity'],
        'max_value'    => $_product->get_max_purchase_quantity(),
        'min_value'    => $min,
        'product_name' => $_product->get_name(),
    ), $_product, false);

    return $product_quantity;
}


/* Short Description and limitations to woo product by shoive end */
