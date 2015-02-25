<?php
/*
Plugin Name: Better My Sites Menu
Description: Basic adjustments to improve the My Sites menu for multiple-site admins.
Version: 1.1
Author: Kyle Maurer
Author URI: http://realbigmarketing.com/staff/kyle
*/

/*
Improve the My Sites drop down list.
Credit for the scroll script: http://wordpress.org/support/topic/adminbar-my-sites-dropdown-menu-needs-to-scroll?replies=4
More admin bar help here:
http://technerdia.com/1140_wordpress-admin-bar.html
*/

class Better_My_Sites_Menu {

	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ), 99 );
		add_action( 'admin_enqueue_scripts', array( $this, 'scripts' ), 99 );
		add_action( 'wp_print_styles', array( $this, 'styles' ) );
		add_action( 'admin_print_styles', array( $this, 'styles' ) );
		add_action( 'wp_before_admin_bar_render', array( $this, 'ditch_current' ) );
	}

	/**
	 * Do we replace the current menu?
	 *
	 * @return bool
	 */
	public function do_replace() {
		$user_id    = get_current_user_id();
		$user_blogs = get_blogs_of_user( $user_id );
		if ( count( $user_blogs ) > 10 ) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Remove current My Sites menu
	 */
	function ditch_current() {
		global $wp_admin_bar;
		$wp_admin_bar->remove_menu( 'my-sites' );
	}

	/**
	 * Include the magical JS
	 */
	function scripts() {
		if ( $this->do_replace() ) {
			wp_register_script( 'bmsm', plugins_url( '/js/bmsm.js', __FILE__ ), array( 'jquery' ) );
			wp_enqueue_script( 'bmsm' );
		}
	}

	/**
	 * Include the CSS
	 */
	function styles() {
		if ( $this->do_replace() ) {
			wp_enqueue_style( 'bmsm', plugins_url( "/css/style.css", __FILE__ ), false );
		}
	}
}

$bmsm = new Better_My_Sites_Menu();

require_once( 'add-menu.php' );