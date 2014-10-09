<?php
$btn_color = $color;
$btn_img = get_option('btn_img');
$txt_color = get_option('txt_color');
$bttn_wrap = get_option('bttn_wrap');
$bttn_wrap_txt = get_option('bttn_wrap_txt');
$bttn_icon = get_option('bttn_icon');
if($bttn_icon == 'dark'){
$btn_img = plugins_url( 'assets/images/bttn_cart_gray.png' , dirname(__FILE__) );

}else{
$btn_img = plugins_url( 'assets/images/bttn_cart_white.png' , dirname(__FILE__) );

}
?>


<?php
  $price = "$".number_format($price, 2, '.', '');
  preg_match("/\d+(?=\.)/", "$price", $dollar);
  preg_match("/(?<=\.)[^.]*/", $price, $cents);

?>



<style>
table#button_cl, #button_cl table {width: auto; padding: 0 ; margin: 0 ; border:0px;}
table#button_cl td, #button_cl table td {border: 0px; padding:0px;}
table#button_wrp{width: auto; padding: 0 ; margin: 0 ; border:0px; border-top: 0;}
div.bttn_hold{
  width: -moz-max-content;
  width: intrinsic;
  margin-top: 10px;
  margin-bottom: 10px;
  float:left;
  margin:0 70px;
}
div.bttn_hold span{
  color: #999999;
  font-style: italic;
  font-size: 13px;
  text-align: center;
  margin: 0 auto;
  width: 100%;
  display: block;
}
div.bttn_wrp{
  width: -moz-max-content;
  width: intrinsic;
  border-radius: 0;
  box-shadow: 0;
  padding: 4px;
  border: 1px solid #bdbdc1 !important;
  padding-left: 14px;
  padding-right: 14px;
  padding-bottom: 5px;
  width:200px;
  margin-bottom:50px;
  float:left;
}
div.bttn_wrp img{
  border-radius: 0 !important;
  box-shadow: none !important;
}
div.bttn_wrp p{
margin:0;
padding: 0;
text-align: center;
padding-bottom: 0;
font-size: 12px;
}
div.bttn_wrp img.tag{
padding: 0 !important;
margin-top: 5px;
}
.atpay_overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgb(0, 0, 54); /* The Fallback */
    background: rgba(0, 0, 0, 0.5);
    z-index: 10000;
    color: #fff;
    background-repeat: no-repeat;
    background-position-x:50%;
    background-position-y:40%;
}
.atpay_overlayB {
    filter:alpha(opacity=9);
    -moz-opacity:0.9;
    -khtml-opacity: 0.9;
    opacity: 0.9;
    margin: 20% auto;
    width: 140px;
    height: 130px;
    background-color: #fff;
    z-index: 10000;
    color: #fff;
    background-image: url("<?php echo plugins_url( 'assets/images/loader.gif' , dirname(__FILE__) );  ?>");
    background-repeat: no-repeat;
    background-position-x:20px;
    background-position-y:20px;
    background-position: 20px 20px;
    border: 2px solid #000;
}
@media only screen
and (min-device-width : 320px)
and (max-device-width : 568px) {
div.bttn_hold{
  width: 90%;
  float:none;
  margin:0px auto !important;
}
div.bttn_wrp{
  width:100%;
  margin: 20px auto !important;
}
}
</style>





<div class="bttn_hold">


<?php

if($bttn_wrap == "on"){ ?>


<div class="bttn_wrp" style="">

  <p style="text-align:center;"><?php echo $bttn_wrap_txt; ?> </p>

<center>

<?php } ?>
<a border='0' class='not_outlook' href='<?php echo $token; ?>' style='text-underline:none; display:block; margin-top: 10px;'>
    <table border="0" id="button_cl" class="<?php echo $ref; ?>" cellpadding="0" cellspacing="0" style="background-color:<?php echo $btn_color; ?>;">
      <tbody><tr class="main">
        <td class="main" style="padding:8px ;" width="145">
          <table>
            <tbody><tr>
              <td>
                  <img class="cart_icon" src="<?php echo  $btn_img;  ?>" style="margin-left: 5px; margin-right:10px; margin-top:8px;">
              </td>
              <td>
                <table border="0" cellpadding="0" cellspacing="0" style="float:left; margin:0; margin-left:0px;">
                  <tbody>
                  <tr>
                    <td>
                      <table border="0" cellpadding="0" cellspacing="0" style="margin:0; margin-top:0; padding:0; padding-top:0px;">
                        <tbody>
                        <tr>
                          <td style="padding:0; margin:0; font-size: 26px; color: <?php echo $txt_color; ?>; font-family: Tahoma; vertical-align:top; line-height:34px;" valign="top">
                              $<?php echo $dollar[0] ;?>
                          </td>
                          <td style="padding:0; margin:0; font-size:14px; text-decoration:underline;padding-left:2px; color: #ffffff; font-family: Tahoma; vertical-align:top;" valign="top" >
                              <?php echo $cents[0] ;?>
                          </td>
                        </tr>
                      </tbody></table>
                    </td>
                  </tr>
                </tbody></table>
              </td>
            </tr>
          </tbody></table>
        </td>
      </tr>
    </tbody></table>
</a>


<?php if($bttn_wrap == "on"){ ?>
                <img src="<?php echo plugins_url( 'assets/images/email_chout_tag.png' , dirname(__FILE__) );  ?>" class="tag" style="">
</center>
</div>
<?php }?>
</div>
