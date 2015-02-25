<?php
/*
Plugin Name: Better My Sites Menu
Description: Basic adjustments to improve the My Sites menu for multiple-site admins.
Version: 1.0
Author: Kyle Maurer
Author URI: http://realbigmarketing.com/staff/kyle
*/

/*
Improve the My Sites drop down list.
Credit for the scroll script: http://wordpress.org/support/topic/adminbar-my-sites-dropdown-menu-needs-to-scroll?replies=4
More admin bar help here:
http://technerdia.com/1140_wordpress-admin-bar.html
*/
$num_sites = 18;
/*****Remove current My Sites menu******/
function ditch_current_my_sites() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu( 'my-sites' );
}

add_action( 'wp_before_admin_bar_render', 'ditch_current_my_sites' );

/*****Make the My Sites list scroll if too many blogs****/
function kjm_my_styles() {
	global $num_sites;
	$user_id    = get_current_user_id();
	$user_blogs = get_blogs_of_user( $user_id );
	if ( count( $user_blogs ) > $num_sites ) {
		wp_enqueue_style( "kjm-menu-style", plugins_url( "/css/style.css", __FILE__ ), false );
	}
}

add_action( 'wp_print_styles', 'kjm_my_styles' );
add_action( 'admin_print_styles', 'kjm_my_styles' );

function kjm_scripts() {
	global $num_sites;
	$user_id    = get_current_user_id();
	$user_blogs = get_blogs_of_user( $user_id );
	if ( count( $user_blogs ) > $num_sites ) {
		echo "<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js?ver=1.3.2'></script>";
		wp_enqueue_script( "kjm-menu-script", plugins_url( "/js/jquery.dropdown.js", __FILE__ ), false );
		wp_enqueue_script( 'jquery' );
	}
}

//add_action('wp_before_admin_bar_render', 'kjm_scripts',30);
add_action( 'wp_print_scripts', 'kjm_scripts', 99 );

require_once( 'add-menu.php' );