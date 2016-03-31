<?php
//session_start('egrids_session');
/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php>
*/
error_reporting(0);
@ini_set('display_errors',0);

$current_path = getcwd(); // get the current path to where the file is located
$folder = explode(DIRECTORY_SEPARATOR, $current_path);
$root = array();
foreach ($folder as $fname) {
	if($fname == "wp-content"){
		break;
	}
	$root[] = $fname;
}
$root = implode(DIRECTORY_SEPARATOR, $root);


// Now I can requiere any wordpress file
require($root.DIRECTORY_SEPARATOR.'wp-load.php');
require_once("resize-class.php");
require '../model/project_model.php';
$verifyToken = md5('phapsu.com' . $_POST['timestamp']);


// $file = fopen("test.txt","w");
// fwrite($file,$root.DIRECTORY_SEPARATOR.'wp-load.php');
// fclose($file);
if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
	$projectId     = isset($_POST['projectId']) ? $_POST['projectId'] : 0;
	$uploadDir     = $_POST['upload_folder'];
	$resize_width  = $_POST['resize_width'];
	$resize_height = $_POST['resize_height'];
	$resize_type   = $_POST['resize_type'];
	$thumb_width   = $_POST['thumb_width'];
	$thumb_height  = $_POST['thumb_height'];
	$thumb_type    = $_POST['thumb_type'];
	$tempFile      = $_FILES['Filedata']['tmp_name'];

	//set projectId
	$_photoData['project_photos']['project_id'] = $projectId;

	// Validate the file type
	$fileTypes = array('jpg','jpeg','gif','png'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);

	if (in_array($fileParts['extension'],$fileTypes)) {
		if (!file_exists($uploadDir)) {
		    mkdir($uploadDir, 0777, true);
		    mkdir($uploadDir. 'small'  . DIRECTORY_SEPARATOR, 0777, true);
			mkdir($uploadDir. 'large'  . DIRECTORY_SEPARATOR, 0777, true);
		}


    	$newName = (file_exists($uploadDir.$_FILES['Filedata']['name'])) ? $verifyToken.'_'. $_FILES['Filedata']['name'] : $_FILES['Filedata']['name'];
		move_uploaded_file($tempFile,$uploadDir.$newName);
		/***
		*  Create thumbnail image
		***/
		// *** 1) Initialise / load image
		$resizeObj = new resize( $uploadDir .$newName);
		// *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
		$resizeObj -> resizeImage($thumb_width, $thumb_height, $thumb_type);
		// *** 3) Save small image
		$resizeObj -> saveImage($uploadDir . 'small'  . DIRECTORY_SEPARATOR . $newName, 100);

		// *** 4) Resize image (options: exact, portrait, landscape, auto, crop)
		$resizeObj = new resize( $uploadDir .$newName);
		$resizeObj -> resizeImage($resize_width, $resize_height, $resize_type);
		// *** 3) Save large image
		$resizeObj -> saveImage($uploadDir . 'large'  . DIRECTORY_SEPARATOR . $newName, 100);


		$_photoData['project_photos'][] = $newName;

		//insert new photo
		$projectModel = new ProjectModel();
		$projectModel->insert_project_images($_photoData['project_photos']);

		echo '1';
	} else {
		echo 'Invalid file type.';
	}
}
?>