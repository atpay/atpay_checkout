<?php

function cart_setup(){ ?>
  <link href="//cdn.rawgit.com/noelboss/featherlight/master/release/featherlight.min.css" type="text/css" rel="stylesheet" title="Featherlight Styles" />


  <script src="//cdn.rawgit.com/noelboss/featherlight/master/release/featherlight.min.js" type="text/javascript" charset="utf-8"></script>

  <style>

  p.added{

    color: green !important;
    font-size: 16px !important;

  }

  </style>

  <script type="text/javascript">

    function atPayAddCart(ref, cost, dsc, options) {
      var cart_ref = "cart_"+ref;

      if(options){
        var options = eval(decodeURIComponent(options).replace(/\+/g, " "));
        var form = generate_attributes_form(cart_ref, cost, dsc, options);

          $("#addIt").remove();


        <?php if(AtPay_Connect::mobile_device( )){ ?>
          $("."+cart_ref).append(form);
        <?php }else{?>
        $.featherlight(form);
        <?php } ?>

        $("#addIt select").change(function(){
          console.log("changed");
          $("#addIt input[type='submit']").click();
        });


      }else{
        addIt(cart_ref, cost, dsc)
      }
    }

    function generate_attributes_form(cart_ref, cost, dsc, options) {
      form_elements = [];
      opt = 0;
      options.forEach(function(option){
        if(opt == 0){
          auto = "autofocus";
        }else{
          auto = "";
        }
        if(option.type == "text"){
          form_elements[form_elements.length] = "<label>"+option.label+"</label> <input "+auto+" type=\"text\" name=\""+option.name+"\" /> <br />";
        }else if(option.type == "select"){
          select_element = "<select "+auto+" name=\""+option.name+"\"><option>Please select "+option.label+":</option>";
          option.options.forEach(function(opt){
            select_element = select_element + "<option value=\""+opt+"\">"+opt+"</option>";
          });
          select_element =  select_element + "</select><br/ >"
          form_elements[form_elements.length] = "<label>"+option.label+"</label> "+select_element;
        }
        opt ++;
      });

      <?php if(AtPay_Connect::mobile_device( )){ ?>
        form = "<form id=\"addIt\" onsubmit=\"addIt(\'"+cart_ref+"\', \'"+cost+"\', \'"+dsc+"\'); return false;\" style=\"position:absolute; left:-9999px;\">";
      <?php }else{?>
        form = "<form id=\"addIt\" onsubmit=\"addIt(\'"+cart_ref+"\', \'"+cost+"\', \'"+dsc+"\'); return false;\">";
      <?php } ?>



      form_elements.forEach(function(e){
        form = form + e;
      });
      form = form + "<input type=\"submit\" value=\"Submit\" style=\"display:none !important;\"></form>";
      return form;
    }


    function addIt(cart_ref, cost, dsc){
      parent_ref = cart_ref
      cart_ref = cart_ref + $('#addIt').serialize();
      if(localStorage[cart_ref]){
        var cart_o = JSON.parse(localStorage[cart_ref]);
        cart_o.qty++;
        localStorage[cart_ref] = JSON.stringify(cart_o);
      } else {
        opts = $('#addIt').serializeArray();

        var cart_o = {
          "ref":   cart_ref,
          "cost":  cost,
          "dsc":   dsc,
          "qty":   1,
          "opts": opts
          }
        localStorage[cart_ref] = JSON.stringify(cart_o);
      }
      $.featherlight.close();
      $('html, body').animate({
        scrollTop: $("."+parent_ref).offset().top - 100
    }, 500);

      $("."+parent_ref+" p.added").hide().text("Added to cart.").fadeIn(500).delay( 2000 ).fadeOut( 500 );
      atPayCheckCart();

      $(".thanks").remove();

    }

    function atPayCheckCart() {

      var cart_count = 0;
      var cart_amount = 0;
      var cart_contents = {"items": [ ] };

      Object.keys(localStorage)
      .forEach(function(key){
        if (/^(cart_)/.test(key)) {
          var cart_o = JSON.parse(localStorage[key]);
          cart_contents.items.push(cart_o);
          cart_count = cart_count + cart_o.qty;
          cart_amount = cart_amount + (Number(cart_o.cost.replace(/[^0-9\.]+/g,"")) * cart_o.qty );
        }
       });
      atPayFillCart(cart_contents, cart_count, cart_amount);
    } // end atPayCheckCart


    function atPayFillCart(cart_contents, cart_count, cart_amount){

      $("span#total_items").html(cart_count);
      $("span#total_qty").html(cart_amount.toFixed(2));
      var cart_items = cart_contents.items;
      $('#atpay_cart tbody').html("");

      cart_items.forEach(function(item) {
        ops = item.opts
        attributes = "";
        ops.forEach(function(opts){
          attributes = attributes + opts.name + " : " + opts.value +"<br /> ";
        });

        if(item.qty > 1){
          var item_update = "<a href='javascript:void(0)' onclick='atPayRemoveItem(\""+item.ref+"\");'> - </a> | <a href='javascript:void(0)' onclick='atPayAddItem(\""+item.ref+"\");'> + </a> "
        } else {
          var item_update = "<a href='javascript:void(0)' onclick='atPayDeleteItem(\""+item.ref+"\");'> x </a> | <a href='javascript:void(0)' onclick='atPayAddItem(\""+item.ref+"\");'> + </a>"
        }
        var item_ttl =  (Number(item.cost.replace(/[^0-9\.]+/g,"")) * item.qty ).toFixed(2);
        <?php if(AtPay_Connect::mobile_device( )){ ?>
          var cart_row = "<tr><td><div style='float:left; width:50%;'>"+item.dsc+"<br /><i style='font-size:12px;'>"+attributes+"</i></div><div style='float:left; width:45%; margin-left:5%;'>Cost: "+item.cost+"<br />QTY: "+item.qty+ "&nbsp;&nbsp; "+ item_update +"<br />Total: $"+item_ttl+"</div><br /><br /></td></tr>";
        <?php }else{?>
          var cart_row = "<tr><td>"+item.dsc+"<br /><i style='font-size:12px;'>"+attributes+"</i></td> <td>"+item.cost+"</td> <td>"+item.qty+ "&nbsp;&nbsp; "+ item_update +"</td> <td>$"+item_ttl+"</td></tr>";
        <?php } ?>
        $('#atpay_cart tbody').append(cart_row);
      });

        breakdown = create_breakdown(cart_items);

    }// end atPayFillCart


    function create_breakdown(cart_items){
      breakdown = [];
      cart_items.forEach(
        function(item){
          breakdown[breakdown.length] = {
            name: item.dsc,
            amount: Number(item.cost.replace(/[^0-9\.]+/g,"")),
            quantity: item.qty,
            options: item.opts
          }
        }
      );
      return breakdown;
    }


    function atPayClearCart(){
      Object.keys(localStorage)
      .forEach(function(key){
           if (/^(cart_)/.test(key)) {
               localStorage.removeItem(key);
           }
       });
      atPayCheckCart();
    }// end atPayClearCart


    function atPayRemoveItem(key){
      var item = JSON.parse(localStorage[key]);
      item.qty = item.qty - 1;
      localStorage[key] = JSON.stringify(item);
      atPayCheckCart();
    }// end atPayRemoveItem


    function atPayAddItem(key){
      var item = JSON.parse(localStorage[key]);
      item.qty = item.qty + 1;
      localStorage[key] = JSON.stringify(item);
      atPayCheckCart();
    }// end atPayRemoveItem


    function atPayDeleteItem(key){
      localStorage.removeItem(key);
      atPayCheckCart();
    }// end atPayDeleteItem


    function mobile_checkout(breakdown){
      atpay.invoice_token("@Pay Store Order", "Here are the details of your order from the @Pay Store. Click the button below to complete your purchase.", breakdown, {}, function(response){
        console.log(response);
        atPayClearCart();
        $('#atpay_cart tbody').append("<tr class='thanks'><td>Thank you for using @Pay Checkout. Please check your email for receipt or further instructions.</td></tr>");
        mailto = "mailto:transaction@processor.atpay.com?subject=@Pay%20Store%20Order&body=%0ASend%20this%20email%20order%20form%20to%20confirm%20your%20purchase.%20If%20we%20need%20more%20info%20we%20will%20let%20you%20know.%20%20Thanks!%0A%0A%0A%0A---%0A%0AThis%20code%20secures%20and%20validates%20your%20transaction:%0A%0A%0A"+ response.invoice.short_token;
        window.location(window.location.href = mailto);
      });
    }

    function desktop_checkout(breakdown){
      var form = "<form onsubmit=\"email_cart_checkout(breakdown); return false;\"> <p style='width:250px; margin-bottom:10px;'>Enter the email address you'd like to complete your checkout.</p><input type=\"text\" id=\"email\" /><input type=\"submit\" value=\"Submit\"></form>"
      $.featherlight(form);
    }

    function email_cart_checkout(breakdown){
      var to_email = $("input#email").val();
      alert("Check your email to complete your payment.");
      $.featherlight.close();
      atpay.invoice(to_email, "@Pay Store Order", "Here are the details of your order from the @Pay Store. Click the button below to complete your purchase.", breakdown, {}, function(response){
        atPayClearCart();
        $.featherlight.close();
        console.log(response);
      });
    }

    function cartConfirm(price, ref) {
      if(localStorage.atPayToken){
        var r=confirm("Do you want to make this purchase?")}else{ var r=true}
      if (r==true) {
        var amount =  parseFloat(price.replace("$", ""));
        if(localStorage.atPayToken){
          var overlay = jQuery('<div class="atpay_overlay"><div class="atpay_overlayB"></div> </div>');
          $(overlay).hide().appendTo("body").fadeIn(1000);
          atpay.buy(amount, ref, cartReturn);
        }else{
          atpayLogin(amount, ref, cartReturn);
        }
      }else{
        alert("You have not made a purchase");
      }
    } // btn_confirm

    function cartReturn(data) {
      $(".atpay_overlay").fadeOut(1000);
      alert('Thank You, Your Purchase is Complete!');
      atPayResponse = data;
      if(localStorage[atPayResponse.referrer_context]){
        localStorage[atPayResponse.referrer_context]=Number(localStorage[atPayResponse.referrer_context])+1;
      } else {
        localStorage[atPayResponse.referrer_context]=1;
      }
      atPayClearCart();
      $(".notice").toggle();
      $('#atpay_cart, #cart_actions, #totals').toggle();
      atpaySessionCheck();
    } // end atPayReturn

  </script>

<?php }


add_action('wp_footer', 'cart_setup', 20);
