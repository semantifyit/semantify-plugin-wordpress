<?php
	
		
	if(isset($_POST["config"])){
		$this->f->savePostConfig($_POST["config"]);
	}
	

	$delete = $this->f->deleteContent($this->f->saveSlug);


	if($delete){
		$this->f->displayMessage("success","<b>".__('Success!', 'wp_schematize')."</b>"."<br>".__('Everything was successfully deleted.', 'wp_schematize') );
	}else{
		$this->f->displayMessage("error","<b>".__('Not Deleted!', 'wp_schematize')."</b>"."<br>".__('Annotations are still in DB because the delete was unsucesfull.', 'wp_schematize') );
	}

?>	





<?php	
	wp_die();
?>