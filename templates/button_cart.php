<?php
  $price = "$".number_format($price, 2, '.', '');
  preg_match("/\d+(?=\.)/", "$price", $dollar);
  preg_match("/(?<=\.)[^.]*/", $price, $cents);
  $dsc = $desc;
?>



<a border='0' class='not_outlook' href='javascript:void(0)' onclick="atPayAddCart('<?php echo $ref; ?>','<?php echo $price; ?>','<?php echo $dsc ;?>','<?php echo $options; ?>');" style='text-underline:none; display:block; margin-top: 10px;'>
Add to Cart
</a>
