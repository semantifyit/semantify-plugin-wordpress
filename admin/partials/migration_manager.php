<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018-09-09
 * Time: 16:27
 */



$mig = $this->h->isContentSaved($this->plugin_name . "-" .'migration');


/* check if migration was already done */

if(!$mig){

    $apiKey = $this->h->loadContent('api_key');
    $apiSecret = $this->h->loadContent('api_secret');

    /**
     * migration of credentials
     */

    /* check if you already have saved credentials */
    if(!$this->h->isContentSaved("iasemantify")){

        $credentials = array(
            "websiteUID" => $apiKey,
            "websiteSecret" => $apiSecret
        );

        $this->h->saveContentDirt("iasemantify",$credentials);
    }



    /**
     * migration of posts
     */

    $args = array(
        'post_type'  => 'any',
        'fields'        => 'ids',
        'meta_query' => array(
            array(
                'key'     => 'semantify_it-annotationID'
            )
        )
    );
    $query = new WP_Query( $args );


    $config["type"]="meta";

    foreach($query->posts as $id){

        $config["postid"]=$id;
        $this->h->setConfig($config);

        //var_dump($this->h->getConfig());

        $uid = $this->h->loadContent('annotationID');
        //var_dump($uid);

        if($uid!=""){
            $sentence = ",".$uid.";NO_DS;".$apiKey.";".$apiSecret.";";

            if($this->h->loadContentDirt("iasemantify_ann_id")==""){
                $this->h->saveContentDirt("iasemantify_ann_id", $sentence);
            }
        }


    }
    //back to normal
    $config["type"]="";
    $this->h->setConfig($config);

    $this->h->saveContent("migration",1);

}