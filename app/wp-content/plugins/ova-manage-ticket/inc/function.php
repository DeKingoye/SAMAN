<?php

function ovatm_get_products( $slug ){
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => '-1',
        'post_status'   => 'publish',
        'name'	=> $slug
    );
    $product = new WP_Query( $args );
    return $product;
}

// Remove Product without Category
add_action( 'woocommerce_product_query', 'ovamt_pre_get_posts_query' );
function ovamt_pre_get_posts_query( $q ) {

    $tax_query = (array) $q->get( 'tax_query' );

    $tax_query[] = array(
           'taxonomy' => 'product_cat',
           'field' => 'slug',
           'terms' => array( 'ticket' ), // Don't display products in the clothing category on the shop page.
           'operator' => 'NOT IN'
    );


    $q->set( 'tax_query', $tax_query );

}

add_filter( 'ovamt_ticket_product_settings', 'ovamt_ticket_product_settings');
function ovamt_ticket_product_settings() {   
    return OVAMT_Settings::ovamt_product_slug();
}