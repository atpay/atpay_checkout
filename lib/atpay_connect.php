<?php

if(!class_exists('AtPay_Connect'))
{
  class AtPay_Connect
  {
    public function __construct()
    {
      require_once(sprintf("%s/../lib/settings.php", dirname(__FILE__)));
        $AtPay_Connect_Settings = new AtPay_Connect_Settings();

      require_once(sprintf("%s/../lib/post_types.php", dirname(__FILE__)));
        $Post_Type_Items = new Post_Type_Items();
        $Post_Type_Offers = new Post_Type_Offers();

      require_once(sprintf("%s/../lib/shortcode.php", dirname(__FILE__)));

      require_once(sprintf("%s/../lib/admin.php", dirname(__FILE__)));

      require_once(sprintf("%s/../lib/sdk_setup.php", dirname(__FILE__)));

      require_once(sprintf("%s/../lib/cart_setup.php", dirname(__FILE__)));

      require_once(sprintf("%s/../lib/Mobile_Detect.php", dirname(__FILE__)));

    }
      public static function mobile_device() {
        $detect = new Mobile_Detect;
        if ( $detect->isMobile() ) {
          return true;
        } else{
          return false;
        }
      }
  }
}

remove_filter( 'the_content', 'wpautop' );
add_filter( 'the_content', 'shortcode_unautop', 100 );

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_pay-items',
		'title' => '@Pay Items',
		'fields' => array (
			array (
				'key' => 'field_542ca998dcef2',
				'label' => 'Custom Options',
				'name' => 'custom_options',
				'type' => 'textarea',
				'instructions' => 'An array of JS objects with configurations for item options.
	[{name: "sizes", type: "dropdown", options: ["red", "blue", "green"]}]',
				'default_value' => '[{label: "Sizes", type: "dropdown", options: ["red", "blue", "green"]}, {label: "Gift Note", type: "text"}]',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'formatting' => 'none',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'atpay-item',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}
