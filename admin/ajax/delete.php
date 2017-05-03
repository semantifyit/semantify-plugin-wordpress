<?php
	
		
	if(isset($_POST["config"])){
		$this->h->savePostConfig($_POST["config"]);
	}
	

	$delete = $this->h->deleteContent($this->h->saveSlug);


	if($delete){
		$this->h->displayMessage("success","<b>".__('Success!', 'wp_schematize')."</b>"."<br>".__('Everything was successfully deleted.', 'wp_schematize') );
	}else{
		$this->h->displayMessage("error","<b>".__('Not Deleted!', 'wp_schematize')."</b>"."<br>".__('Annotations are still in DB because the delete was unsucesfull.', 'wp_schematize') );
	}

?>	





<?php	
	wp_die();
?>