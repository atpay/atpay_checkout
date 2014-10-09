<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> 
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<link rel="stylesheet" href="<?php echo plugins_url( 'assets/css/atpay-two-click-checkout.css', dirname(__FILE__) ); ?>" type="text/css" />

<script>

jQuery(function($) {
	$( "#tabs" ).tabs( { fx: { opacity: 'toggle' }}).addClass( "ui-tabs-vertical ui-helper-clearfix" );
	$( "#tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
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



		<div id="tabs">
			<ul>
				<li><a href="#tabs-1"><span class="navigation api"></span>@Pay Offers</a></li>
				<li><a href="#tabs-2"><span class="navigation store"></span>Send Offer</a></li>
				<li><a href="#tabs-3"><span class="navigation reports"></span>Campaigns</a></li>
				<li><a href="#tabs-4"><span class="navigation docs"></span>Transactions</a></li>
			</ul>

			<div id="tabs-1">
				<h1 id="plugin-title">@Pay Offers</h1>
				<div class="inner">
					<div class="inner-panel">
						<div class="title">
							<p><strong>List of @Pay Offers</strong><span class="tooltip" title="User Interface Design" rel="tooltip"></span></p>
						</div> <!-- .title -->


						<div class="inner">
							<div id="env_options"> 
								

								<table class="offer_table data" cellspacing="0">
									<tr>
										<th>Name</th>
										<th width="200">Date Created</th>
										<th width="30" class="cent">Edit</th>
										<th width="30" class="cent">Send</th>
									</tr>

									<?php
									$args = array( 'post_type' => 'atpay-offer', 'posts_per_page' => -1 );
									$loop = new WP_Query( $args );
									while ( $loop->have_posts() ) : $loop->the_post();
									?>
									<tr>
										<td>
											<?php the_title(); ?>
										</td>
										<td> 
											<?php the_time('F jS, Y') ?> 
										</td>

										<td class="cent"><a href="http://localhost/wp-admin/post.php?post=<?php echo get_the_ID(); ?>&action=edit">Edit</td>
										<td class="cent"><a href="/wp-admin/edit.php?post_type=atpay-offer&page=send-offers&send-offer=<?php echo get_the_ID(); ?>#tabs-2">Send</td>
									</tr>

								<?php endwhile; ?>
							</table>

						</div> <!-- .env_options -->

						<a href="http://localhost/wp-admin/post-new.php?post_type=atpay-offer" class="button right" style="margin-top:10px; margin-right:0px;"> Create New Offer </a>


					</div> <!-- .inner -->
				</div> <!-- .inner-pannel -->
			</div> <!-- .inner" -->
		</div> <!-- #tabs-1 -->


		<div id="tabs-2">
			<h1 id="plugin-title">@Pay Offers</h1>
			<div class="inner">
				<div class="inner-panel">
					<div class="title">
						<p><strong>Send Offer</strong><span class="tooltip" title="User Interface Design" rel="tooltip"></span></p>
					</div> <!-- .title -->
					<div class="inner">
						<?php global $display_name , $user_email;
						get_currentuserinfo();
						?>

						<form id="send-offer-form" action="/"> 

							<label>Offer: </label>

							<?php 
							$args = array(
								'selected' => $_GET["send-offer"],
								'post_type' => 'atpay-offer'
								);

							wp_dropdown_pages($args); 

							?>						

							<?php 
							$offer = get_post($_GET["send-offer"]); 
							?>

							<?php require_once(sprintf("%s/../lib/mailchimp/MailChimp.php", dirname(__FILE__)));?>




							<?php
							$MailChimp = new \drewm\MailChimp('60ef738b47c1acd5e932c94e13d96703-us6');
							$lists = $MailChimp->call('lists/list'); 

							?>

							<br /> <br />
							<label>Mailing List</label>
							<select name="offer_list_id" id="selectForm">
								<option value="false"> Select Mailchimp List</option>

								<?php
								foreach ($lists["data"] as $list)
								{
									echo"<option value='".$list['id']."'>"; 	
									echo $list['name'];
									echo "</option>";
								}
								?>

								<option value="false"> No List</option>
							</select>
							<br /><br />

							<?php $temps = $MailChimp->call('templates/list', array('types'=> array("user"=>true, "gallery" => false, "base" => false))); 
							?>

							<label>Template</label>
							<select name="offer_tmpl_id" id="selectFormB">
								<option> Select Mailchimp Template</option>
								<?php
								foreach ($temps["user"] as $temp)
								{
									echo"<option value='".$temp['id']."'>"; 	
									echo $temp['name'];
									echo "</option>";
								}
								?>

							</select>
							<br /><br /> 


							<label>Template Section</label>

							<select name="offer_tmpl_section" id="selectFormC">

							</select>




							<br /><br /> 

							<label>From :</label>
							<input type="text" name="offer_send_from" value="<?php echo $user_email;?>" />
							<br /><br />
							<label>Subject :</label>
							<input type="text" name="offer_send_subject" value="<?php echo $offer->post_title; ?> " />
							<br /><br />
							<label>Signup URL :</label>
							<input type="text" name="offer_send_url" value="<?php echo get_site_url();?> " />
							<br /><br />

							<input type="hidden" id="offer_send_to" name="offer_send_to" value='' />
							<input type="hidden" id="offer_list_name" name="offer_list_name" value='' />
							<input type="hidden" id="offer_tmpl_name" name="offer_tmpl_name" value='' />

							<input type="checkbox" name="dont_send" value="true"> Only create campaign. Do Not Send.  


							<br>



							<input type="submit" value="Send Now" />

						</form>


						
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
						<table id="camp_table" class="data">
							<tr>
								<th>Offer Name</th>
								<th>Date Created</th>
								<th>MC List</th>
								<th>URL</th>
								<th>Status</th>
								<th>Details</th>
							</tr>
							<?php			
							global $wpdb;
							$table_name = $wpdb->prefix . "atpay_sent_offers";
							$retrieve_data = $wpdb->get_results( "SELECT * FROM $table_name" );
							$camp_ids = array();
							?>



							<?php foreach ($retrieve_data as $retrieved_data){ ?>

							<?php array_push($camp_ids, $retrieved_data->campaign_id); ?>

							<tr class="camp_row" id="<?php echo $retrieved_data->campaign_id;?>">
								<td class="title_"><?php echo $retrieved_data->title;?></td>
								<td class="time"><?php echo $retrieved_data->time;?></td>
								<td class="list"><span title="<?php echo $retrieved_data->sent_to;?>" rel="tooltip"><?php echo $retrieved_data->list_name; ?></td>
								<td class="url"><?php echo $retrieved_data->url;?></td>
								<td class="status"> </td>
								<td class="info"><a href="#">Click </a></td>
							</tr>

							<tr class= "camp_details" style="display:none;"><td colspan='7'> 

								<strong>Status:</strong> <span id="status"> </span><br />
								<strong>From:</strong>  <span id="from_name"> </span> <<span id="from_email"> </span>><br />
								<strong>Title:</strong>  <span id="title"> </span><br />
								<strong>Subject:</strong>  <span id="subject"> </span><br />
								<strong>Date Sent:</strong>  <span id="send_time"> </span><br />
								<strong>Emails Sent: </strong> <span id="emails_sent"> </span><br />
								<strong>Preview Link:</strong>  <a href="" id="archive_url_long" target="_blank"> Preview </a> <br />

							</td></tr>
							<?php 
						}
						?>
					</table>

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




	<table id="camp_table" class="data">
							<tr>
								<th>Time</th>
								<th>Email</th>
								<th>Name</th>
								<th>Data</th>
								<th>Total</th>
								<th>Type</th>

							</tr>
							<?php			
							global $wpdb;
							$table_name = $wpdb->prefix . "atpay_transactions";
							$retrieve_data = $wpdb->get_results( "SELECT * FROM $table_name" );
							$camp_ids = array();
							?>



							<?php foreach ($retrieve_data as $retrieved_data){ ?>

							<?php array_push($camp_ids, $retrieved_data->campaign_id); ?>

							<tr class="camp_row" id="<?php echo $retrieved_data->campaign_id;?>">
								<td class="title_"><?php echo $retrieved_data->time;?></td>
								<td class="time"><?php echo $retrieved_data->email;?></td>
								<td class="url"><?php echo $retrieved_data->name;?></td>
								<td class="url"><?php echo $retrieved_data->referrer_contect;?></td>
								<td class="url"><?php echo $retrieved_data->balance;?></td>
								<td class="url">WEB</td>

							</tr>
							<?php 
						}
						?>
					</table>





				</div> <!-- .inner -->
			</div> <!-- .inner-panel -->
		</div> <!-- .inner -->
	</div> <!-- #tabs-4 -->

	<?php // @submit_button(); ?>
</div> <!-- .wrap -->






<script>


$(document).ready(function() {
	myAjaxCall();
	var ResInterval = window.setInterval('myAjaxCall()', 5000); // 60 seconds

	$("td.info a").click(function() {

		$(this).parent().parent().next().toggle(1000);

	});

})



var myAjaxCall = function() {    
	$.ajax(    {        
		url: "http://localhost/wp-content/plugins/atpay-jssdkv1.1/lib/mailchimp/mc-campaigns.php",
		        type: "POST",
		        data: <?php print json_encode(array("campaigns" => $camp_ids)); ?> ,         success: function(data)         {

						console.log(data);

						var campaign_data = jQuery.parseJSON(data);



			$('#camp_table tr.camp_row').each(function(index, elem) {


				var campaign_id = $(this).attr('id');

				function getObjects(obj, key, val) {
					var objects = [];
					for (var i in obj) {
						if (!obj.hasOwnProperty(i)) continue;
						if (typeof obj[i] == 'object') {
							objects = objects.concat(getObjects(obj[i], key, val));
						} else if (i == key && obj[key] == val) {
							objects.push(obj);
						}
					}
					return objects;
				}


				var camp_find = getObjects(campaign_data, 'id', campaign_id);

				var table_row = $('#camp_table tr.camp_row#' + campaign_id);

				table_row.children(".status").html(camp_find[0].status);

				var camp_o = camp_find[0];

				console.log(camp_o);

				jQuery.each( camp_o, function( i, val ) {

					if(i == "archive_url_long" ){
					table_row.next().find("a#" + i).attr("href", val);
					}else{
					table_row.next().find("span#" + i).html(val);
					}
				});

				if(camp_o.status != "sent" ){
					var camp_url = "https://us6.admin.mailchimp.com/campaigns/wizard/html-template?id=" + camp_o.web_id; 
					table_row.next().find("span#status").html("<a href='"+camp_url+"' target='_blank'>Not Yet Sent</a>");
					table_row.next().find("span#send_time").html("<a href='"+camp_url+"' target='_blank'>Not Yet Sent</a>");
					table_row.next().find("span#emails_sent").html("<a href='"+camp_url+"' target='_blank'>0</a>");

				}



			});        
		}    
	});


};



$("#selectForm").change(function() {

	var mc_list = $(this).val();
	var mc_list_name = $('option[value=' + mc_list + ']').html();

	$('#offer_list_name').val(mc_list_name);    
	$.ajax(    {        
		url: "http://localhost/wp-content/plugins/atpay-jssdkv1.1/lib/mailchimp/mc-lists.php",
		        type: "POST",
		        data: {
			"offer_list_id": mc_list
		},
		        success: function(data)         {
			$("#offer_send_to").val(data);



			        
		}    
	});
});


$("#selectFormB").change(function() {

	var mc_tmpl = $(this).val();
	var mc_tmpl_name = $('option[value=' + mc_tmpl + ']').html();

	$('#offer_tmpl_name').val(mc_tmpl_name);

	$('#selectFormC').html("");


	    
	$.ajax({        
		url: "http://localhost/wp-content/plugins/atpay-jssdkv1.1/lib/mailchimp/mc-templates.php",
		        type: "POST",
		        data: {
			"offer_tmpl_id": mc_tmpl
		},
		        success: function(data)         {

			var template_data = jQuery.parseJSON(data);

			var template_sections = template_data.sections;

			for (var i in template_sections) {

				$('#selectFormC')
					.append($("<option></option>")
						.attr("value", template_sections[i])
						.text(template_sections[i]));
			}	        
		}
		    
	});
});


$("#send-offer-form").submit(function(e) {    
	var postData = $(this).serializeArray();    
	var formURL = $(this).attr("action");
    
	$.ajax({        
		url: "http://localhost/wp-content/plugins/atpay-jssdkv1.1/lib/blaster.php",
		type: "POST",
		data: postData,
		success: function(data) {
			alert(data);
		},
		error: function(data) {
			console.log(data)
		}    
	});
e.preventDefault(); //STOP default action
});
</script>