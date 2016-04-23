<?php
require_once 'app_model.php';

class ProjectModel extends AppModel{

	public function get_data_by_id($id)
	{
		global $wpdb;
		$res = $wpdb->get_row("SELECT * FROM `".$wpdb->prefix."egrids_projects"."` WHERE id = ".$id, ARRAY_A);
		return $res;
	}

	public function get_projects_by_egrid_id($eid)
	{
		global $wpdb;
		$res = $wpdb->get_results("SELECT * FROM `".$wpdb->prefix."egrids_projects"."` WHERE egrid_id = ".$eid." ORDER BY ordered ASC", ARRAY_A);
		return $res;
	}


	public function update_data($post)
	{
		global $wpdb;
		$wpdb->update($wpdb->prefix."egrids_projects", $post, array("id" => $post['id']));

		//update project count
		$rec_count = $wpdb->get_var( "SELECT COUNT(*) FROM ".$wpdb->prefix."egrids_projects WHERE egrid_id=".$post['egrid_id'] );
		$wpdb->query(
			$wpdb->prepare("UPDATE `".$wpdb->prefix."egrids` SET project_count = %d  WHERE id = %d", $rec_count, $post['egrid_id'])
		);

		/*Debug*/
		// $this->wpdb->show_errors();
		// $this->wpdb->print_error();
		// exit;
		return $wpdb->num_rows;
	}

	public function insert_data($post)
	{
		global $wpdb;

		$wpdb->insert($wpdb->prefix."egrids_projects", $post);

		$wpdb->query(
			$wpdb->prepare("UPDATE `".$wpdb->prefix."egrids` SET project_count = project_count + 1 WHERE id = %d", $post['egrid_id'])
		);

		return $wpdb->insert_id;
	}
	public function delete_data($post)
	{
		global $wpdb;

		$id = $post['data']['id'];
		$egrid_id = $post['data']['egrid_id'];

		//delete photo
		$images = $this->get_images_by_project_id($id);
		foreach ($images as $image) {
			$uploadFolder = wp_upload_dir();
			@unlink($uploadFolder['basedir'].DIRECTORY_SEPARATOR.'wp_elastic_grid'.DIRECTORY_SEPARATOR.$image['filename']);
		}

		$wpdb->query(
			$wpdb->prepare("UPDATE `".$wpdb->prefix."egrids` SET project_count = project_count-1 WHERE id = %d", $egrid_id)
		);


		$wpdb->query(
			$wpdb->prepare("DELETE FROM `".$wpdb->prefix."egrids_images` WHERE egrid_project_id = %d",$id)
		);

		$wpdb->query(
			$wpdb->prepare("DELETE FROM `".$wpdb->prefix."egrids_projects` WHERE id = %d",$id)
		);
	}

	public function save_project_ordered($orderLists)
	{
		global $wpdb;

        $queryStr = 'UPDATE ' . $wpdb->prefix.'egrids_projects SET ordered = CASE id ';
        foreach ($orderLists as $order => $id):
            if (!$id)
                continue;
            $queryStr .= 'WHEN ' . $id . ' THEN ' . $order . ' ';
        endforeach;
        $queryStr .= 'END WHERE id IN (' . implode(", ", $orderLists) . ');';

		$wpdb->query($queryStr);
	}

	/****************************
	*  PROJECT IMAGES
	*****************************/

	public function get_images_by_project_id($project_id)
	{
		global $wpdb;
		$res = $wpdb->get_results("SELECT * FROM `".$wpdb->prefix."egrids_images"."` WHERE egrid_project_id = ".$project_id." ORDER BY is_default DESC , id ASC ", ARRAY_A);
		return $res;
	}


	public function insert_project_images($post)
	{
		global $wpdb;
		if(!empty($post)){
			$projectId = $post['project_id'];
			unset($post['project_id']);


			$values = array();
			$place_holders = array();
			$query = "INSERT INTO `".$wpdb->prefix."egrids_images` (egrid_project_id, filename) VALUES ";
			foreach ($post as $filename) {
				array_push($values, $projectId, $filename);
				$place_holders[] = "(%d, '%s')";
			}
			$query .= implode(', ', $place_holders);

			$wpdb->query( $wpdb->prepare("$query ", $values));
		}

		return $wpdb->insert_id;
	}

	public function set_default_image_thumbnail($project_id, $id)
	{
		global $wpdb;

		$wpdb->query(
			$wpdb->prepare("UPDATE `".$wpdb->prefix."egrids_images` SET is_default = 0 WHERE egrid_project_id = %d",$project_id)
		);

		$wpdb->query(
			$wpdb->prepare("UPDATE `".$wpdb->prefix."egrids_images` SET is_default = 1 WHERE id = %d",$id)
		);
	}

	public function delete_image_by_id($id)
	{
		global $wpdb;

		$wpdb->query(
			$wpdb->prepare("DELETE FROM `".$wpdb->prefix."egrids_images` WHERE id = %d",$id)
		);
	}
}

?>