<?php
add_filter( 'the_content', 'shortcode_unautop', 100 );
?>
<style>
  .atpay_cart_button{
    float:right;
    margin-top:15px;
    margin-right:20px;
    background-color: #6dbe45;
    display: inline-block;
    color: #fff;
    padding:5px;
    font-size: 14px;
    line-height:24px;
  }
  .atpay_cart_button img{
    height:20px;
    margin-right:5px;
  }
  .atpay_cart_button a{
    color: #ffffff;
    display:block;
    width:100%;
    height:100%;
  }
  .atpay_cart_button .atpay_cart_wrap{
    display:none;
  }
  .atpay_cart_button_form{
    display:none;
    position:absolute;
    top:80px;
    z-index: 99999999;
  }
  <?php if(AtPay_Connect::mobile_device( )){ ?>
    .featherlight-content{
    top:30px !important;
    padding-top:30px !important;
    }
    .mobile-scroll{
      width:100%;
      height:300px;
      overflow:scroll;
      padding-bottom:40px;
    }

  <?php } ?>
  .noscroll{
    position:fixed !important;
    overflow:hidden !important;
    width:100% !important;
  }
</style>

<div class="atpay_cart_button">
  <a href="#">
    <img src="http://donate.atpay.com/wp-content/plugins/atpay-jssdkv1.1/assets/images/bttn_cart_white.png">
    Cart (<span id="total_items">0</span>)
  </a>

<?php echo do_shortcode('[@pay-cart]'); ?>

</div>

<script>
  light_status = null
jQuery(".atpay_cart_button a").click(function(e){
  e.preventDefault();

  if(light_status == null){
  cart = $(".atpay_cart_button .atpay_cart_wrap").html();
  $.featherlight("<div class='mobile-scroll'>"+cart+"</div>", {
    beforeOpen: function(){jQuery("body").addClass("noscroll");},
    beforeClose: function(){jQuery("body").removeClass("noscroll");}
  });
  light_status = true
} else {
  $.featherlight.close();
  light_status = null
}


});
</script>
