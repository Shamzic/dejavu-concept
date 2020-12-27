<?php


    // Exit if accessed directly
    if ( ! defined( 'ABSPATH' ) ) {
        exit;
    }

    // Making required work.  :) Thanks @britner
    require_once( 'customizer_active_callback.php' );

   	if( !class_exists( 'ReduxFramework_Extension_ascend_customizer' ) ) {
	    class ReduxFramework_Extension_ascend_customizer {
	    }
	}