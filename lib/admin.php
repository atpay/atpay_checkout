<?php

////
// PLUGIN ADMIN NAVIGATION

add_action( 'admin_menu', 'atpay_offer_menu' );

function atpay_offer_menu(){
  add_menu_page('@Pay Offers', '@Pay Offers', 'manage_options', 'atpay_offers_page','atpay_offers_page','',58);
  remove_menu_page('edit.php?post_type=atpay-offer');
}

function atpay_offers_page(){
  include(sprintf("%s/../templates/atpay-offers.php", dirname(__FILE__)));
}


////
// CONFIGURATION CHECK

function config_check(){
  if(!get_option('atpay_env') OR (!get_option('sb_partner_id') and !get_option('prod_partner_id')) ){
    echo "<div class='updated' style='background-color: #d54f4f; border:1px solid #993838; height:30px; color:#fff; text-align:center; padding:10px 0; font-size:16px;'>
    <img src='https://www.atpay.com/wp-content/themes/atpay/images/atpay_logo_42@2x.png' style='height:25px;margin-top:3px; margin-left:20px; float:left;'> <p style='float:left;'>Connect
    &nbsp; &nbsp; &nbsp;
    <a href='edit.php?post_type=atpay-item&page=atpay-item' style='color:#fff; text-decoration:underline;'>Configure now to start selling online.</a></p>
    </div>";
  }
}

add_action('admin_notices', 'config_check', 999);




///
// TEMPLATE INIT

function atpay_templates( $template ) {
    $post_types = array( 'atpay-item' );
    if ( is_post_type_archive( $post_types ) && ! file_exists( get_stylesheet_directory() . '/post-type-template.php' ) ) {
        $template = plugin_dir_path( __FILE__ ) . '/../views/atpay-item-archive.php';
    }
    if ( is_singular( $post_types ) && ! file_exists( get_stylesheet_directory() . '/post-type-template.php' ) ){
        $template = plugin_dir_path( __FILE__ ) . '/../views/atpay-item-single.php';
    }

    return $template;
}

add_filter( 'template_include', 'atpay_templates' );
