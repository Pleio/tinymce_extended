<?php

$version = elgg_get_plugin_setting("version", "tinymce_extended");

if ($version == 4) {
    include("tinymce-4.php");
} else {
    include("tinymce-3.php");
}
