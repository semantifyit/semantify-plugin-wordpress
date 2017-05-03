<?php
	
	$path = "";
	$form = "";
	
	
	if(isset($_POST["data"]["url"]))
	{ 
		 $path = $_POST["data"]["url"];
		 
		 //if we loaded configuration of post by meta boxes
		 if(isset($_POST["config"])){
			  $this->h->savePostConfig($_POST["config"]);
		 }
				 
		 $form = $this->h->makeFormURL($path);
		 if($form===false){
			 $this->h->displayMessage("error","<b>".__('Not valid JSON-LD!', 'wp_schematize')."</b>"."<br>JSON-LD from url: <a href='".$path."'><code>".$path."</code></a> contains:<code>".file_get_contents($path)."</code>" );
		 }	 
		 
		 
	}elseif($_POST["data"]["local"]){
		
		 if(isset($_POST["config"])){
			  $this->h->savePostConfig($_POST["config"]);
		 }
		
		$loadedContent = $this->h->loadSavedContent($this->h->saveSlug);

		if(($loadedContent!==false)&&(!@$this->h->postConfig["new"]=="true")){
			$path="Wordpress Database";
			$form = $this->h->makeFormRawJson($loadedContent);
		}else{
			$path="Example file";
			if(@$this->h->postConfig["type"] == "meta"){
				$form = $this->h->makeFormLocal(plugin_dir_path( __FILE__ ) ."room.jsonld");
			}else{
				$form = $this->h->makeFormLocal(plugin_dir_path( __FILE__ ) ."hotel.jsonld");
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

