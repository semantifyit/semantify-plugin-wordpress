<?php
use \STI\SemantifyIt\Includes\Helpers;


/**
 * The admin-specific functionality of the plugin.
 *
 * @link       www.semantify.it
 * @since      1.0.0
 *
 * @package    Semantify_it
 * @subpackage Semantify_it/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Semantify_it
 * @subpackage Semantify_it/admin
 * @author     Richard Dvorsky <richard.dvorsky@sti2.at>
 */
class Semantify_it_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
        $this->h = new Helpers($plugin_name, $version);


    }

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/semantify_it-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/semantify_it-admin.js', array( 'jquery' ), $this->version, false );
	}


    public function add_plugin_admin_menu()
    {

        /**
     * Add a settings page for this plugin to the Settings menu.
     *
     * NOTE:  Alternative menu locations are available via WordPress administration menu functions.
     *
     *        Administration Menus: http://codex.wordpress.org/Administration_Menus
     *
     */
        add_options_page( 'semantify.it', 'semantify.it', 'manage_options', $this->plugin_name, array($this, 'display_plugin_setup_page'));

    }



    /**
     * Add settings action link to the plugins page.
     *
     * @since    1.0.0
     */

    public function add_action_links( $links )
    {
        /*
    *  Documentation : https://codex.wordpress.org/Plugin_API/Filter_Reference/plugin_action_links_(plugin_file_name)
    */

        $settings_link = array(
            '<a href="' . admin_url( 'admin.php?page=' . $this->plugin_name ) . '">' . __('Settings', $this->plugin_name) . '</a>',
        );
        return array_merge(  $settings_link, $links );

    }


    /**
     * Render the settings page for this plugin.
     *
     * @since    1.0.0
     */

    public function display_plugin_setup_page()
    {
        include_once 'partials/semantify_it-admin-display.php';
    }



    /* Meta box setup function. */
    public function add_meta_boxes_admin() {

        $post_types=get_post_types(array('public'=>true));

        foreach( $post_types as $post_type )
        {
            add_meta_box(
                'semantify_it', // $id
                __( 'semantify.it' ), // $title
                array( $this, 'meta_boxes_display' ), // $callback
                $post_type,
                'normal',
                'high'
            );
        }

    }

    function meta_boxes_display($post) {
        include_once 'partials/meta_boxes_display.php';
    }






    /**
     *  AJAX calls
     *
     */

    public function prefix_ajax_save_api_key()
    {
        $this->h->securityCheck($_POST);
        include_once 'ajax/save.php';
    }



}
