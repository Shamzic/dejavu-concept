<?php 
$ascend = ascend_get_options();
if(isset($ascend['site_layout'])) {
    $site_layout = $ascend['site_layout'];
} else {
    $site_layout = 'left';
}

?>
<aside id="kad-vertical-menu" class="asideclass kad-vertical-menu kt-header-position-<?php echo esc_attr($site_layout); ?>">
    <div class="kad-vertical-menu-inner">
        <div class="kad-scrollable-area">
            <div class="kad-fixed-vertical-background-area"></div>
            <div class="kad-relative-vertical-content">
                <?php 
                /* 
		        * Hooked ascend_the_custom_logo 10
		        * Hooked ascend_header_vertical_extras 20
		        */
                do_action('ascend_start_vertical_header'); 
    
                /* 
		        * Hooked ascend_primary_vertical_menu 20
		        */
                do_action('ascend_menu_vertical_header'); 

                /* 
		        * Hooked ascend_header_vertical_extras 20
		        */
                do_action('ascend_end_vertical_header'); ?>
            </div>
        </div>
    </div> <!-- close v header innner -->
</aside>
 <?php 
/* 
    * Hooked ascend_secondary_menu 20
    */
do_action('ascend_after_vertical_header'); 
?>