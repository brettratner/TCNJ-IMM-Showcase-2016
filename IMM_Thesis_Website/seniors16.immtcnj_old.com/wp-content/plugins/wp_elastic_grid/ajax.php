<?php
session_start('egrids_session');

/*-------------------------------------
* AJAX: load photo list by project id
*-------------------------------------*/
function wp_egrid_ajax_load_project_photo_callback() {
	header('Content-Type: text/html; charset=utf-8');
	$uploadFolder = wp_upload_dir();
	$uploadFolder = $uploadFolder['baseurl'].'/wp_elastic_grid/';


	require 'model/project_model.php';
	$projectModel = new ProjectModel();


	//get all photo
	$project_id = (isset($_SESSION['project_photos']['project_id'])) ? $_SESSION['project_photos']['project_id'] : $_REQUEST['project_id'];
	$project_images = null;
	if($project_id){
		$project_images = $projectModel->get_images_by_project_id($project_id);
	}



	if(!empty($project_images)){
		$ul = "<ul>%s</ul>";
		$li = "";
		for($i=0; $i<count($project_images); $i++){
			$checked = ($project_images[$i]['is_default'] > 0) ? 'checked' : '';
			$li .= sprintf('<li class="col-md-2">
				<input type="radio" title="Set default photo" value="'.$project_images[$i]['id'].'" data-projectid="'.$project_images[$i]['egrid_project_id'].'" class="set_default_photo pull-left" name="is_default" id="optionsRadios'.$project_images[$i]['id'].'" '.$checked.'>
				<button type="button" class="close delete_photo" data-id="'.$project_images[$i]['id'].'"  data-filename="'.$project_images[$i]['filename'].'" aria-hidden="true">&times;</button>
				<img class="thumbnail" src="%s" alt=""></li>', $uploadFolder.'small/'.$project_images[$i]['filename']);
		}
		echo sprintf($ul, $li);
	}

	die();
}
add_action('wp_ajax_nopriv_wp_egrid_ajax_load_project_photo', 'wp_egrid_ajax_load_project_photo_callback');
add_action('wp_ajax_wp_egrid_ajax_load_project_photo', 'wp_egrid_ajax_load_project_photo_callback');


/*-------------------------------------
* AJAX: delete photo
*-------------------------------------*/
function wp_egrid_ajax_delete_photo_callback(){
	$photo_id =  $_REQUEST['photo_id'];
	$filename =  $_REQUEST['filename'];

	//delete record in database
	require 'model/project_model.php';
	$projectModel = new ProjectModel();
	$projectModel->delete_image_by_id($photo_id);

	//delete file
	$uploadFolder = wp_upload_dir();
	$uploadFolder = $uploadFolder['baseurl'];
	$filename = $uploadFolder.DIRECTORY_SEPARATOR.'wp_elastic_grid'.DIRECTORY_SEPARATOR.$filename;
	@unlink($filename);

	die();
}
add_action('wp_ajax_nopriv_wp_egrid_ajax_delete_photo', 'wp_egrid_ajax_delete_photo_callback');
add_action('wp_ajax_wp_egrid_ajax_delete_photo', 'wp_egrid_ajax_delete_photo_callback');

/*-------------------------------------
* AJAX: set photo as default
*-------------------------------------*/
function wp_egrid_ajax_set_default_photo_callback(){
	$photo_id =  $_REQUEST['photo_id'];
	$project_id =  $_REQUEST['project_id'];

	//update record in database
	require 'model/project_model.php';
	$projectModel = new ProjectModel();
	$projectModel->set_default_image_thumbnail($project_id, $photo_id);

	die();
}
add_action('wp_ajax_nopriv_wp_egrid_ajax_set_default_photo', 'wp_egrid_ajax_set_default_photo_callback');
add_action('wp_ajax_wp_egrid_ajax_set_default_photo', 'wp_egrid_ajax_set_default_photo_callback');

/*-------------------------------------
* AJAX: set photo as default
*-------------------------------------*/
function wp_egrid_ajax_order_project_callback(){
	$_REQUEST = stripslashes_deep($_REQUEST); //skip safe slash of Wordpress
	$ordered =  json_decode($_REQUEST['ordered']);
	// print_r($ordered);

	//update record in database
	require 'model/project_model.php';
	$projectModel = new ProjectModel();
	$projectModel->save_project_ordered($ordered);

	die();
}
add_action('wp_ajax_nopriv_wp_egrid_ajax_order_project', 'wp_egrid_ajax_order_project_callback');
add_action('wp_ajax_wp_egrid_ajax_order_project', 'wp_egrid_ajax_order_project_callback');

/*---------------------------------
* AJAX: read database and return json follow elastic grid
*---------------------------------*/
function load_egrid_json_callback() {
	header('Content-Type: application/javascript');

	require 'model/egrid_model.php';
	$json_egrid = new EgridModel();

	$script = 'jQuery(document).ready(function() { jQuery.noConflict(); jQuery("#egrid-%s").elastic_grid (%s); });';
	echo sprintf($script, $_REQUEST['egrid_id'], $json_egrid->get_json_grid_by_id($_REQUEST['egrid_id']));
	//echo $json_egrid->get_json_grid_by_id($_REQUEST['egrid_id']);
	die();
}
add_action('wp_ajax_nopriv_load_egrid_json', 'load_egrid_json_callback');
add_action('wp_ajax_load_egrid_json', 'load_egrid_json_callback');
?>