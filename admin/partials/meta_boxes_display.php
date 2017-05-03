<?php

use \STI\SemantifyIt\Controller\SemantifyItWrapperController;

$apikey = $this->h->loadContent('api_key');


$config["type"]="meta";
$config["postid"]=$post->ID;
$this->h->setConfig($config);


$annotationID = $this->h->loadContent('annotationID');



$Semantify = new SemantifyItWrapperController($apikey);
$annotations = $Semantify->getAnnotationList();
$list        = $this->h->makeList($annotations);



//littlbe bit different from settings page

?>
<div class="container">

    <div id="response-notice" class="response hide"></div>

        <div class="inside">
            <h3><span><?php esc_attr_e( 'Annotation deployment', $this->plugin_name ); ?></span></h3>

            <div class='form'>
                <p>
                    <?php esc_attr_e( 'Choose an annotation from the list for your webpage content.',  $this->plugin_name ); ?>
                </p>

                <input type="hidden" name="config[action]" value="load_annotations_form">
                <input type="hidden" name="config[type]" value="<?php echo $this->h->postConfig["type"]; ?>">
                <input type="hidden" name="config[postid]" value="<?php echo $this->h->postConfig["postid"]; ?>">
                <select name="annotationID"><?php echo $list; ?></select>
                <button class="button-primary" id="load-url-form-submit-button"><?php esc_attr_e( 'Attach annotation' ); ?></button>
                <div id="spinner" class="spinner"></div>
            </div>

        </div>


    <div id="response" class="response hide"></div>
</div>