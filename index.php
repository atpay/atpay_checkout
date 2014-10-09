<?php

/*
Plugin Name:  @Pay Connect
Description: Connect to your @Pay Merchant account and sell right from wordpress.
Version: 1.1
Author: Isaiah Baca
Author URI: http://www.atpay.com
License: GPL2
*/


require_once(sprintf("%s/lib/atpay_connect.php", dirname(__FILE__)));

if(class_exists('AtPay_Connect')) 
  $AtPay_Connect = new AtPay_Connect();


///
// DATABASE INIT

function atpay_db_install() {
   global $wpdb;

   $table_name = $wpdb->prefix . "atpay_sent_offers";

   $sql = "CREATE TABLE $table_name (
      id mediumint(9) NOT NULL AUTO_INCREMENT,
      time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
      offer_id mediumint(9) NOT NULL,
      title tinytext NOT NULL,
      body tinytext NOT NULL,
      token tinytext NOT NULL,
      sent_to tinytext NOT NULL,
      sent_from tinytext NOT NULL,
      url VARCHAR(55) DEFAULT '' NOT NULL,
      list_name tinytext NOT NULL,
      list_id tinytext NOT NULL,
      tmpl_id tinytext NOT NULL,
      tmpl_name tinytext NOT NULL,
      campaign_id tinytext NOT NULL,
      tmpl_section tinytext NOT NULL,

      UNIQUE KEY id (id)
      );";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );



   $table_name = $wpdb->prefix . "atpay_transactions";

   $sql = "CREATE TABLE $table_name (
      id mediumint(9) NOT NULL AUTO_INCREMENT,
      time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
      email tinytext NOT NULL,
      name tinytext,
      token tinytext,
      user_data tinytext,
      balance tinytext,
      referrer_context tinytext,
      UNIQUE KEY id (id)
      );";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );




}

register_activation_hook( __FILE__, 'atpay_db_install' );
