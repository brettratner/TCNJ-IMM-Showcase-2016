<?php
require_once 'app_model.php';
require_once 'project_model.php';

class EgridModel extends AppModel{

	public function get_data_by_id($id)
	{
		global $wpdb;
		$res = $wpdb->get_row("SELECT * FROM `".$wpdb->prefix."egrids"."` WHERE id = ".$id, ARRAY_A);
		return $res;
	}

	public function update_data($post)
	{
		global $wpdb;
		// echo '<pre>';
		// print_r($post);
		// echo '</pre>';exit();
		$wpdb->update($wpdb->prefix."egrids", $post, array("id" => $post['id']));
		return $wpdb->num_rows;
	}

	public function insert_data($post)
	{
		global $wpdb;
		$post['created']    = date('Y-m-d H:i:s');
		$wpdb->insert($wpdb->prefix."egrids", $post);
		/*Debug*/
		// $wpdb->show_errors();
		// $wpdb->print_error();
		// exit;
		return $wpdb->insert_id;
	}

	public function delete_data($id)
	{
		global $wpdb;
		$wpdb->query(
			$wpdb->prepare("DELETE FROM `".$wpdb->prefix."egrids` WHERE id = %d",$id)
		);

		$projects = $wpdb->get_results("SELECT * FROM `".$wpdb->prefix."egrids_projects"."` WHERE egrid_id = ".$id, ARRAY_A);
		$project_id_list = array_map('wp_egrids_custom_extract_array', $projects);


		$wpdb->query(
			$wpdb->prepare("DELETE FROM `".$wpdb->prefix."egrids_projects` WHERE egrid_id = %d",$id)
		);

		//delete photo
		foreach ($project_id_list as $project_id) {
			$images = $this->get_images_by_project_id($project_id);
			foreach ($images as $image) {
				$uploadFolder = wp_upload_dir();
				$uploadFolder = $uploadFolder['baseurl'];
				@unlink($uploadFolder.DIRECTORY_SEPARATOR.'wp_elastic_grid'.DIRECTORY_SEPARATOR.$image['filename']);
			}
		}


		$wpdb->query("DELETE FROM `".$wpdb->prefix."egrids_images` WHERE  egrid_project_id IN (".implode(",", $project_id_list).")");
	}

	public function get_json_grid_by_id($id){
		$json_result = array();

		//get egrid data
		$gridInfo                       = $this->get_data_by_id($id);
		$json_result['filterEffect']    = $gridInfo['filter_effect'];
		$json_result['hoverDirection']  = (bool)$gridInfo['hover_direction'];
		$json_result['hoverDelay']      = $gridInfo['hover_delay'];
		$json_result['hoverInverse']    = (bool)$gridInfo['hover_inverse'];
		$json_result['expandingSpeed']  = $gridInfo['expanding_speed'];
		$json_result['expandingHeight'] = $gridInfo['expanding_height'];

		//get project info
		$projectModel = new ProjectModel();
		$projects = $projectModel->get_projects_by_egrid_id($id);

		//url to image
		$uploadFolder = wp_upload_dir();
		$uploadFolder = $uploadFolder['baseurl'].'/wp_elastic_grid/';

		$json_result['items'] = array();
		foreach ($projects as $project) {
			$item                = array();
			$item['title']       = $project['title'];
			$item['description'] = $project['description'];
			$tags		         = explode(',', $project['tags']);
			$tags				 = array_map('trim',$tags);
			$tags				 = array_map('ucfirst',$tags);
			$item['tags']        = (!empty($tags)) ? $tags : array();
			$item['button_list'] = (!empty($project['button_list'])) ? json_decode($project['button_list']) : array();

			$images = $projectModel->get_images_by_project_id($project['id']);
			$thumbnails = array();
			$large = array();
			foreach ($images as $image) {
				$thumbnails[] = $uploadFolder.'small/'.$image['filename'];
				$large[]      = $uploadFolder.'large/'.$image['filename'];
			}

			$item['thumbnail'] = $thumbnails;
			$item['large'] = $large;

			$json_result['items'][] = $item;
		}

		return json_encode($json_result);
	}
}

?>