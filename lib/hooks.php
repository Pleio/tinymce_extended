<?php

function tinymce_extended_plugin_setting($hook_name, $entity_type, $return_value, $params) {
	static $shutdown_registered;
	
	if (!isset($shutdown_registered)) {
		if (!empty($params)  && is_array($params)) {
			if (($plugin = elgg_extract("plugin", $params)) && ($plugin->getID() == "tinymce_extended")) {
				
				register_shutdown_function("elgg_invalidate_simplecache");
				$shutdown_registered = true;
			}
		}
	}
}