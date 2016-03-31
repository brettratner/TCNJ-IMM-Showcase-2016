<?php
/*
Plugin Name: WP Elastic Grid
Plugin URI: http://codecanyon.net/item/wp-elastic-grid/4566271
Description: WP Elastic Grid is a leightweight, easy to use gallery script inspired by Google Image Search with support for .PNG, .JPG and .GIF image files.
Author: Vu Khanh Truong
Version: 1.0
Author URI: http://bonchen.net
*/
// error_reporting(0);
// ini_set( 'display_errors', 1 );
//Our class extends the WP_List_Table class, so we need to make sure that it's there
define('WP_EGRIDS_PATH', dirname(__FILE__));
define('WP_EGRIDS_PLUGIN_URL', plugins_url('wp_elastic_grid'));
// $wpdb->show_errors();
// $wpdb->print_error();


/*--------------------------
Install Data
--------------------------*/
global $wp_egrids_db_version;
$wp_egrids_db_version = "1.0";

function egrids_install()
{
	global $wpdb;
	global $wp_egrids_db_version;

	$table_name = $wpdb->prefix . "quiz";

	$egrids_table_sql = "
		CREATE TABLE IF NOT EXISTS  `".$wpdb->prefix."egrids` (
			 `id` INT( 11 ) NOT NULL AUTO_INCREMENT ,
			 `title` VARCHAR( 200 ) NOT NULL ,
			 `project_count` INT( 10 ) NOT NULL DEFAULT  '0',
			 `filter_effect` SET( 'moveup', 'scaleup', 'fallperspective', 'fly', 'flip', 'helix', 'popup' ) NOT NULL ,
			 `hover_direction` TINYINT( 1 ) NOT NULL DEFAULT  '1',
			 `hover_delay` INT NOT NULL DEFAULT  '0',
			 `hover_inverse` TINYINT( 1 ) NOT NULL DEFAULT  '0',
			 `expanding_speed` INT NOT NULL DEFAULT  '500',
			 `expanding_height` INT NOT NULL DEFAULT  '500',
			 `thumb_width` INT NOT NULL DEFAULT  '200',
			 `thumb_height` INT NOT NULL DEFAULT  '200',
			 `thumb_type` SET( 'exact', 'portrait', 'landscape', 'auto', 'crop' ) NOT NULL,
			 `resize_width` INT NOT NULL,
			 `resize_height` INT NOT NULL,
			 `resize_type` SET( 'exact', 'portrait', 'landscape', 'auto', 'crop' ) NOT NULL,
			 `created` DATETIME NOT NULL DEFAULT  '0000-00-00 00:00:00',
			PRIMARY KEY (  `id` )
			) ENGINE = MYISAM DEFAULT CHARSET = utf8 AUTO_INCREMENT =1;";

	$egrids_projects_sql = "
		CREATE TABLE IF NOT EXISTS  `".$wpdb->prefix."egrids_projects` (
			 `id` INT( 11 ) NOT NULL AUTO_INCREMENT ,
			 `egrid_id` INT( 11 ) NOT NULL ,
			 `title` VARCHAR( 200 ) NOT NULL ,
			 `description` TEXT NOT NULL ,
			 `tags` MEDIUMTEXT NULL ,
			 `button_list` TEXT NULL ,
			 `ordered` INT( 10 ) NULL DEFAULT  '0',
			PRIMARY KEY (  `id` )
			) ENGINE = MYISAM DEFAULT CHARSET = utf8 AUTO_INCREMENT =1;";

	$egrids_images_sql = "
		CREATE TABLE IF NOT EXISTS  `".$wpdb->prefix."egrids_images` (
			 `id` INT( 11 ) NOT NULL AUTO_INCREMENT ,
			 `egrid_project_id` INT( 11 ) NOT NULL ,
			 `filename` VARCHAR(255) NOT NULL ,
			 `is_default` TINYINT( 1 ) NOT NULL DEFAULT  '0',
			PRIMARY KEY (  `id` )
			) ENGINE = MYISAM DEFAULT CHARSET = utf8 AUTO_INCREMENT =1;";

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $egrids_table_sql );
dbDelta( $egrids_projects_sql );
dbDelta( $egrids_images_sql );

add_option( "wp_egrids_db_version", $wp_egrids_db_version );
}

//Calling the hook function
register_activation_hook( __FILE__, 'egrids_install' );

/*---------------------------------
* load backend neccessary features
*---------------------------------*/
if(is_admin() && (isset($_GET['page']) && ($_GET['page'] == 'elastic-grid' || $_GET['page'] == 'config-elastic-grid') )){
	//editor
	add_action('init', 'wp_egrids_output_buffer');
	add_action('admin_init', 'wp_egrids_editor_admin_init');
	add_action('admin_head', 'wp_egrids_editor_admin_head');
	//flash session
	add_action('init', 'egridsStartSession', 1);
	add_action('wp_logout', 'egridsEndSession');
	add_action('wp_login', 'egridsEndSession');
	//flush session
	add_action('wp_footer', 'wp_egrids_output_buffer_end');
}

/*---------------------------------
* create css for table projects
*---------------------------------*/
add_action('admin_head', 'egrids_projects_admin_head');

function egrids_projects_admin_head() {
	if(isset($_GET['page']) && $_GET['page']=='elastic-grid'){
	    wp_register_style('wp_egrids_bootstrap', plugins_url('/assets/css/bootstrap.min.css', __FILE__));
	    wp_enqueue_style('wp_egrids_bootstrap');

	    wp_register_style('wp_egrids_backend', plugins_url('/assets/css/backend.css', __FILE__));
	    wp_enqueue_style('wp_egrids_backend');

	    wp_register_script('wp_egrids_bootstrapjs', plugins_url('/assets/js/bootstrap.min.js', __FILE__));
	    wp_enqueue_script('wp_egrids_bootstrapjs', array('jquery'));

	    echo '<style type="text/css">';
	    echo '.column-ordered { width:10%; white-space: nowrap }';
	    echo '</style>';
	}
}


/*---------------------------------
* load native tinymce
*---------------------------------*/
function wp_egrids_editor_admin_init() {
	wp_enqueue_script('word-count');
	wp_enqueue_script('post');
	wp_enqueue_script('editor');
	wp_enqueue_script('media-upload');
}
function wp_egrids_editor_admin_head() {
	wp_tiny_mce();
}

/*---------------------------------
//session manager
*---------------------------------*/

function egridsStartSession()
{
	if(!session_id()) {
		session_start('egrids_session');
	}
}
function egridsEndSession()
{
	session_destroy ();
}

/*------------------------------------------
//Allow redirection, even if the
theme starts to send output to the browser
*------------------------------------------*/
function wp_egrids_output_buffer()
{
	ob_start();
}
function wp_egrids_output_buffer_end()
{
	ob_end_flush();
}

/*---------------------------------
//Create administration menu
*---------------------------------*/
function wp_egrids_plugin_actions()
{
	add_menu_page("WP Elastic Grid", "Elastic Grid", 10, "elastic-grid", "wp_egrids_controller");
}
add_action('admin_menu', 'wp_egrids_plugin_actions');
/* Upload of Photo in Gallery*/
function wpe_upload(){
	include('wpe_upload.php');
}

/*
* Extract particular fields from an array
* @http://stackoverflow.com/questions/5103640/how-to-extract-particular-fields-from-an-array
*/
function wp_egrids_custom_extract_array ($item, $field='id') {
  return $item[$field];
}

require WP_EGRIDS_PATH.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'load.php';


/*---------------------------------
* MVC Manage list of quiz
*---------------------------------*/
function wp_egrids_controller()
{
	$controller = (isset($_GET['controller'])) ? $_GET['controller'] : '';
	$action = (isset($_GET['action'])) ? $_GET['action'] : '';
	switch ($controller) {
		case 'projects':
			//initial controller
			require 'controller/projects_controller.php';
			new ProjectsController();
		break;

		default:
			require 'controller/egrids_controller.php';
			new EgridsController();
		break;
	}
}


/*---------------------------------
* Shortcode
*---------------------------------*/
include('ajax.php');

/*---------------------------------
* Shortcode
*---------------------------------*/
include('shortcode.php');
?>