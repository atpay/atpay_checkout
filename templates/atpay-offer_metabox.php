<table> 

    <tr valign="top">
        <th class="metabox_label_column">
            <label for="price">Item Price</label>
        </th>
        <td>
            <input type="text" id="price" name="price" value="<?php echo @get_post_meta($post->ID, 'price', true); ?>" />
        </td>
    <tr>

    <tr valign="top">
        <th class="metabox_label_column">
            <label for="dwn_link">Item Reference ID:</label>
        </th>
        <td>
            <input type="text" id="ref" name="ref" value="<?php echo @get_post_meta($post->ID, 'ref', true); ?>" />
        </td>
    <tr>
</table>

<?php if(@get_post_meta($post->ID, 'price', true)) { ?>

<p style="float:left;font-weight:bold; margin-top:9px;">
    Button Shortcode: 
</p>

<div style="float:left; width:70%; ">
    <input type="text" style="width:100%; margin-left:10px; font-size:18px;" id="shrtcde" value="[@pay-item price='<?php echo @get_post_meta($post->ID, 'price', true); ?>' ref='<?php echo @get_post_meta($post->ID, 'ref', true); ?>']" readonly="readonly" />
</div>

<div style="clear:both;"> </div>

<?php } ?>
