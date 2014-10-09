<?php
add_filter( 'the_content', 'shortcode_unautop', 100 );

?>
<style>
  #atpay_cart {width: 100%}
  #atpay_cart td, #totals td {padding: 5px; background-color: #e9e9e9; border:2px solid #fff;}
  #atpay_cart tr#atpay_cart_header td {background-color: #666; color:#fff;}
  #totals span {font-size:1.1em; font-weight: bold;}
  a.mobile_checkout, a.desktop_checkout{
    background-color:  rgba(45, 125, 151, 0.9);
  }
  a.clear{
    background-color: grey !important;
  }
  @media only screen
  and (min-device-width : 320px)
  and (max-device-width : 568px) {
    a.mobile_checkout, a.desktop_checkout, a.clear{
      float:left !important:
      margin: 0 auto !important;
      display:block !important;
      width:49%;
      text-align:center;
      font-size:10px !important;
    }
  }
</style>


<div style="border:1px solid #000; margin:0 auto; width:86%; padding:10px;" class="atpay_cart_wrap">
  <?php if(AtPay_Connect::mobile_device( )){ ?>
    <a border='0' class='mobile_checkout' href='javascript:void(0)' onclick="mobile_checkout(breakdown)" style='text-underline:none; display:block;'>
      Checkout
    </a>
    <a border='0' class='clear' href='javascript:void(0)' onclick="atPayClearCart();" style='text-underline:none; display:block; '>
    Clear Cart
    </a>
    <?php } ?>


<table id="atpay_cart" style="width:100%;">
 <thead>
  <tr id="atpay_cart_header">
    <td>
      Items
    </td>
    <?php if(!AtPay_Connect::mobile_device( )){ ?>
      <td width="110px">
        Price
      </td>
      <td width="90px">
        Amount
      </td>
      <td width="100px">
        Total
      </td>
    <?php } ?>
  </tr>
</thead>
  <tbody>
  </tbody>
</table>


<table id="totals" style="float:right; max-width:100%; text-align:center">
<tr>
<td>Total Items: <span id="total_items"></span> </td>
<td>Total Purchase: $<span id="total_qty"></span> </td>
</tr>
</table>

  <div id="cart_actions" style="float:left; margin-top:10px; margin-left:5px;">
    <?php if(!AtPay_Connect::mobile_device( )){ ?>

      <a border='0' class='desktop_checkout' href='javascript:void(0)' onclick="desktop_checkout(breakdown)" style='text-underline:none; display:block;'>
        Checkout
      </a>
<a border='0' class='clear' href='javascript:void(0)' onclick="atPayClearCart();" style='text-underline:none; display:block; '>
Clear Cart
</a>
    <?php } ?>




  </div>

<div style="clear:both;"> </div>

</div>


<script type="text/javascript">
jQuery( document ).ready(function() {
  atPayCheckCart();
});
</script>
