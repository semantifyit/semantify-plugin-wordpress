<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 8.5.17
 * Time: 14:40
 */

$admin_url = admin_url( 'admin.php?page=' . $this->plugin_name );


    if(!extension_loaded('curl')) {
        echo "<br/>";
        $this->h->displayMessage("error","<b>".__('No cURL installed!', $this->plugin_name)."</b>"."<br>".__('This plugin requires cURL library for getting annotations. Without this library, the semantify.it plugin will not work!', $this->plugin_name) );
        die();
    }


if( ((isset($annotations)) && (count($annotations)<=3)) || (isset($admin)) ){

    if(!$Semantify->isApiKeyValid()){
        echo"</br>";
        if($admin){
            $this->h->displayMessage("error","<b>".__('Wrong API key', $this->plugin_name)."</b>"."<br>".__('You added an API which is not a correct one.', $this->plugin_name) );
            echo"</br>";
        }else{
            $this->h->displayMessage("error","<b>".__('Wrong API key', $this->plugin_name)."</b>"."<br>".__('You added an API which is not a correct one. Please add a new API key in ', $this->plugin_name)."<a href='".$admin_url."'>Settings</a>" );
            die();
        }

    }
}

$this->h->displayMessage("notice","<b>".__('This plugin is deprecated', $this->plugin_name)."</b>"."<br>".__('Please install our new plugin ', $this->plugin_name)."<a class='thickbox' href='".esc_url( network_admin_url('plugin-install.php?tab=plugin-information&plugin=' . "instant-annotation" . '&TB_iframe=true&width=600&height=550' ) )."'>Instant Annotation</a><br/>".__('All data from Semantify plugin have already been migrated to Instant Annotation, so all you need to do is only to ', $this->plugin_name)."<a class='thickbox' href='".esc_url( network_admin_url('plugin-install.php?tab=plugin-information&plugin=' . "instant-annotation" . '&TB_iframe=true&width=600&height=550' ) )."'>install it</a>");
echo "<br/>";