<?php

	//var_dump($_POST["data"]);

	//var_dump($json);

	//var_dump($_POST);

	$save = false;

	if(isset($_POST["config"])){
		$this->f->setConfig($_POST["config"]);
	}


	if(isset($_POST["data"])){
		foreach($_POST["data"] as $key => $data){
            $save = $this->f->saveContent($key, $data);
		}
	}

	if(isset($_POST["json"])){
        $json = json_encode($_POST["json"],JSON_UNESCAPED_SLASHES);

        $save = $this->f->saveContent($_POST["slug"], $json);

	}



	if($save){
		$this->f->displayMessage("success","<b>".__('Success!', $this->plugin_name)."</b>"."<br>".__('Everything was successfully saved into Wordpress Database.', $this->plugin_name) );
	}else{
		$this->f->displayMessage("info","<b>".__('Not changed', $this->plugin_name)."</b>"."<br>".__('Content was not saved into Wordpress Database, because there was a no change.', $this->plugin_name) );
	}


?>	





<?php	
	wp_die();
?>