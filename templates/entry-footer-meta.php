<?php 
$ascend = ascend_get_options();

echo '<meta itemprop="dateModified" content="'.esc_attr( get_the_modified_date('c') ).'">';
echo '<div itemprop="publisher" itemscope itemtype="https://schema.org/Organization">';
	if ( isset( $ascend['ascend_logo']['url'] ) && !empty( $ascend['ascend_logo']['url'] ) ) {  
		echo '<div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">';
		echo '<meta itemprop="url" content="'.esc_attr( $ascend['ascend_logo']['url'] ).'">';
		echo '<meta itemprop="width" content="'.esc_attr( $ascend['ascend_logo']['width'] ).'">';
		echo '<meta itemprop="height" content="'.esc_attr( $ascend['ascend_logo']['height'] ).'">';
		echo '</div>';
	}
	echo '<meta itemprop="name" content="'.esc_attr( get_bloginfo('name') ).'">';
echo '</div>';