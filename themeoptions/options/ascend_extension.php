<?php
if ( class_exists( 'Redux' ) ) {
	$opt_name = 'ascend';
    Redux::setExtensions( $opt_name, dirname( __FILE__ ) . '/extensions/' );
}
// Just keep from getting errors.

add_action( "redux/extension/customizer/control/includes","ascend_customizer_fields" );
function ascend_customizer_fields(){
    if ( ! class_exists( 'Redux_Customizer_Control_info' ) ) {
        class Redux_Customizer_Control_info extends Redux_Customizer_Control {
            public $type = "redux-info";
        }
    }
    if ( ! class_exists( 'Redux_Customizer_Control_ascend_slides' ) ) {
        class Redux_Customizer_Control_ascend_slides extends Redux_Customizer_Control {
            public $type = "redux-ascend_slides";
        }
    }
    if ( ! class_exists( 'Redux_Customizer_Control_ascend_icons' ) ) {
        class Redux_Customizer_Control_ascend_icons extends Redux_Customizer_Control {
            public $type = "redux-ascend_icons";
        }
    }
     if ( ! class_exists( 'Redux_Customizer_Control_background' ) ) {
        class Redux_Customizer_Control_background extends Redux_Customizer_Control {
            public $type = "redux-background";
        }
    }
    if ( ! class_exists( 'Redux_Customizer_Control_sorter' ) ) {
        class Redux_Customizer_Control_sorter extends Redux_Customizer_Control {
            public $type = "redux-sorter";
        }
    }
}



