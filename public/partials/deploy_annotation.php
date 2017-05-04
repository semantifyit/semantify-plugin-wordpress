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

    if(!$apiKey){
        return;
    }

    $Semantify = new SemantifyItWrapperController($apiKey);

    $annotationByURL = $this->h->loadContent('annotationByURL');

    $config["type"] = "meta";
    $config["postid"] = $postid;
    $this->h->setConfig($config);

    $annotationID = $this->h->loadContent('annotationID');

    if (($annotationID != '') || ($annotationID != '0')) {
       /* load annotation by id */

        $annotation = $Semantify->getAnnotation($annotationID);

    } else if($annotationByURL==1) {
        /* load annotation by url */

        $url = get_permalink( $postid );
        $annotation = $Semantify->getAnnotationByURL($url);
        //echo "#annotation:".$annotation."#";
    }

    if (($annotation != '') || ($annotation != '0')) {
            $html = $Semantify->cover_annotation_into_html($annotation);
            echo $html;
    }

}