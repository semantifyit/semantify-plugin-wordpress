<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 8.5.17
 * Time: 14:40
 */

    if(!extension_loaded('curl')) {
        echo "<br/>";
        $this->h->displayMessage("error","<b>".__('No cURL installed!', $this->plugin_name)."</b>"."<br>".__('This plugin requires cURL library for getting annotations. Without this library, the semantify.it plugin will not work!', $this->plugin_name) );
        die();
    }
