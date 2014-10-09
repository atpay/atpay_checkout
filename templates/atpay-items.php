<style>
  .atpay_items{
    width:  90%;
    margin: 20px auto;
  }
  .atpay_item{
    width:20%;
    float:left;
    margin: 0 2.4% 20px;
    padding:20px 10px;
    text-align: center;
    background-color: #ffffff;
    -webkit-box-shadow: 1px 1px 5px 0px rgba(50, 50, 50, 0.45);
    -moz-box-shadow:    1px 1px 5px 0px rgba(50, 50, 50, 0.45);
    box-shadow:         1px 1px 5px 0px rgba(50, 50, 50, 0.45);
  }
  .atpay_item h3{
      line-height: 24px !important;
      font-size:18px !important;
  }
  .atpay_item p{
      margin:0 !important;
      padding: 0 !important;
  }
  .atpay_item p.price{
      margin:7px !important;
      padding: 0 !important;
  }
  .atpay_item p.added{
      margin:2px !important;
  }
  .atpay_item img{
    max-width:90%;
    max-height: 150px;
    height: auto;
    width:auto;
    margin: 15px 0 0;
    border: 1px solid gray;
  }
  .atpay_item a, .featherlight-content input[type="submit"], a.mobile_checkout, a.desktop_checkout, a.clear{
    display:inline-block !important;
    padding:5px 15px;
    background-color: #6DBE45;
    margin:5px 0;
    color: #fff;
    border: 1px solid lightgrey;
    font-family: Lato;
    font-weight: 300;
    font-size:18px !important;
  }
  .featherlight .featherlight-content{
    min-width:250px !important;
  }
  .featherlight-content label,.featherlight-content input, .featherlight-content select {
    width:90%;
    display:block;
  }
  .featherlight-content input, .featherlight-content select{
    margin-bottom:10px;
    margin-top:5px;
  }
  @media only screen
  and (min-device-width : 320px)
  and (max-device-width : 568px) {
    .atpay_item{
      width:90%;
      margin: 20px auto !important;
      padding:20px 10px;
      float: none;
      text-align: center;
      background-color: #ffffff;
      -webkit-box-shadow: 1px 1px 5px 0px rgba(50, 50, 50, 0.45);
      -moz-box-shadow:    1px 1px 5px 0px rgba(50, 50, 50, 0.45);
      box-shadow:         1px 1px 5px 0px rgba(50, 50, 50, 0.45);
    }
    .atpay_items{
      width:  100%;
      margin: 20px auto;
    }
  }
</style>
<script>
    jQuery(document).ready(function($) {
      jQuery('.atpay_items').show();
      var highest = 0; // keep track of the greatest height
      jQuery('.atpay_item').each(function() { // for each element
          if (jQuery(this).height() > highest) { // compare heights
              highest = $(this).height();
          }
      });
      jQuery('.atpay_item').height('300');
    });
</script>

<?php $loop = new WP_Query( array( 'post_type' => 'atpay-item', 'posts_per_page' => -1, 'order' => "ASC" ) ); ?>

<div class="atpay_items" style="display:none;">

  <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

    <?php
      $price          = preg_replace('/[\$,]/', '', @get_post_meta(get_the_ID(), 'price', true)   );
      $custom_options = urlencode(get_post_meta( get_the_ID(), "custom_options", true ));
      $ref            = @get_post_meta(get_the_ID(), 'ref', true);
    ?>

    <div class="atpay_item cart_<?php echo $ref; ?>">
      <h3><?php the_title(); ?></h3>
      <?php  echo the_post_thumbnail($post->id, 'full'); ?>
      <p class="price">Price: $<?php echo $price; ?></p>
      <?php  echo do_shortcode('[@pay-add-2-cart desc="'.get_the_title().'" price="'.$price.'" ref="'.$ref.'" options="'.$custom_options.'"]'); ?>
      <p class="added"></p>
    </div>

  <?php endwhile; ?>

</div>

<div style="clear:both; margin-bottom:20px;"> </div>
