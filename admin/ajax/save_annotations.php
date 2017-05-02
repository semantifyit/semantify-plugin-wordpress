<?php
	
	$json = json_encode($_POST["data"],JSON_UNESCAPED_SLASHES);

	//var_dump($_POST["data"]);

	//var_dump($json);

	$save = false;
	
	if(isset($_POST["config"])){
		$this->f->savePostConfig($_POST["config"]);
	}
	

	$save = $this->f->saveContent($this->f->saveSlug, $json);


	if($save){
		$this->f->displayMessage("success","<b>".__('Success!', 'wp_schematize')."</b>"."<br>".__('Everything was successfully saved into Wordpress Database.', 'wp_schematize') );
	}else{
		$this->f->displayMessage("info","<b>".__('Not changed', 'wp_schematize')."</b>"."<br>".__('Annotations was not saved into Wordpress Database, because there was a no change.', 'wp_schematize') );
	}

?>	





<?php	
	wp_die();
?>