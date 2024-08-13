<?php 
/**
 * Plugin Name: ecommerce-wc
 * Description: hello
 * Version: 1.0
 * Author: Rupom
 * Text Domain: 
 * 
 */
function display_category_products_before_shop_loop() {
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'product_cat',
                'field'    => 'slug',
                'terms'    => 'tshirts',
            ),
        ),
    );
    $query = new WP_Query($args);
    if ($query->have_posts()) {
        echo '<div class="category-products-before-loop">';
        while ($query->have_posts()) {
            $query->the_post();
            wc_get_template_part('content', 'product');
        }
        echo '</div>';
    } else {
        echo '<p>No products</p>';
    }
    wp_reset_query();
}

add_action('woocommerce_before_shop_loop', 'display_category_products_before_shop_loop', 5);
