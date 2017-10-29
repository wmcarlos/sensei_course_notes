<?php
/**
 * Scripts
 *
 * @package     WPeMatico\PluginName\Scripts
 * @since       1.0.0
 */


// Exit if accessed directly
if ( !defined('ABSPATH') ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

/**
 * Load admin scripts
 *
 * @since       1.0.0
 * @global      array $wpematico_settings_page The slug for the WPeMatico settings page
 * @global      string $post_type The type of post that we are editing
 * @return      void
 */

add_action( 'admin_enqueue_scripts', 'sensei_courses_notes_admin_scripts', 100 );

function sensei_courses_notes_admin_scripts($hooks) {
          //styles
    global $post_type;

    if( (($hooks == 'post.php' OR $hooks=='post-new.php') && $post_type == 'scn_cpt_notes')) {

        wp_enqueue_style( 'sensei_course_notes_admin_css', SENSEI_COURSE_NOTES_URL . '/assets/css/admin.css' );
        //scripts
        wp_enqueue_script( 'sensei_course_notes_admin_js', SENSEI_COURSE_NOTES_URL . '/assets/js/admin.js', array( 'jquery' ) );

    } 
}

add_action( 'wp_enqueue_scripts', 'sensei_course_notes_front_scripts', 100 );

function sensei_course_notes_front_scripts($hooks) {
          //styles
    global $post_type;

        wp_enqueue_style( 'sensei_course_notes_admin_css', SENSEI_COURSE_NOTES_URL . '/assets/css/admin.css' );
        //scripts
        wp_enqueue_script( 'sensei_course_notes_admin_js', SENSEI_COURSE_NOTES_URL . '/assets/js/admin.js', array( 'jquery' ) );
}