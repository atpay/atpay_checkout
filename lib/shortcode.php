<?php
function rm_wpautop($content) {
    global $post;
    // Remove the filter
    remove_filter('the_content', 'wpautop');
    return $content;
}

// Hook into the Plugin API
add_filter('the_content', 'rm_wpautop', 9);


function atpay_add_2_cart( $atts ) {
    extract( shortcode_atts( array(
        'price' => '10.00',
        'ref'   => 'atpay-item',
        'desc'  => 'description',
        'options' => ''

    ), $atts ) );

    $price = "{$price}";
    $ref = "{$ref}";
    $options = "{$options}";

    ob_start();
    include(dirname( __FILE__ ) . '/../templates/button_cart.php');
    $string = ob_get_clean();
    return $string;
}
add_shortcode( '@pay-add-2-cart', 'atpay_add_2_cart' );




function atpay_items( ) {
    ob_start();
    include(dirname( __FILE__ ) . '/../templates/atpay-items.php');
    $string = ob_get_clean();
    return $string;
}




function atpay_item( $atts ) {
    extract( shortcode_atts( array(
        'price' => '10.00',
        'ref' => 'atpay-item',
        'color' => 'red',
        'token' => ''

    ), $atts ) );

    $price = "{$price}";
    $ref = "{$ref}";
    $color = "{$color}";
    $token = "{$token}";

    ob_start();
    include(dirname( __FILE__ ) . '/../templates/button.php');
    $string = ob_get_clean();
    return $string;
}


function atpay_session() {
    ob_start();
    include(dirname( __FILE__ ) . '/../templates/atpay-session.php');
    $string = ob_get_clean();
    return $string;
}


function atpay_cart() {
    ob_start();
    include(dirname( __FILE__ ) . '/../templates/atpay-cart.php');
    $string = ob_get_clean();
    return $string;
}
add_shortcode( '@pay-cart', 'atpay_cart' );

function atpay_cart_button() {
    ob_start();
    include(dirname( __FILE__ ) . '/../templates/atpay-cart-button.php');
    $string = ob_get_clean();
    return $string;
}
add_shortcode( '@pay-cart-button', 'atpay_cart_button' );



function pre_process_shortcode($content) {
    global $shortcode_tags;

    // Backup current registered shortcodes and clear them all out
    $orig_shortcode_tags = $shortcode_tags;
    $shortcode_tags = array();


        add_shortcode( '@pay-login-status', 'atpay_session' );
        add_shortcode( '@pay-item', 'atpay_item' );
        add_shortcode( '@pay-items', 'atpay_items' );


    // Do the shortcode (only the one above is registered)
    $content = do_shortcode($content);

    // Put the original shortcodes back
    $shortcode_tags = $orig_shortcode_tags;

    return $content;
}

add_filter('the_content', 'pre_process_shortcode', 7);
