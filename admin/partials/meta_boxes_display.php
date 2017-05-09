<?php

use \STI\SemantifyIt\Controller\SemantifyItWrapperController;

$admin = 0;
$apikey = $this->h->loadContent('api_key');
$annotationByURL = $this->h->loadContent('annotationByURL');

$url = get_permalink( $post->ID );
$config["type"]="meta";
$config["postid"]=$post->ID;
$this->h->setConfig($config);


$annotationID = $this->h->loadContent('annotationID');



$Semantify = new SemantifyItWrapperController($apikey);
$annotations = $Semantify->getAnnotationList();
$list        = $this->h->makeList($annotations,$annotationID);





//littlbe bit different from settings page

?>
<div class="container">



        <div class="inside">
            <div class="seresponse"><?php include_once "semantify_it-admin-notices.php"; ?><?php include_once "meta_boxes_notices.php"; ?></div>
            <h3><span><?php esc_attr_e( 'Annotation deployment', $this->plugin_name ); ?></span></h3>
            <p>
                <?php esc_attr_e( 'Choose an annotation from the list for your webpage content.',  $this->plugin_name ); ?>
            </p>

            <div id="response-notice" class="response hide"></div>
            <div class='form' data-target="#response-notice" >

                <?php echo wp_nonce_field( 'semantify_it_ajax', '_wpnonce_semantify_it' ); ?>

                <input type="hidden" name="config[action]" value="save_api_key">
                <input type="hidden" name="config[type]" value="<?php echo $this->h->config["type"]; ?>">
                <input type="hidden" name="config[postid]" value="<?php echo $this->h->config["postid"]; ?>">
                <select name="data[annotationID]"><?php echo $list; ?></select>
                <button class="button-primary" id="load-url-form-submit-button"><?php esc_attr_e( 'Attach annotation' ); ?></button>
                <div id="spinner" class="spinner"></div>
            </div>

        </div>


    <div id="response" class="response hide"></div>
</div>