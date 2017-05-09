<?php

$admin_url = admin_url( 'admin.php?page=' . $this->plugin_name );





if(($apikey=='')||($apikey=='0')){
    echo"</br>";

    $this->h->displayMessage("error","<b>".__('No API key', $this->plugin_name)."</b>"."<br>".__('You haven`t added an API key and plugin is not working yet. Please add an API key in ', $this->plugin_name)."<a href='".$admin_url."'>Settings</a>" );
    die();
}



if($annotationByURL){
    echo"</br>";

    /*if we have an annotation by url but is loaded a new annotation*/
    if(!(($annotationID=='0')||($annotationID==''))){
        echo $this->h->displayMessage("info","<b>".__('Automatic annotations overriden', $this->plugin_name)."</b>"."<br>".__('You have activated automatic annotations by URL, but this webpage has overridden annotation by annotation whith id: ', $this->plugin_name)."<code>".$annotationID."</code>. ".__('If you want to load annotation by url, please choose option <code>None Annotation</code>', $this->plugin_name));

    }else{
        if(!$Semantify->isURLAnnotationAvailable($url)){
            echo $this->h->displayMessage("notice","<b>".__('No annotation found for this URL', $this->plugin_name)."</b>"."<br>".__('You have activated automatic annotations by URL. But we haven`t found an annotation for this website URL:', $this->plugin_name)." <code>".$url."</code> ".__('Try uploading annotation to semantify.it or choose annotation from the list.', $this->plugin_name) );
        }else{
            echo $this->h->displayMessage("success","<b>".__('Automatic annotation found', $this->plugin_name)."</b>"."<br>".__('Annotation for this site was found and deployed on this webpage.', $this->plugin_name));
        }
    }




}
