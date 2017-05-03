<?php
use \STI\SemantifyIt\Includes\Helpers;


/**
 * The public-facing functionality of the plugin.
 *
 * @link       www.semantify.it
 * @since      1.0.0
 *
 * @package    Semantify_it
 * @subpackage Semantify_it/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Semantify_it
 * @subpackage Semantify_it/public
 * @author     Richard Dvorsky <richard.dvorsky@sti2.at>
 */
class Semantify_it_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;


    /**
     * @var \Helpers
     * helper variable
     */
    private $h;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
        $this->h = new Helpers($plugin_name, $version);
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Semantify_it_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Semantify_it_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/semantify_it-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Semantify_it_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Semantify_it_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/semantify_it-public.js', array( 'jquery' ), $this->version, false );

	}

    public function deploy_annotation(){

        include_once 'partials/deploy_annotation.php';

    }




}
