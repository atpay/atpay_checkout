<?php


if(!class_exists('AtPay_Connect_Settings'))
{
	class AtPay_Connect_Settings
	{
		/**
		 * Construct the plugin object
		 */

		public function __construct()
		{
			// register actions
          add_action('admin_init', array(&$this, 'admin_init'));
          add_action('admin_menu', array(&$this, 'add_menu'));

		} // END public function __construct

        public function admin_init()
        {
        	register_setting('wp_plugin_template-group', 'prod_partner_id');
        	register_setting('wp_plugin_template-group', 'store_slug');
        	register_setting('wp_plugin_template-group', 'btn_color');
        	register_setting('wp_plugin_template-group', 'btn_img');
          register_setting('wp_plugin_template-group', 'txt_color');
          register_setting('wp_plugin_template-group', 'bttn_wrap');
          register_setting('wp_plugin_template-group', 'bttn_icon');
          register_setting('wp_plugin_template-group', 'bttn_wrap_txt');

          add_option( "store_slug", "store");
          add_option( "btn_color", "#287992");
          add_option( "txt_color", "#ffffff");
          add_option( "bttn_wrap", "on");
          add_option( "bttn_icon", "light");
          add_option( "bttn_wrap_txt", "Made for Mobile");

        	// add your settings section

        	add_settings_section(
        	    'wp_plugin_template-section',
        	    '@Pay API Sandbox Credentials',
        	    array(&$this, 'settings_section_wp_plugin_template'),
        	    'sb_options'
        	);

        	add_settings_section(
        	    'wp_plugin_template-section',
        	    '@Pay API Production Credentials',
        	    array(&$this, 'settings_section_wp_plugin_template'),
        	    'prod_options'
        	);

		            add_settings_field(
		                'prod_partner_id',
		                'Partner ID',
		                array(&$this, 'settings_field_input_text'),
		                'prod_options',
		                'wp_plugin_template-section',
		                array(
		                    'field' => 'prod_partner_id'
		                )
		            );

        	add_settings_section(
        	    'wp_plugin_template-section',
        	    '@Pay API Store Options',
        	    array(&$this, 'settings_section_wp_plugin_template'),
        	    'store_options'
        	);

		           add_settings_field(
		                'store_slug',
		                '@Pay Store Slug',
		                array(&$this, 'settings_field_input_text'),
		                'store_options',
		                'wp_plugin_template-section',
		                array(
		                    'field' => 'store_slug'
		                )
		            );


		           add_settings_field(
		                'btn_color',
		                'Button Color',
		                array(&$this, 'settings_field_input_color'),
		                'store_options',
		                'wp_plugin_template-section',
		                array(
		                    'field' => 'btn_color'
		                )
		            );


               add_settings_field(
                    'txt_color',
                    'Button Text Color',
                    array(&$this, 'settings_field_input_color'),
                    'store_options',
                    'wp_plugin_template-section',
                    array(
                        'field' => 'txt_color'
                    )
                );


                add_settings_field(
                      'bttn_icon',
                      'Icon Color', //'Environment was here, took it out for visual purposes
                      array(&$this, 'settings_field_input_checkC'),
                      'store_options',
                      'wp_plugin_template-section',
                      array(
                          'field' => 'bttn_icon'
                      )
                  );


                add_settings_field(
                      'bttn_wrap',
                      'Wrapper', //'Environment was here, took it out for visual purposes
                      array(&$this, 'settings_field_input_checkB'),
                      'store_options',
                      'wp_plugin_template-section',
                      array(
                          'field' => 'bttn_wrap'
                      )
                  );

               add_settings_field(
                    'bttn_wrap_txt',
                    'Wrapper Text',
                    array(&$this, 'settings_field_input_text'),
                    'store_options',
                    'wp_plugin_template-section',
                    array(
                        'field' => 'bttn_wrap_txt'
                    )

            );







            add_settings_section(
                        'wp_plugin_template-section',
                        'Mailchimp Options',
                        array(&$this, 'settings_section_wp_plugin_template'),
                        'mail_chimp_options'
                    );

               add_settings_field(
                    'mail_chimp_api',
                    'Mailchimp API Credentials',
                    array(&$this, 'settings_field_input_text'),
                    'mail_chimp_options',
                    'wp_plugin_template-section',
                    array(
                        'field' => 'mail_chimp_api'
                    )
                );




           // Possibly do additional admin_init tasks
        } // END public static function activate

        public function settings_section_wp_plugin_template()
        {
            // Think of this as help text for the section.
            // echo '@Pay API Credentials';
        }

        /**
         * This function provides text inputs for settings fields
         */
        public function settings_field_input_text($args)
        {
            // Get the field name from the $args array
            $field = $args['field'];
            // Get the value of this setting
            $value = get_option($field);
            // echo a proper input type="text"
            echo sprintf('<input type="text" name="%s" id="%s" maxlength="50" value="%s" /> ', $field, $field, $value);


        } // END public function settings_field_input_text($args)



        public function settings_field_input_color($args)
        {
            // Get the field name from the $args array
            $field = $args['field'];
            // Get the value of this setting
            $value = get_option($field);
            // echo a proper input type="text"
            echo sprintf('<div style="background-color:red; position:relative;"><input class="color" type="text" name="%s" id="%s" maxlength="30" value="%s" /> ', $field, $field, $value);
            echo sprintf('<div class="colorpicker"></div>');
            echo sprintf('<div class="colorbox"></div></div>');

        } // END public function settings_field_input_text($args)






 /**
         * This function provides text inputs for settings fields
         */
        public function settings_field_input_checkC($args)
        {
            // Get the field name from the $args array
            $field = $args['field'];
            // Get the value of this setting
            $value = get_option($field);
            if($value == "light"){ $check_light = "checked";}
            if($value == "dark"){ $check_dark = "checked";}

            echo sprintf('&nbsp; &nbsp;<input type="radio" style="float:;"name="%s" id="bttn_icon_light" value="light" %s> Light', $field, $check_light);
            echo sprintf('&nbsp; &nbsp;<input type="radio" style="float:;" name="%s" id="bttn_icon_dark" value="dark" %s> Dark', $field, $check_dark);



        } // END public function settings_field_input_check($args)




 /**
         * This function provides text inputs for settings fields
         */
        public function settings_field_input_checkB($args)
        {
            // Get the field name from the $args array
            $field = $args['field'];
            // Get the value of this setting
            $value = get_option($field);
            if($value == "on"){ $check_on = "checked";}
            if($value == "off"){ $check_off = "checked";}

            echo sprintf('&nbsp; &nbsp;<input type="radio" style="float:;"name="%s" id="bttn_wrap_on" value="on" %s> On', $field, $check_on);
            echo sprintf('&nbsp; &nbsp;<input type="radio" style="float:;" name="%s" id="bttn_wrap_off" value="off" %s> Off', $field, $check_off);



        } // END public function settings_field_input_check($args)





        /**
         * This function provides text inputs for settings fields
         */
        public function settings_field_input_check($args)
        {
            // Get the field name from the $args array
            $field = $args['field'];
            // Get the value of this setting
            $value = get_option($field);

            if($value == "http://localhost:4000"){ $check_dev = "checked"; $field_value = "dev_options";}
            if($value == "https://sandbox-api.atpay.com"){ $check_sb = "checked"; $field_value = "sb_options";}
            if($value == "https://beta-api.atpay.com"){ $check_beta = "checked"; $field_value = "beta_options";}
            if($value == "https://api.atpay.com"){ $check_prod = "checked"; $field_value = "prod_options";}


//            echo sprintf('<input type="radio" style="float:;"name="%s" id="dev_options" value="http://localhost:4000" %s> Dev &nbsp;', $field, $check_dev);
            echo sprintf('&nbsp; &nbsp;<input type="radio" style="float:;"name="%s" id="sb_options" value="https://sandbox-api.atpay.com" %s> Sandbox', $field, $check_sb);
//           echo sprintf('&nbsp; &nbsp;<input type="radio" style="float:;" name="%s" id="beta_options" value="https://beta-api.atpay.com" %s> Beta', $field, $check_beta);
            echo sprintf('&nbsp; &nbsp;<input type="radio" style="float:;" name="%s" id="prod_options" value="https://api.atpay.com" %s> Production', $field, $check_prod);



        } // END public function settings_field_input_check($args)


        /**
         * add a menu
         */
        public function add_menu()
        {
            // Add a page to manage this plugin's settings
        	 add_submenu_page('edit.php?post_type=atpay-item', 'Options', 'Options', 'manage_options', 'atpay-settings', array(&$this, 'plugin_settings_page') );



        } // END public function add_menu()

        /**
         * Menu Callback
         */
        public function plugin_settings_page()
        {
        	if(!current_user_can('manage_options'))
        	{
        		wp_die(__('You do not have sufficient permissions to access this page.'));
        	}

        	// Render the settings template
        	include(sprintf("%s/../templates/settings.php", dirname(__FILE__)));
        } // END public function plugin_settings_page()

    } // END class WP_Plugin_Template_Settings
} // END if(!class_exists('WP_Plugin_Template_Settings'))




function plugin_settings_link( $links)
{
    $settings_link = '<a href="edit.php?post_type=atpay-item&page=atpay-settings">Settings</a>';
    array_unshift($links, $settings_link);
    return $links;
}

add_filter("plugin_action_links_atpay-jssdkv1.1/index.php", 'plugin_settings_link');
