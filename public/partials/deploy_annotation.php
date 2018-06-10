<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 3.5.17
 * Time: 14:40
 */

use \STI\SemantifyIt\Controller\SemantifyItWrapperController;


$postid = get_the_ID();

if ( is_front_page() ) {
    //echo "front<br/><br/>";
    $postid = get_option( 'page_on_front' );
}

if ( is_home() ) {
    //echo "post<br/><br/>";
    $postid = get_option( 'page_for_posts' );
}



if(!( (!$postid) || ($postid=='0') || ($postid==false) || ($postid=='') )) {

    $apiKey = $this->h->loadContent('api_key');
    $apiSecret = $this->h->loadContent('api_secret');


    if(!$apiKey){
        return;
    }

    $Semantify = new SemantifyItWrapperController($apiKey, $apiSecret);

    $annotationByURL = $this->h->loadContent('annotationByURL');

    $config["type"] = "meta";
    $config["postid"] = $postid;
    //echo "#".$postid."#";
    $this->h->setConfig($config);

    $annotationID = $this->h->loadContent('annotationID');

    //echo "id:".$annotationID;

    $annotation = '';
    $annotationID = trim($annotationID);

    if ( $annotationID!="" && $annotationID!="0" && $annotationID!==0 )
    {
        /* load annotation by id */
        //echo " ok ";
        $annotation = $Semantify->getAnnotation($annotationID);

    }elseif($annotationByURL=="1") {
        /* load annotation by url */
        //echo " no ";
        $url = get_permalink( $postid );
        $annotation = $Semantify->getAnnotationByURL($url);
        //echo "#annotation:".$annotation."#";
    }

    if (($annotation != '') && ($annotation != '0') && ($annotation != NULL) && ($annotation!='{}')) {
            $html = $Semantify->cover_annotation_into_html($annotation);
            echo $html;
    }

}