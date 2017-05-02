<?php
	
	$path = "";
	$form = "";
	
	
	if(isset($_POST["data"]["url"]))
	{ 
		 $path = $_POST["data"]["url"];
		 
		 //if we loaded configuration of post by meta boxes
		 if(isset($_POST["config"])){
			  $this->f->savePostConfig($_POST["config"]);
		 }
				 
		 $form = $this->f->makeFormURL($path);
		 if($form===false){
			 $this->f->displayMessage("error","<b>".__('Not valid JSON-LD!', 'wp_schematize')."</b>"."<br>JSON-LD from url: <a href='".$path."'><code>".$path."</code></a> contains:<code>".file_get_contents($path)."</code>" );
		 }	 
		 
		 
	}elseif($_POST["data"]["local"]){
		
		 if(isset($_POST["config"])){
			  $this->f->savePostConfig($_POST["config"]);
		 }
		
		$loadedContent = $this->f->loadSavedContent($this->f->saveSlug);

		if(($loadedContent!==false)&&(!@$this->f->postConfig["new"]=="true")){
			$path="Wordpress Database";
			$form = $this->f->makeFormRawJson($loadedContent);
		}else{
			$path="Example file";
			if(@$this->f->postConfig["type"] == "meta"){
				$form = $this->f->makeFormLocal(plugin_dir_path( __FILE__ ) ."room.jsonld");
			}else{
				$form = $this->f->makeFormLocal(plugin_dir_path( __FILE__ ) ."hotel.jsonld");
			}
		}	

	}

?>

<div class="postbox">
		<div class="inside">
			<h3><span><?php echo esc_attr_e( 'Loaded annotations from', 'wp_schematize' ).':</span> <code>'.$path.'</code>'; ?></h3>
			<?php echo $form ?>
		</div>
</div>	


<?php	
	wp_die();
?>

