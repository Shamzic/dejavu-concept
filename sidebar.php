<?php 
/* 
* Sidebar Template
*/

?>
<aside id="ktsidebar" class="<?php echo esc_attr(ascend_sidebar_class()); ?> kad-sidebar">
	<div class="sidebar">
		<?php dynamic_sidebar( ascend_sidebar_id() ); ?>
	</div><!-- /.sidebar -->
</aside><!-- /aside -->