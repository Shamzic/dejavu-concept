<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
add_action( 'ascend_archive_title_container', 'ascend_archive_title', 20 );
function ascend_archive_title() {
	if(ascend_display_pagetitle()){
		get_template_part('/templates/archive', 'header'); 
	} else {
		if( ascend_display_archive_breadcrumbs()) { 
			echo '<div class="kt_bc_nomargin">';
				ascend_breadcrumbs(); 
			echo '</div>';
		}
	}
}
