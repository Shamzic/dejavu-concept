<?php 

// Depreciated will be removed soon.

$ascend = ascend_get_options();
if(isset($ascend['site_layout'])) {
    $site_layout = $ascend['site_layout'];
} else {
    $site_layout = 'above';
}
if($site_layout == 'left' || $site_layout == 'right') {
	get_template_part('templates/header-vertical');
} else {
	get_template_part('templates/header-above');
}
get_template_part('templates/header-mobile');
?>