<?php
/**
 * Plugin Name:     Sensei Course Notes
 * Plugin URI:      
 * Description:     Exclusive plugin for taking attendance at chorus events as well as record payments made
 * Version:         1.0.0
 * Author:          frontuari C.A
 * Author URI:      frontuari.com
 * Text Domain:     sensei_course_notes
 *
 * @package        	frontuari\Sensei Course Notes
 * @author          Carlos Vargas & Alberto Vargas
 * @copyright       Copyright (c) 2017
 *
 *
 * - Find all instances of @todo in the plugin and update the relevant
 *   areas as necessary.
 *
 * - All functions that are not class methods MUST be prefixed with the
 *   plugin name, replacing spaces with underscores. NOT PREFIXING YOUR
 *   FUNCTIONS CAN CAUSE PLUGIN CONFLICTS!
 */


// Plugin version
if ( ! defined('SENSEI_COURSE_NOTES_VERSION' ) ) define('SENSEI_COURSE_NOTES_VERSION', '1.0' ); 

if ( ! class_exists( 'SENSEI_COURSE_NOTES' ) ) :

class SENSEI_COURSE_NOTES {
	private static $instance = null;
	public static function getInstance() {
		if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
	}
	function __construct() {
		$this->setupGlobals();
		$this->includes();
		$this->loadTextDomain();
		
	}
	private function includes() {
		//API REST CPANEL
		require_once SENSEI_COURSE_NOTES_PLUGIN_DIR.'includes/sensei_course_notes_postype_notes.php';
		require_once SENSEI_COURSE_NOTES_PLUGIN_DIR.'includes/scripts.php';
		//Shortcode
		do_action('wpemails_cpve_include_files');

	}
	
	private function setupGlobals() {
		// Plugin Folder Path
		if (!defined('SENSEI_COURSE_NOTES_PLUGIN_DIR')) {
			define('SENSEI_COURSE_NOTES_PLUGIN_DIR', plugin_dir_path( __FILE__ ));
		}

		// Plugin Folder URL
		if (!defined('SENSEI_COURSE_NOTES_PLUGIN_URL')) {
			define('SENSEI_COURSE_NOTES_PLUGIN_URL', plugin_dir_url(__FILE__));
		}

		// Plugin Root File
		if (!defined('SENSEI_COURSE_NOTES_PLUGIN_FILE')) {
			define('SENSEI_COURSE_NOTES_PLUGIN_FILE', __FILE__ );
		}
		
		// Plugin text domain
		if (!defined('SENSEI_COURSE_NOTES_TEXT_DOMAIN')) {
			define('SENSEI_COURSE_NOTES_TEXT_DOMAIN', 'SENSEI_COURSE_NOTES' );
		}
		 // Plugin URL
            if(!defined('SENSEI_COURSE_NOTES_URL')) {
                define('SENSEI_COURSE_NOTES_URL', plugin_dir_url( __FILE__ ) );
            }

	}
	public function loadTextDomain() {
		// Set filter for plugin's languages directory
		$lang_dir = dirname( plugin_basename( __FILE__ ) ) . '/languages/';
		$lang_dir = apply_filters('wpemails_cpve_languages_directory', $lang_dir );

		// Traditional WordPress plugin locale filter
		$locale        = apply_filters( 'plugin_locale',  get_locale(), 'SENSEI_COURSE_NOTES' );
		$mofile        = sprintf( '%1$s-%2$s.mo', 'SENSEI_COURSE_NOTES', $locale );

		// Setup paths to current locale file
		$mofile_local  = $lang_dir . $mofile;
		$mofile_global = WP_LANG_DIR . '/SENSEI_COURSE_NOTES/' . $mofile;

		if ( file_exists( $mofile_global ) ) {
			// Look in global /wp-content/languages/TESTPRO/ folder
			load_textdomain( 'SENSEI_COURSE_NOTES', $mofile_global );
		} elseif ( file_exists( $mofile_local ) ) {
			// Look in local /wp-content/plugins/TESTPRO/languages/ folder
			load_textdomain( 'SENSEI_COURSE_NOTES', $mofile_local );
		} else {
			// Load the default language files
			load_plugin_textdomain( 'SENSEI_COURSE_NOTES', false, $lang_dir );
		}
		
	}
}

endif; // End if class_exists check

$sensei_course_notes = null;
function getClasssensei_course_notes() {
	global $sensei_course_notes;
	if (is_null($sensei_course_notes)) {
		$sensei_course_notes = SENSEI_COURSE_NOTES::getInstance();
	}
	return $sensei_course_notes;
}

getClasssensei_course_notes();
