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
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="container">
    <!-- This file should primarily consist of HTML with a little bit of PHP. -->
    <br>
    <div class="logo-box"><img src="<?php echo plugin_dir_url( __FILE__ );?>../img/ext_icon.png" class="logo"></div>
    <h1> <?php esc_attr_e( 'semantify.it', $this->plugin_name ); ?> </h1>



    <h2>General settings</h2>
    <p><?php esc_attr_e( 'Deploy your annotations to your wordpress website', $this->plugin_name ); ?></p>

    <div id="response-notice" class="response hide"></div>

<div class="postbox" id="load-url-box">
    <div class="inside">
        <h3><span><?php esc_attr_e( 'Website API Key', $this->plugin_name ); ?></span></h3>

        <form name='api-key' id="api-key" data-target="#response-notice" >
            <?php echo wp_nonce_field( 'semantify_it_ajax', '_wpnonce_semantify_it' ); ?>
            <p>
                <?php esc_attr_e( 'Please input your Website API key to start using semantify.it on your webpage. If you don\'t have a API key please visit', $this->plugin_name ); ?> <a href="https://www.semantify.it">https://www.semantify.it</a>
            </p>

            <input type="hidden" name="action" value="save_api_key">
            <input type="hidden" name="config[type]" value="settings">
            <input type="text" name="data[api_key]" class="code large-text" value="<?php echo $this->h->loadContent('api_key'); ?>">
            <button class="button-primary" id="form-save"><?php esc_attr_e( 'Save' ); ?></button>
            <div id="spinner" class="spinner"></div>
        </form>

    </div>
</div>


    <div id="response" class="response hide"></div>

</div>