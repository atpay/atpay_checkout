<?php

function sdk_setup(){ ?>


  <script src="https://code.jquery.com/jquery-1.11.1.min.js"> </script>
  <script src='https://dashboard.atpay.com/sdk/v3.js'></script>

  <script type="text/javascript">
    jQuery(function($){
      atpay.config({
        partner_id: <?php echo $bttn_icon = get_option('prod_partner_id'); ?>
      });
    });

    function atPayReturn(data) {

      $(".atpay_overlay").fadeOut(1000);
      alert('Thank You, Your Purchase is Complete!');
      atPayResponse = data;
      if(localStorage[atPayResponse.referrer_context]){
        localStorage[atPayResponse.referrer_context]=Number(localStorage[atPayResponse.referrer_context])+1;
      } else {
        localStorage[atPayResponse.referrer_context]=1;
      }
    } // end atPayReturn

  </script>


<?php }


add_action('wp_footer', 'sdk_setup', 20);

function rm_autop() {
	global $posts;

    // get the posts
    foreach ($posts as $post) {
	    // Get the keys and values of the custom fields:
	    $id = $post->ID;
	    $rmautop = get_post_meta($id, 'rm_autop', true);

	    // Remove the filter
	    if ($rmautop === 'true') {
            remove_filter('the_content',  'wpautop');
	    }
    }
}

// Hook into the Plugin API
add_action('wp_head', 'rm_autop');
