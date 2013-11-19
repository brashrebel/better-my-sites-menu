<?php
/**
 * Plugin Name: Better My Sites Menu
 * Description: Basic adjustments to improve the My Sites menu for multiple-site admins.
 * Version: 1.0
 * Author: Kyle Maurer
 * Author URI: http://realbigmarketing.com/staff/kyle
 * License: http://opensource.org/licenses/gpl-2.0.php GNU Public License or later
 */

/*
Credit for the hover scroll script: http://css-tricks.com/long-dropdowns-solution/
More admin bar help here: http://technerdia.com/1140_wordpress-admin-bar.html
*/

/*
 *	Remove current My Sites menu
 */
$num_sites = 18;
function ditch_current_my_sites() {
        global $wp_admin_bar;
        $wp_admin_bar->remove_menu('my-sites');
}
add_action('wp_before_admin_bar_render', 'ditch_current_my_sites');

/*
 *	Add new My Sites menu
 */
require_once('add-menu.php');

/*
 *	Add hover scroll effect
 */
function bmsm_load_scripts() {
	wp_enqueue_script( 'bmsm-scripts', plugin_dir_url( __FILE__ ) . 'js/bmsm-scripts.js', array( 'jquery' ));
}
add_action('admin_enqueue_scripts', 'bmsm_load_scripts');

?>