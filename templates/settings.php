<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo plugins_url( 'assets/js/farbtastic.js', dirname(__FILE__) ); ?>"></script>
<link rel="stylesheet" href="<?php echo plugins_url( 'assets/css/farbtastic.css', dirname(__FILE__) ); ?>" type="text/css" />
<link rel="stylesheet" href="<?php echo plugins_url( 'assets/css/atpay-two-click-checkout.css', dirname(__FILE__) ); ?>" type="text/css" />



<script>


  jQuery(function($) {
      $('.color').click(function(e) {

        colorPicker = jQuery(this).next('div');

        var find = $(this).parent().children("[class*='color']")

        $(colorPicker).farbtastic(find);

        colorPicker.show();


        $(document).mousedown( function() {
          $(colorPicker).hide();

					var colorB = $("#btn_color").val();
					$("table#button_cl").css( "background-color", colorB );

							var color = $("#txt_color").val();
			    $("table#button_cl td").css( "color", color );

        });

      });

  });



	jQuery(function($) {

		<?php if(get_option("bttn_icon") == "dark"){ ?>
 			 $("img.cart_icon").attr( "src", "<?php echo plugins_url( 'assets/images/bttn_cart_gray.png' , dirname(__FILE__) );  ?>" );
		<?php } ?>

 		$("#bttn_icon_light").click(function(){
 			 $("img.cart_icon").attr( "src", "<?php echo plugins_url( 'assets/images/bttn_cart_white.png' , dirname(__FILE__) );  ?>" );
    });

    $("#bttn_icon_dark").click(function(){
 			 $("img.cart_icon").attr( "src", "<?php echo plugins_url( 'assets/images/bttn_cart_gray.png' , dirname(__FILE__) );  ?>" );
    });


		// button wrapper text
		var w_text = $("#bttn_wrap_txt").val();
    $('table.wrap td p.wrap_text').text(w_text);

 		$("#bttn_wrap_txt").keyup(function(){
    	var w_text = $(this).val();
    $('table.wrap td p.wrap_text').text(w_text);
    });


		<?php if(get_option("bttn_wrap") == "off"){ ?>
			 $("img.tag").css( "display", "none" );
 			 $("table.wrap, .leftb,.rightb").css( "border", "0px" );
 			 $('table.wrap td p.wrap_text').css("display", "none");
 			 $("#bttn_wrap_txt").css("display", "none");
 			 $("#bttn_wrap_txt").parent().prev().css("display", "none");

		<?php } ?>

		// button color
		var color = $("#btn_color").val();
		$("table#button_cl").css( "background-color", color );
    $("#btn_color").next().next().css("background-color", color );


		$("#btn_color").change(function(){
		var color = $(this).val();
		$("table#button_cl").css( "background-color", color );
		});

		// button text color
		var color = $("#txt_color").val();
    $("table#button_cl td").css( "color", color );
    $("#txt_color").next().next().css("background-color", color );



 		$("#txt_color").change(function(){
    	var color = $(this).val();
    	$("table#button_cl td").css( "display", "none" );
    });



 		$("#store_link").click(function(){
    	$("#tabs-1,#tabs-3,#tabs-4").css( "display", "none");
    	$("#tabs-2").css( "display", "block" );

    });




		// wrap on
 		$("#bttn_wrap_on").click(function(){
 			  $("img.tag").css( "display", "block" );
 			  $("table.wrap").attr("style","margin: auto; margin-bottom:5px; font-family: Lato; padding-bottom:10px; position:relative; padding-left:5px; padding-right:10px; margin-bottom:0px; margin-top:5px; padding:10px;padding-top:0; border-left: 1px solid #e4e2e2; border-top: 1px solid #e4e2e2; border-right: 1px solid #e4e2e2;");
 			  $("table.leftb").attr( "style", "font-size: 1px; line-height: 1px; border-left: 1px #e4e2e2 solid;  border-bottom: 1px #e4e2e2 solid; height:10px; width: 100%;" );
 			  $("table.rightb").attr( "style", "font-size: 1px; line-height: 1px; border-right: 1px #e4e2e2 solid;  border-bottom: 1px #e4e2e2 solid; height:10px; width: 100%;" );
  			$('table.wrap td p.wrap_text').attr("style", "margin-bottom:0px; color: #515050; font-size:12px; margin-top:2px; text-align:center;");
  			$("#bttn_wrap_txt").parent().prev().show();
  			$("#bttn_wrap_txt").show();


    });


		// wrap off
 		$("#bttn_wrap_off").click(function(){
 			  $("img.tag").css( "display", "none" );
 			  $("table.wrap, .leftb,.rightb").css( "border", "0px" );
 			   $('table.wrap td p.wrap_text').css("display", "none");
 			   $("#bttn_wrap_txt").hide();
 			   $("#bttn_wrap_txt").parent().prev().hide();

    });


	});



	jQuery(function($) {
		$( "#tabs" ).tabs( { fx: { opacity: 'toggle' }}).addClass( "ui-tabs-vertical ui-helper-clearfix" );
		$( "#tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
	});

    jQuery(function($) {
        var selected_env = $("div#env_options input:checked").attr("id")
        $("div#"+selected_env).show();


	    $("input[name$='atpay_env']").click(function() {
	        var env = $(this).attr("id");
	        $("div.desc").slideUp('slow');
	        $("div#"+env).slideDown('slow');

	    });
	});


	// Tooltip Script
	$( document ).ready( function() {
	    var targets = $( '[rel~=tooltip]' ),
	        target  = false,
	        tooltip = false,
	        title   = false;

	    targets.bind( 'mouseenter', function()
	    {
	        target  = $( this );
	        tip     = target.attr( 'title' );
	        tooltip = $( '<div id="tooltip"></div>' );

	        if( !tip || tip == '' )
	            return false;

	        target.removeAttr( 'title' );
	        tooltip.css( 'opacity', 0 )
	               .html( tip )
	               .appendTo( 'body' );

	        var init_tooltip = function()
	        {
	            if( $( window ).width() < tooltip.outerWidth() * 1.5 )
	                tooltip.css( 'max-width', $( window ).width() / 2 );
	            else
	                tooltip.css( 'max-width', 340 );

	            var pos_left = target.offset().left + ( target.outerWidth() / 2 ) - ( tooltip.outerWidth() / 2 ),
	                pos_top  = target.offset().top - tooltip.outerHeight() - 20;

	            if( pos_left < 0 )
	            {
	                pos_left = target.offset().left + target.outerWidth() / 2 - 20;
	                tooltip.addClass( 'left' );
	            }
	            else
	                tooltip.removeClass( 'left' );

	            if( pos_left + tooltip.outerWidth() > $( window ).width() )
	            {
	                pos_left = target.offset().left - tooltip.outerWidth() + target.outerWidth() / 2 + 20;
	                tooltip.addClass( 'right' );
	            }
	            else
	                tooltip.removeClass( 'right' );

	            if( pos_top < 0 )
	            {
	                var pos_top  = target.offset().top + target.outerHeight();
	                tooltip.addClass( 'top' );
	            }
	            else
	                tooltip.removeClass( 'top' );

	            tooltip.css( { left: pos_left, top: pos_top } )
	                   .animate( { top: '+=10', opacity: 1 }, 50 );
	        };

	        init_tooltip();
	        $( window ).resize( init_tooltip );

	        var remove_tooltip = function()
	        {
	            tooltip.animate( { top: '-=10', opacity: 0 }, 50, function()
	            {
	                $( this ).remove();
	            });

	            target.attr( 'title', tip );
	        };

	        target.bind( 'mouseleave', remove_tooltip );
	        tooltip.bind( 'click', remove_tooltip );
	    });
	});


	jQuery(function($) {
		$('#colorpicker').farbtastic('.color, #colorbox');

		$("input.color").each(function() {
			$(".color, #colorbox").click(function() {
				$("#colorpicker").fadeToggle("slow").focus();
			});

			$(".color, #colorbox").blur(function() {
				jQuery("#colorpicker").fadeToggle("slow");
			})
		});

	});
</script>


<div class="atpay wrap">
	<div id="intro" class="container blue-bg">
		<div class="inner">
			<div class="one-fourth first">
				<?php echo '<img src="' . plugins_url( 'assets/images/atpay-two-click-checkout-logo.png' , dirname(__FILE__) ) . '" alt="@Pay Two-Click Checkout For Email + Web - WordPress Plugin">'; ?>
			</div> <!-- .one-sixth .first -->

			<div class="three-fourths">
				<p><strong>@Pay Connect for WordPress, v1.0</strong><br>
				Two clicks. Endless possibilities for e-commerce + email built right into WordPress. Visit us at <a href="https://www.atpay.com" title="@Pay - Two-Click Checkout for Email + Web" target="_blank">www.atpay.com</a></p>
			</div> <!-- .five-sixths -->
		</div> <!-- .inner -->
	</div> <!-- #intro -->

    <form method="post" action="options.php">

        <?php @settings_fields('wp_plugin_template-group'); ?>
        <?php @do_settings_fields('wp_plugin_template-group'); ?>

		<div id="tabs">
			<ul>
				<li><a href="#tabs-1"><span class="navigation api"></span>API Settings</a></li>
				<li><a href="#tabs-2"><span class="navigation store"></span>Store Settings</a></li>
				<li><a href="#tabs-3"><span class="navigation reports"></span>Reports</a></li>
				<li><a href="#tabs-4"><span class="navigation docs"></span>FAQ & Documentation</a></li>
			</ul>

			<div id="tabs-1">
				<h1 id="plugin-title">@Pay Connect Plugin Settings</h1>
				<div class="inner">
					<div class="inner-panel">
						<div class="title">
							<p><strong>API Settings</strong><span class="tooltip" title="User Interface Design" rel="tooltip"></span></p>
						</div> <!-- .title -->


						<div class="inner">
							<div id="env_options">
								<div class="one-half first">
									<div id="environment_options">
										<?php do_settings_sections('env_options'); ?>
									</div> <!-- #environment_options -->
									<div id="prod_options"class="desc">
										<?php do_settings_sections('prod_options'); ?>
									</div> <!-- #prod_options -->
								</div> <!-- .one-half .first -->
								<div class="one-half">
									<p class="signup">
										<strong>Don't have an account?</strong> <br>
										<p>Can't help ya here bro.</p>

									</p>
								</div>

							</div> <!-- .env_options -->

						</div> <!-- .inner -->
					</div> <!-- .inner-pannel -->
				</div> <!-- .inner" -->
			</div> <!-- #tabs-1 -->


  			<div id="tabs-2">
				<h1 id="plugin-title">@Pay Connect Plugin Settings</h1>
				<div class="inner">
					<div class="inner-panel">
						<div class="title">
							<p><strong>Store Settings</strong><span class="tooltip" title="User Interface Design" rel="tooltip"></span></p>
						</div> <!-- .title -->
						<div class="inner">
							<div class="one-half first">
								<?php do_settings_sections('store_options'); ?>
							</div> <!-- .one-half .first -->
							<div class="one-half">

								<div> <?php include('preview.php'); ?></div>

							</div> <!-- one-half -->
						</div> <!-- .inner -->
					</div> <!-- .inner-panel -->
				</div> <!-- .inner -->
			</div> <!-- #tabs-2" -->


			<div id="tabs-3">
				<h1 id="plugin-title">@Pay Connect Plugin Settings</h1>
				<div class="inner">
					<div class="inner-panel">
						<div class="title">
							<p><strong>Reports</strong><span class="tooltip" title="User Interface Design" rel="tooltip"></span></p>
						</div> <!-- .title -->
						<div class="inner">


							<p> To view history, reports and analytics, login to your @Pay merchant dashboard.  </p>



									<?php if(get_option("atpay_env") == "https://sandbox-api.atpay.com"){

										$link="https://sandbox.atpay.com";
								}else {
										$link="https://secured.atpay.com";
								} ?>


								<a href="<?php echo $link; ?>" target="_blank" style="display:block; margin-top:10px;float:; width:90px; height: 40px; color: #fff !important; text-decoration: none; text-align: center; line-height:40px; background-color: #287992;"> Login </a>

								<a href="<?php echo $link; ?>">
								<img src="<?php echo plugins_url( 'assets/images/dash.png' , dirname(__FILE__) ); ?>" style=" margin-right: 10px; margin-top:20px;">
							</a>

						</div> <!-- .inner -->
					</div> <!-- .inner-panel -->
				</div> <!-- .inner -->
			</div> <!-- #tabs-3 -->


			<div id="tabs-4">
				<h1 id="plugin-title">@Pay Connect Plugin Settings</h1>
				<div class="inner">
					<div class="inner-panel">
						<div class="title">
							<p><strong>FAQ + Documentation</strong><span class="tooltip" title="User Interface Design" rel="tooltip"></span></p>
						</div> <!-- .title -->
						<div class="inner">

								<h3>Setting Up Your Account</h3>
								<p>	Need an account? Visit our <a href="https://www.atpay.com/request-sandbox-access/" target="_bank">Developer Sandbox </a> page to sign up for API credentials and set your authorized domain. Once you are ready to process live transactions you can <a href="https://www.atpay.com/two-click/atpay-connect-wordpress-plugin/" target="_blank">Apply for a Full Account.</a> </p>


								<h3 style="margin-top:40px; margin-bottom:7px;">Using Store Features (Items + Store Slug)</h3>
								<p>If you want to design and build a traditional store (where each item has a detail page and permalink), set up  ‘@Pay Items’ for each product you wish to sell. Be sure to set the Store Slug for optimum SEO and User Experience (e.g. ‘http://mysite.com/<strong>STORESLUG</strong>/itemname).</p>


								<h3 style="margin-top:40px; margin-bottom:7px;">Setting Up Your Account</h3>
								<p>	Whether or not you create @Pay items, you can use button shortcodes to create Two-Click Buy Buttons for use anywhere on your site. Configure your button color and other options in Store Settings, then type the following shirt code on any page or post. <a href="#" id="store_link">Configure button options</a></p>

								<h3 style="margin-top:40px; margin-bottom:7px;">Example</h3>

								<div style= "float:left;"> <p> [@pay-item - price=50.95 - ref=189934598457394857]</p>
									<p style="float:left; margin-left:25px;"> Your Price; Required  <br /> (format: 0.00; required) </p>
									<p style="float:left; margin-left:25px; "> Optional Reference Number <br /> (format: plain text) </p>
								</div>



								<img src="<?php echo plugins_url( 'assets/images/preview.png' , dirname(__FILE__) ); ?>" style="float:left; margin-left: 10px;">


								<hr style="clear:both; margin: 10px 0px;" />

								<h3>Need More Help?</h3>
								<a href="https://www.atpay.com/our-faqs/" target="_blank" style="display:block; margin-top:10px;float:left; width:90px; height: 40px; color: #fff !important; text-decoration: none; text-align: center; line-height:40px; background-color: #287992;"> View FAQ </a>



						</div> <!-- .inner -->
					</div> <!-- .inner-panel -->
				</div> <!-- .inner -->
			</div> <!-- #tabs-4 -->

		<?php do_settings_sections('wp_plugin_template'); ?>
		<?php @submit_button(); ?>
    </form>
</div> <!-- .wrap -->
