<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
if ( ! class_exists( 'Ascend_Get_Image' ) ) {
	class Ascend_Get_Image {
        /**
         * The singleton instance
         */
        static private $instance = null;
        /**
         * No initialization allowed
         */
        private function __construct() {}

        /**
         * No cloning allowed
         */
        private function __clone() {}

        static public function getInstance() {
            if(self::$instance == null) {
                self::$instance = new self;
            }

            return self::$instance;
        }

        public function process($id = null, $width = null, $height = null) {
			// return if no ID
			if(empty($id)) {
				return false;
			}
			// return with orginal if no width or height set.
			if(empty($width) && empty($height) ) {
				return self::ascend_get_full_image($id);
			}
			// Find width or height if one or the other is not set.
			$org_height = true;
			if(empty($height) ) {
				$org_height = false;
		        $image_attributes = wp_get_attachment_image_src( $id, 'full' );
		        $sizes = image_resize_dimensions($image_attributes[1], $image_attributes[2], $width, null, false );
		        $height = $sizes[5];
		    } else if(empty($width) ) {
		        $image_attributes = wp_get_attachment_image_src( $id, 'full' );
		        $sizes = image_resize_dimensions($image_attributes[1], $image_attributes[2], null, $height, false );
		        $width = $sizes[4];
		    }
		    // Now we checked for an ID, made sure the width and height have values lets check if we can make the size at all
		    if ( self::ascend_image_size_larger_than_original( $id, $width, $height ) ) {
		    	return self::ascend_get_full_image($id);
			}
		    //Check for jetpack
		    if( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'photon' ) ) {
		    	$args = array( 'resize' => $width . ',' . $height );
		    	$image_url = wp_get_attachment_image_url($id, 'full');
		    	return array (
		            0 => jetpack_photon_url( $image_url, $args ),
		            1 => $width,
		            2 => $height,
		            3 => self::ascend_get_srcset_output($id, $image_url, $width, $height),
					4 => $image_url,
					5 => $id
		        );
		    } else if( self::ascend_image_size_already_exists( $id, $width, $height ) ) {

		    		return self::ascend_get_image_at_size($id, $width, $height );

		    } else if(class_exists( 'Kadence_Image_Processing' )) {
		    	// lets process the image
		    	$Kadence_Image_Processing = Kadence_Image_Processing::getInstance();
            	$created = $Kadence_Image_Processing->process($id, $width, $height);
            	if($created) {
		    		return self::ascend_get_image_at_size($id, $width, $height );
			    } else {
			    	return self::ascend_get_full_image($id);
			    }
		    } else {
		    	//get the next best thing
		    	if(800 < $width) {
		    		// Large image
		    		return self::ascend_get_full_image($id);
		    	} else if($org_height) {
		    		//custom_ratio
		    		if($width == $height) {
		    			// square
		    			if(150 >= $width) {
		    				// Thumbnail
		    				return self::ascend_get_image_at_size($id, 150,150);
		    			} else {
		    				// Ascend 600x600
		    				return self::ascend_get_image_at_size($id, 600,600);
		    			}
		    		} else if(310 == $height && 270 == $width ) {
		    			return self::ascend_get_image_at_size($id, 540,620);
					} else if(($width/$height) == 1.5){
						return self::ascend_get_image_at_size($id, 720,480);
					} else {
						return self::ascend_get_full_image($id);
					}
		    	} else {
		    		// Orginal ratio
		    		if(300 >= $width) {
		    			return self::ascend_get_image_at_size_name($id, 'medium');
		    		} elseif(800 > $width) {
		    			return self::ascend_get_image_at_size_name($id, 'large');
		    		} else {
		    			return self::ascend_get_full_image($id);
		    		}
		    	}

		    }
		}
		public static function ascend_get_image_srcset($id = null, $url = null, $width = null, $height = null) {
		  	if(empty($id) || empty($url) || empty($width) || empty($height)) {
		    	return false;
		  	}
		  
		  	$image_meta = self::ascend_get_image_meta($id);
		  	if ( ! $image_meta ) {
				return false;
			}
		  	
			if(function_exists ( 'wp_calculate_image_srcset') ){
		  		$output = wp_calculate_image_srcset(array( $width, $height), $url, $image_meta, $id);
			} else {
		  		$output = '';
			}

		    return $output;
		}
		public static function ascend_get_srcset_output($id = null, $url = null, $width = null, $height = null) {
		    $img_srcset = self::ascend_get_image_srcset($id, $url, $width, $height);
		    if(!empty($img_srcset) ) {
		      	$output = 'srcset="'.esc_attr($img_srcset).'" sizes="(max-width: '.esc_attr($width).'px) 100vw, '.esc_attr($width).'px"';
		    } else {
		      	$output = '';
		    }
		    return $output;
		}
		public static function ascend_image_size_larger_than_original($id, $width, $height) {
				$image_meta = self::ascend_get_image_meta( $id );

				if ( ! isset( $image_meta['width'] ) || ! isset( $image_meta['height'] ) ) {
					return true;
				}
				if ( $width > $image_meta['width'] || $height > $image_meta['height'] ) {
					return true;
				}

				return false;
		}
		public static function ascend_get_full_image($id) {
				$src = wp_get_attachment_image_src($id, 'full' );
				// array return.
				$image = array (
					0 => $src[0],
					1 => $src[1],
					2 => $src[2],
					3 => self::ascend_get_srcset_output($id, $src[0], $src[1], $src[2]),
					4 => $src[0],
					5 => $id
				);
				return $image;
		}
		public static function ascend_get_image_at_size($id, $width, $height) {
				$size = array(
					0 => $width,
					1 => $height
				);
				$src = wp_get_attachment_image_src($id, $size );
				$full = wp_get_attachment_image_url($id, 'full' );
				// array return.
				$image = array (
					0 => $src[0],
					1 => $src[1],
					2 => $src[2],
					3 => self::ascend_get_srcset_output($id, $src[0], $src[1], $src[2]),
					4 => $full,
					5 => $id
				);
				return $image;
		}
		public static function ascend_get_image_at_size_name($id, $size) {
				$src = wp_get_attachment_image_src($id, $size );
				$full = wp_get_attachment_image_url($id, 'full' );
				// array return.
				$image = array (
					0 => $src[0],
					1 => $src[1],
					2 => $src[2],
					3 => self::ascend_get_srcset_output($id, $src[0], $src[1], $src[2]),
					4 => $full,
					5 => $id
				);
				return $image;
		}
		public static function ascend_get_image_meta( $id ) {
			return wp_get_attachment_metadata( $id );
		}
		public static function ascend_image_size_already_exists( $id, $width, $height ) {
			$image_meta = self::ascend_get_image_meta( $id );
			$ascend_size_name = self::ascend_get_size_name( array( $width, $height ));
			$kip_size_name = self::kip_get_size_name( array( $width, $height ));
			if(isset( $image_meta['sizes'][ $ascend_size_name ] ) || isset( $image_meta['sizes'][ $kip_size_name ] ) ) {
				return true;
			} else {
				return false;
			}
		}
		public static function ascend_get_size_name( $size ) {
			return 'ascend-' . $size[0] . 'x' . $size[1];
		}
		public static function kip_get_size_name( $size ) {
			return 'kip-' . $size[0] . 'x' . $size[1];
		}
	}
}
