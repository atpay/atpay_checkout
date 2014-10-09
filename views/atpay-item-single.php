<?php
get_header();
if (have_posts()) :
   while (have_posts()) :
      the_post();?>
      
      
<?php 
$btn_color = get_option('btn_color');
$btn_img = get_option('btn_img');      
$txt_color = get_option('txt_color');      
$bttn_wrap = get_option('bttn_wrap');      
$bttn_wrap_txt = get_option('bttn_wrap_txt');      
$bttn_icon = get_option('bttn_icon'); 
$price = preg_replace('/[\$,]/', '', @get_post_meta($post->ID, 'price', true)   ); 

$ref = @get_post_meta($post->ID, 'ref', true);

if($bttn_icon == 'dark'){
$btn_img = 'https://atpay.com/wp-content/themes/atpay/images/bttn_cart_gray.png';

}else{
$btn_img = "https://atpay.com/wp-content/themes/atpay/images/bttn_cart_white.png";
}

?>


<h1><?php the_title(); ?></h1>

<?php the_post_thumbnail( ); ?> 

<?php 
echo do_shortcode('[@pay-item price="'.$price.'" ref="'.$ref.'"]');
?>

<?php 
echo do_shortcode('[@pay-add-2-cart price="'.$price.'" ref="'.$ref.'"]');
?>





<p><?php the_content(); ?></p>

<?php endwhile; endif; ?>
  
<?php get_footer();  ?>