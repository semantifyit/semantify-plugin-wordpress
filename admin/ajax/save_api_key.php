<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2.5.17
 * Time: 10:50
 */


/*
 	$json = json_encode($_POST["data"],JSON_UNESCAPED_SLASHES);

 	//var_dump($_POST["data"]);

 	//var_dump($json);

 	$save = false;

 	if(isset($_POST["config"])){
 		$this->savePostConfig($_POST["config"]);
 	}


 	$save = $this->saveContent($this->saveSlug, $json);


 	if($save){
 		$this->displayMessage("success","<b>".__('Success!', 'wp_schematize')."</b>"."<br>".__('Everything was successfully saved into Wordpress Database.', 'wp_schematize') );
 	}else{
 		$this->displayMessage("info","<b>".__('Not changed', 'wp_schematize')."</b>"."<br>".__('Annotations was not saved into Wordpress Database, because there was a no change.', 'wp_schematize') );
 	}
*/
 ?>







 <?php
 	wp_die();
 ?>