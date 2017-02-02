<?php
	
   require_once(dirname(__FILE__) . "/lib/functions.php");
	require_once(dirname(__FILE__) . "/lib/hooks.php");
	
	function tinymce_extended_init() {
		elgg_register_plugin_hook_handler("setting", "plugin", "tinymce_extended_plugin_setting");
		elgg_register_page_handler("tinymce_data", "tinymce_extended_data_handler");
	
        elgg_register_js('tinymce', 'mod/tinymce_extended/vendors/tinymce/js/tinymce-4.2.1/tinymce.min.js');
	}
	
	function tinymce_extended_data_handler(){
		$datapath = str_replace(elgg_get_site_url() . "tinymce_data/", "", current_page_url());
		
		if((strpos($datapath, "images") === 0) || (strpos($datapath, "files") === 0)){
			
			// backwards compatibility == old versions
			$filename = elgg_get_config("dataroot") . "tinymce_storage/" .elgg_get_site_entity()->getGUID() . "/" . $datapath;
		} else {
			$filename = elgg_get_config("dataroot") . "tinymce_storage/" . $datapath;
		}
		
		$contents = file_get_contents($filename);
		
		header("Content-type: " . mime_content_type($filename));
		header("Expires: " . date("r",time() + 864000));
		header("Pragma: public");
		header("Cache-Control: public");
		header("Content-Length: " . strlen($contents));
		echo $contents;
		return true;
	}

	// Make sure the status initialisation function is called on initialisation
	elgg_register_event_handler("init", "system", "tinymce_extended_init");
