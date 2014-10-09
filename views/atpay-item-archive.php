<?php get_header(); ?>

<div style="width:80%; margin:20px auto;">

<h2 style="text-transform: uppercase;"> <?php echo get_option('store_slug'); ?></h2>

<?php echo do_shortcode("[@pay-cart]"); ?>



<?php while ( have_posts() ) : the_post(); ?>

<div style="overflow:hidden; height: auto; width:600px; float: left; margin:60px 0 20px 20px;">

<?php
$btn_color = get_option('btn_color');
$btn_img = get_option('btn_img');
$txt_color = get_option('txt_color');
$bttn_wrap = get_option('bttn_wrap');
$bttn_wrap_txt = get_option('bttn_wrap_txt');
$bttn_icon = get_option('bttn_icon');
$price = preg_replace('/[\$,]/', '', @get_post_meta($post->ID, 'price', true)   );
$custom_options = urlencode(get_post_meta( get_the_ID(), "custom_options", true ));
$ref = @get_post_meta($post->ID, 'ref', true);
if($bttn_icon == 'dark'){
$btn_img = 'https://atpay.com/wp-content/themes/atpay/images/bttn_cart_gray.png';
}else{
$btn_img = "https://atpay.com/wp-content/themes/atpay/images/bttn_cart_white.png";
}
?>


<div style="float:left;">
<?php  echo the_post_thumbnail($post->id, 'full'); ?>
<?php
  // echo do_shortcode('[@pay-item price="'.$price.'" ref="'.$ref.'"]');
?>

<?php
  echo do_shortcode('[@pay-add-2-cart desc="'.get_the_title().'" price="'.$price.'" ref="'.$ref.'" options="'.$custom_options.'"]');
?>
</div>


<div style="float:left; max-width:250px; margin-left:20px; padding-top:10px;">

<h3><?php the_title(); ?></h3>

<?php the_content( ); ?>

</div>


</div>

<?php endwhile; ?>

<div style="clear:both;"> </div>
</div>

<?php get_footer(); ?>
