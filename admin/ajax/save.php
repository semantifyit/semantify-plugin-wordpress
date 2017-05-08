<?php

	//var_dump($_POST["data"]);

	//var_dump($json);

	//var_dump($_POST);

	$save = false;

	if(isset($_POST["config"])){
		$this->h->setConfig($_POST["config"]);
	}


	if(isset($_POST["data"])){
		foreach($_POST["data"] as $key => $data){
            $new_save = $this->h->saveContent($key, trim($data));
            if($new_save==1){
                $save = true;
			}
		}
	}

	if(isset($_POST["json"])){
        $json = json_encode($_POST["json"],JSON_UNESCAPED_SLASHES);

        $save = $this->h->saveContent($_POST["slug"], $json);

	}



	//if($save){
		$this->h->displayMessage("success","<b>".__('Success!', $this->plugin_name)."</b>"."<br>".__('Everything was successfully saved into Wordpress Database.', $this->plugin_name) );
	//}else{
	//		$this->h->displayMessage("info","<b>".__('Not changed', $this->plugin_name)."</b>"."<br>".__('The content was not saved into Wordpress Database because there was a no change.', $this->plugin_name) );
	//}


?>	





<?php	
	wp_die();
?>