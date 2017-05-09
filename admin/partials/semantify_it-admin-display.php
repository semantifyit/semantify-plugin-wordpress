<?php



/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       www.semantify.it
 * @since      1.0.0
 *
 * @package    Semantify_it
 * @subpackage Semantify_it/admin/partials
 */

use \STI\SemantifyIt\Controller\SemantifyItWrapperController;

$apikey = $this->h->loadContent('api_key');
$Semantify = new SemantifyItWrapperController($apikey);

$admin = 1;



?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="container">
    <!-- This file should primarily consist of HTML with a little bit of PHP. -->
    <br>
    <div class="logo-box"><img src="<?php echo plugin_dir_url( __FILE__ );?>../img/ext_icon.png" class="logo"></div>
    <h1> <?php esc_attr_e( 'semantify.it', $this->plugin_name ); ?> </h1>



    <h2>General settings</h2>
    <p><?php esc_attr_e( 'Deploy your annotations to your wordpress website', $this->plugin_name ); ?></p>

    <div class="response"><?php include_once "semantify_it-admin-notices.php"; ?></div>
    <div id="response-notice" class="response hide"></div>

<div class="postbox" id="load-url-box">
    <div class="inside">


        <form name='api-key' id="api-key" data-target="#response-notice" >
            <?php echo wp_nonce_field( 'semantify_it_ajax', '_wpnonce_semantify_it' ); ?>
            <input type="hidden" name="action" value="save_api_key">
            <input type="hidden" name="config[type]" value="settings">
            <h4><span><?php esc_attr_e( 'Website API Key', $this->plugin_name ); ?></span></h4>
            <p>
                <?php esc_attr_e( 'Please input your Website API key to start using semantify.it on your webpage. If you don\'t have a API key please visit', $this->plugin_name ); ?> <a href="https://www.semantify.it">https://www.semantify.it</a>
            </p>
            <input type="text" name="data[api_key]" class="code large-text" value="<?php echo $this->h->loadContent('api_key'); ?>"><br/>
            <br/>
            <h4><span><?php esc_attr_e( 'Automatic Annotation search by URL', $this->plugin_name ); ?></span></h4>
            <p>
                <?php esc_attr_e('Please check this checkbox if you want to have dynamic search for your annotation on semantify.it by the URL', $this->plugin_name ); ?>
            </p>
            <input type="hidden" name="data[annotationByURL]" value="0" />
            <input type="checkbox" name="data[annotationByURL]" class="" value="1" <?php echo ($this->h->loadContent('annotationByURL')=='1' ? 'checked' : '') ?>></br></br>



            <button class="button-primary" id="form-save"><?php esc_attr_e( 'Save' ); ?></button>
            <div id="spinner" class="spinner"></div>
        </form>

    </div>
</div>


    <div id="response" class="response hide"></div>

</div>