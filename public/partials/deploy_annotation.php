<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 3.5.17
 * Time: 14:40
 */

use \STI\SemantifyIt\Controller\SemantifyItWrapperController;


$postid = get_the_ID();
if(isset($postid)) {

    $apiKey = $this->h->loadContent('api_key');


    $config["type"] = "meta";
    $config["postid"] = $postid;
    $this->h->setConfig($config);

    $annotationID = $this->h->loadContent('annotationID');

    if (($annotationID != '') || ($annotationID != '0')) {
        $Semantify = new SemantifyItWrapperController($apiKey);
        $annotation = $Semantify->getAnnotation($annotationID);
        if (($annotation != '') || ($annotation != '0')) {
            $html = $Semantify->cover_annotation_into_html($annotation);
            echo $html;
        }
    }
}