<?php

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

// Don't duplicate me!
if (!class_exists('ReduxFramework_ascend_slides')) {

    /**
     * Main ReduxFramework_slides class
     *
     * @since       1.0.0
     */
    class ReduxFramework_ascend_slides {

        /**
         * Field Constructor.
         *
         * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
          function __construct ( $field = array(), $value = '', $parent ) {
            $this->parent = $parent;
            $this->field = $field;
            $this->value = $value;
        }

        /**
         * Field Render Function.
         *
         * Takes the vars and outputs the HTML for the field in the settings
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        public function render() {

             $defaults = array(
                'show' => array(
                    'title' => true,
                    'description' => true,
                    'url' => true,
                ),
                'content_title' => __ ( 'Slide', 'ascend' )
            );

             $this->field = wp_parse_args ( $this->field, $defaults );

           echo '<div class="redux-slides-accordion" data-new-content-title="' . esc_attr ( sprintf ( __ ( 'New %s', 'ascend' ), $this->field[ 'content_title' ] ) ) . '">';

            $x = 0;

             $multi = ( isset ( $this->field[ 'multi' ] ) && $this->field[ 'multi' ] ) ? ' multiple="multiple"' : "";

            if ( isset ( $this->value ) && is_array ( $this->value ) && !empty ( $this->value ) ) {

                $slides = $this->value;

                foreach ( $slides as $slide ) {

                    if ( empty ( $slide ) ) {
                        continue;
                    }


                    $defaults = array(
                        'title' => '',
                        'description' => '',
                        'sort' => '',
                        'link' => '',
                        'image' => '',
                        'target' => '',
                        'url' => '',
                        'thumb' => '',
                        'attachment_id' => '',
                        'height' => '',
                        'width' => '',
                        'select' => array(),
                    );
                    $slide = wp_parse_args( $slide, $defaults );

                   if ( empty ( $slide[ 'thumb' ] ) && !empty ( $slide[ 'attachment_id' ] ) ) {
                        $img = wp_get_attachment_image_src ( $slide[ 'attachment_id' ], 'full' );
                        $slide[ 'image' ] = $img[ 0 ];
                        $slide[ 'width' ] = $img[ 1 ];
                        $slide[ 'height' ] = $img[ 2 ];
                    }

                    echo '<div class="redux-slides-accordion-group"><fieldset class="redux-field" data-id="' . esc_attr($this->field[ 'id' ]) . '"><h3><span class="redux-slides-header">' . esc_html($slide[ 'title' ]) . '</span></h3><div>';

                    $hide = '';
                    if ( empty ( $slide[ 'image' ] ) ) {
                        $hide = ' hide';
                    }

                    echo '<div class="screenshot' . $hide . '">';
                    echo '<a class="of-uploaded-image" href="' . esc_url( $slide[ 'image' ] ) . '">';
                    echo '<img class="redux-slides-image" id="image_image_id_' . $x . '" src="' . esc_url( $slide[ 'thumb' ] ) . '" alt="" target="_blank" rel="external" />';
                    echo '</a>';
                    echo '</div>';

                    echo '<div class="redux_slides_add_remove">';

                    echo '<span class="button media_upload_button" id="add_' . $x . '">' . __ ( 'Upload', 'ascend' ) . '</span>';

                    $hide = '';
                    if ( empty ( $slide[ 'image' ] ) || $slide[ 'image' ] == '' ) {
                        $hide = ' hide';
                    }

                    echo '<span class="button remove-image' . $hide . '" id="reset_' . $x . '" rel="' . esc_attr($slide[ 'attachment_id' ]) . '">' . __ ( 'Remove', 'ascend' ) . '</span>';

                    echo '</div>' . "\n";

                    echo '<ul id="' . $this->field[ 'id' ] . '-ul" class="redux-slides-list">';

                    echo '<li><input type="text" id="' . esc_attr($this->field['id']) . '-url_' . $x . '" name="' . esc_attr($this->field['name']) . '[' . $x . '][url]" value="' . esc_attr($slide['url']) . '" class="full-text upload" placeholder="'.__('URL', 'ascend').'" /></li>';
                    echo '<li><input type="text" id="' . esc_attr($this->field['id']) . '-title_' . $x . '" name="' . esc_attr($this->field['name']) . '[' . $x . '][title]" value="' . esc_attr($slide['title']) . '" placeholder="'.__('Title', 'ascend').'" class="full-text slide-title" /></li>';
                    echo '<li><textarea name="' . $this->field['name'] . '[' . $x . '][description]" id="' . $this->field['id'] . '-description_' . $x . '" placeholder="'.__('Subtitle', 'ascend').'" class="large-text" rows="6">' . esc_attr($slide['description']) . '</textarea></li>';
                    echo '<li><input type="text" id="' . esc_attr($this->field['id']) . '-link_' . $x . '" name="' . esc_attr($this->field['name']) . '[' . $x . '][link]" value="' . esc_attr($slide['link']) . '" placeholder="'.__('Slide Link', 'ascend').'" class="full-text" /></li>';
                    
                    echo '<li><label for="'. esc_attr($this->field['id']) .  '-target_' . $x . '" class="icon-link-target">';
                    echo '<input type="checkbox" class="checkbox-slide-target" id="' . esc_attr($this->field['id']) . '-target_' . $x . '" value="1" ' . checked(  $slide['target'], '1', false ) . ' name="' . esc_attr($this->field['name']) . '[' . $x . '][target]" />';
                    echo ' '.__('Open Link in New Tab/Window', 'ascend'). '</label></li>';

                    echo '<li><input type="hidden" class="slide-sort" name="' . esc_attr($this->field['name']) . '[' . $x . '][sort]" id="' . esc_attr($this->field['id']) . '-sort_' . $x . '" value="' . esc_attr($slide['sort']) . '" />';
                    echo '<li><input type="hidden" class="upload-id" name="' . esc_attr($this->field['name']) . '[' . $x . '][attachment_id]" id="' . esc_attr($this->field['id']) . '-image_id_' . $x . '" value="' . esc_attr($slide['attachment_id']) . '" />';
                    echo '<input type="hidden" class="upload-thumbnail" name="' . esc_attr($this->field['name']) . '[' . $x . '][thumb]" id="' . esc_attr($this->field['id']) . '-thumb_url_' . $x . '" value="' . esc_attr($slide['thumb']) . '" readonly="readonly" />';
                    echo '<input type="hidden" class="upload" name="' . esc_attr($this->field['name']) . '[' . $x . '][image]" id="' . esc_attr($this->field['id']) . '-image_url_' . $x . '" value="' . esc_attr($slide['image']) . '" readonly="readonly" />';
                    echo '<input type="hidden" class="upload-height" name="' . esc_attr($this->field['name']) . '[' . $x . '][height]" id="' . esc_attr($this->field['id']) . '-image_height_' . $x . '" value="' . esc_attr($slide['height']) . '" />';
                    echo '<input type="hidden" class="upload-width" name="' . esc_attr($this->field['name']) . '[' . $x . '][width]" id="' . esc_attr($this->field['id']) . '-image_width_' . $x . '" value="' . esc_attr($slide['width']) . '" /></li>';
                    
                    echo '<li><a href="javascript:void(0);" class="button deletion redux-slides-remove">' . __('Delete Slide', 'ascend') . '</a></li>';
                    echo '</ul></div></fieldset></div>';
                    $x++;
                
                }
            }

            if ($x == 0) {
                echo '<div class="redux-slides-accordion-group"><fieldset class="redux-field" data-id="'.esc_attr($this->field['id']).'"><h3><span class="redux-slides-header">New Slide</span></h3><div>';

                $hide = ' hide';

                echo '<div class="screenshot' . $hide . '">';
                echo '<a class="of-uploaded-image" href="">';
                echo '<img class="redux-slides-image" id="image_image_id_' . $x . '" src="" alt="" target="_blank" rel="external" />';
                echo '</a>';
                echo '</div>';

                //Upload controls DIV
                echo '<div class="upload_button_div">';

                //If the user has WP3.5+ show upload/remove button
                echo '<span class="button media_upload_button" id="add_' . $x . '">' . __ ( 'Upload', 'ascend' ) . '</span>';

                echo '<span class="button remove-image' . $hide . '" id="reset_' . $x . '" rel="' . esc_attr($this->parent->args[ 'opt_name' ]) . '[' . esc_attr($this->field[ 'id' ]) . '][attachment_id]">' . __ ( 'Remove', 'ascend' ) . '</span>';

                echo '</div>' . "\n";

                echo '<ul id="' . esc_attr($this->field['id']) . '-ul" class="redux-slides-list">';
                echo '<li><input type="text" id="' . esc_attr($this->field['id']) . '-url_' . $x . '" name="' . esc_attr($this->field['name']) . '[' . $x . '][url]" value="" class="full-text upload" placeholder="'.__( 'URL', 'ascend' ).'" /></li>';
                echo '<li><input type="text" id="' . esc_attr($this->field['id']) . '-title_' . $x . '" name="' . esc_attr($this->field['name']) . '[' . $x . '][title]" value="" placeholder="'.__( 'Title', 'ascend' ).'" class="full-text slide-title" /></li>';
                echo '<li><textarea name="' . esc_attr($this->field['name']) . '[' . $x . '][description]" id="' . esc_attr($this->field['id']) . '-description_' . $x . '" placeholder="'.__( 'Subtitle', 'ascend' ).'" class="large-text" rows="6"></textarea></li>';
                echo '<li><input type="text" id="' . esc_attr($this->field['id']) . '-link_' . $x . '" name="' . esc_attr($this->field['name']) . '[' . $x . '][link]" value="" placeholder="'.__( 'Slide Link', 'ascend' ).'" class="full-text" /></li>';
                
                echo '<li><label for="'. esc_attr($this->field['id']) .  '-target_' . $x . '">';
                echo '<input type="checkbox" class="checkbox-slide-target" id="' . esc_attr($this->field['id']) . '-target_' . $x . '" value="" ' . checked(  '', '1', false ) . ' name="' . esc_attr($this->field['name']) . '[' . esc_attr($this->field['id']) . '][' . $x . '][target]" />';
                echo ' '.__('Open Link in New Tab/Window', 'ascend'). '</label></li>';

                echo '<li><input type="hidden" class="slide-sort" name="' . esc_attr($this->field['name']) . '[' . $x . '][sort]" id="' . esc_attr($this->field['id']) . '-sort_' . $x . '" value="' . $x . '" />';
                echo '<li><input type="hidden" class="upload-id" name="' . esc_attr($this->field['name']) . '[' . $x . '][attachment_id]" id="' . esc_attr($this->field['id']) . '-image_id_' . $x . '" value="" />';
                echo '<input type="hidden" class="upload" name="' . esc_attr($this->field['name']) . '[' . $x . '][url]" id="' . esc_attr($this->field['id']) . '-image_url_' . $x . '" value="" readonly="readonly" />';
                echo '<input type="hidden" class="upload-height" name="' . esc_attr($this->field['name']) . '[' . $x . '][height]" id="' . esc_attr($this->field['id']) . '-image_height_' . $x . '" value="" />';
                echo '<input type="hidden" class="upload-width" name="' . esc_attr($this->field['name']) . '[' . $x . '][width]" id="' . esc_attr($this->field['id']) . '-image_width_' . $x . '" value="" /></li>';

                echo '<li><a href="javascript:void(0);" class="button deletion redux-slides-remove">' . __('Delete Slide', 'ascend') . '</a></li>';
                echo '</ul></div></fieldset></div>';
            }
            echo '</div><a href="javascript:void(0);" class="button redux-slides-add2 kad_redux-slides-add button-primary" rel-id="' . esc_attr($this->field[ 'id' ]) . '-ul" rel-name="' . esc_attr($this->field[ 'name' ]) . '[title][]">' . sprintf ( __ ( 'Add %s', 'ascend' ), $this->field[ 'content_title' ] ) . '</a><br/>';
        }
 
         public function enqueue () {
            if ( function_exists( 'wp_enqueue_media' ) ) {
                wp_enqueue_media();
            } else {
                wp_enqueue_script( 'media-upload' );
            }

            wp_enqueue_script (
                'redux-field-media-js', 
               	ReduxFramework::$_url . 'assets/js/media/media' . Redux_Functions::isMin() . '.js',
                array( 'jquery', 'redux-js' ), 
                time (), 
                true
            );

            wp_enqueue_script (
                'ascend-field-slides-js', 
                get_template_directory_uri() . '/themeoptions/options/extensions/ascend_slides/ascend_slides/field_ascend_slides' . Redux_Functions::isMin () . '.js', 
                array( 'jquery', 'jquery-ui-core', 'jquery-ui-accordion', 'wp-color-picker' ), 
                time (), 
                true
            );

            wp_enqueue_style (
                'ascend-field-slides-css', 
                get_template_directory_uri() . '/themeoptions/options/extensions/ascend_slides/ascend_slides/field_ascend_slides.css', 
                time (), 
                true
            );
        }       

    }
}
