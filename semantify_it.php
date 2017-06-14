<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              www.semantify.it
 * @since             1.0.0
 * @package           Semantify_it
 *
 * @wordpress-plugin
 * Plugin Name:       semantify.it
 * Description:       Deploy your annotations from semantify.it to your wordpress website.
 * Version:           0.1.1
 * Author:            semantify.it
 * Author URI:        www.semantify.it
 * Text Domain:       semantify_it
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-semantify_it-activator.php
 */
function activate_semantify_it() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-semantify_it-activator.php';
	Semantify_it_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-semantify_it-deactivator.php
 */
function deactivate_semantify_it() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-semantify_it-deactivator.php';
	Semantify_it_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_semantify_it' );
register_deactivation_hook( __FILE__, 'deactivate_semantify_it' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-semantify_it.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_semantify_it() {

    $development = array("sti.dev", "staging.semantify.it", "demo.semantify.it");

    //switch to stagging server if it is on the development server
    if(in_array($_SERVER['HTTP_HOST'],$development)) {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
    }


	$plugin = new Semantify_it();
	$plugin->run();

}
run_semantify_it();
